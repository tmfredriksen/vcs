<?php
/**
 * DB.class.php
 * 
 * Class that handles all database connectivity and queries.
 * 
 * @author Eivind Skreddernes, Tord-Marius Fredriksen og Tommy Langhelle
 * 
 * 13.05.2015
 *
 */
class DB {
	private $db; // mysqli connection
	private $file; // file object. Alert, swatch or manual source
	private $Locked = 0; // all files is set to open when created. A file is locked when editing.
	
	/**
	 * Constructor opening db connection.
	 */
	function __construct() {
		$this->db = new mysqli ( dbconfig::$host, dbconfig::$user, dbconfig::$password, dbconfig::$database );
		
	}
	
	/**
	 * Returns the value of the highest FileID in the table 'file'
	 *
	 * @return int|boolean
	 */
	function getHighestFileID() {
		$stmt = $this->db->prepare ( "SELECT MAX(FileID) FROM File" );
		$stmt->bind_result ( $FileID );
		$stmt->execute ();
		
		if ($stmt->fetch ())
			return $FileID;
		else
			return false;
	}
	
	/**
	 * Returns all files with a certain FileID in a descending order.
	 *
	 * @param int $type(1 -> manualsource, 2 -> alert and 3 -> swatch)
	 * @param int $fileID        	
	 * @return multitype:
	 */
	function getFiles($type, $fileID) {
		// preparing query
		$stmt = $this->db->prepare ( "SELECT * FROM file where Type = ? AND FileID = ? GROUP BY Version DESC" );
		$stmt->bind_param ( 'ii', $type, $fileID );
		// prepare result array
		$result = [ ];
		
		$stmt->execute ();
		
		$stmt->bind_result ( $id, $fileID, $filename, $content, $comment, $path, $type, $time, $version, $hash, $user, $this->Locked );
		
		while ( $stmt->fetch () ) {
			$timeToFormat = strtotime ( $time );
			$formattedTime = date ( "d M Y, G:i", $timeToFormat );
			$file = new File ( $id, $fileID, $filename, $content, $comment, $path, $type, $formattedTime, $version, $hash, $user, $this->Locked );
			array_push ( $result, $file );
		}
		return $result;
	}
	
	/**
	 *
	 * @param int $type(1 for manual source, 2 for alerts and 3 for swatch)
	 * @param int $fileID        	
	 * @return array of files:
	 */
	function getDeletedFiles($type, $fileID) {
		// preparing query
		$stmt = $this->db->prepare ( "SELECT * FROM deletedfile where Type = ? AND FileID = ? GROUP BY Version DESC" );
		$stmt->bind_param ( 'ii', $type, $fileID );
		// prepare result array
		$result = [ ];
		
		$stmt->execute ();
		
		$stmt->bind_result ( $id, $fileID, $filename, $content, $comment, $path, $type, $time, $version, $hash, $user, $this->Locked );
		
		while ( $stmt->fetch () ) {
			$timeToFormat = strtotime ( $time );
			$formattedTime = date ( "d M Y, G:i", $timeToFormat );
			$file = new File ( $id, $fileID, $filename, $content, $comment, $path, $type, $formattedTime, $version, $hash, $user, $this->Locked );
			array_push ( $result, $file );
		}
		return $result;
	}
	
	/**
	 * Returns all the fileID's of a certain type
	 * @param int $type (1 -> manualsource, 2 -> alert and 3 -> swatch)
	 * @return multitype:
	 */
	function getFileIDs($type) {
		$stmt = $this->db->prepare ( "SELECT FileID FROM file WHERE Type=? GROUP BY FileID DESC" );
		$stmt->bind_param ( 'i', $type );
		
		$stmt->execute ();
		
		$result = [ ];
		
		$stmt->bind_result ( $fileID );
		
		while ( $stmt->fetch () ) {
			array_push ( $result, $fileID );
		}
		return $result;
	}
	
	/**
	 * Returns last FileID
	 * 
	 * @param int $type(1 for manual source, 2 for alerts and 3 for swatch)
	 * @return array of files:
	 */
	function getNewestVersionOfFile($type) {
		$stmt = $this->db->prepare ( "SELECT FileID FROM file WHERE Type=? GROUP BY FileID DESC" );
		$stmt->bind_param ( 'i', $type );
		
		$stmt->execute ();
		
		$result = [ ];
		
		$stmt->bind_result ( $fileID );
		
		while ( $stmt->fetch () ) {
			array_push ( $result, $fileID );
		}
		return $result;
	}
	
	/**
	 *
	 * @param int $type(1 for manual source, 2 for alerts and 3 for swatch)
	 * @return array of files:
	 */
	function getNewestVersionOfDeletedFile($type) {
		$stmt = $this->db->prepare ( "SELECT FileID FROM deletedfile WHERE Type=? GROUP BY FileID DESC" );
		$stmt->bind_param ( 'i', $type );
		
		$stmt->execute ();
		
		$result = [ ];
		
		$stmt->bind_result ( $fileID );
		
		while ( $stmt->fetch () ) {
			array_push ( $result, $fileID );
		}
		
		return $result;
	}
	
	/**
	 *
	 * @param int $type(1 for manual source, 2 for alerts and 3 for swatch)
	 * @return array of files:
	 */
	function getActiveFiles($type) {
		$stmt = $this->db->prepare ( "SELECT f.*
									from(
									    SELECT FileID, MAX(Version) as max_version 
									    FROM file 
									    WHERE Type = ?  
									    GROUP BY FileID
									) as x INNER JOIN file AS f ON f.FileID = x.FileID AND f.Version = x.max_version
									GROUP BY Time DESC" );
		$stmt->bind_param ( 'i', $type );
		
		$stmt->execute ();
		
		$result = [ ];
		
		$stmt->bind_result ( $id, $fileID, $filename, $content, $comment, $path, $type, $time, $version, $hash, $user, $this->Locked );
		
		while ( $stmt->fetch () ) {
			$file = new File ( $id, $fileID, $filename, $content, $comment, $path, $type, $time, $version, $hash, $user, $this->Locked );
			array_push ( $result, $file );
		}
		
		return $result;
	}
	
	/**
	 * @param int $type (1 -> manualsource, 2 -> alert and 3 -> swatch)
	 * @return multitype:
	 */
	function getLastFiveFiles($type) {
		$id = $this->db->real_escape_string ( $type );
		$stmt = $this->db->prepare ( "SELECT f.* from(SELECT FileID, MAX(Version) 
									  	as max_version 
										FROM file 
										WHERE Type = ? 
										GROUP BY FileID) 
										as x INNER JOIN file 
											AS f ON f.FileID = x.FileID 
											AND f.Version = x.max_version 
											ORDER BY Time 
											DESC 
											LIMIT 5" );
		$stmt->bind_param ( 'i', $id );
		// prepare result array
		$result = [ ];
		
		$stmt->execute ();
		$stmt->bind_result ( $id, $fileID, $filename, $content, $comment, $path, $type, $time, $version, $hash, $user, $this->Locked );
		
		while ( $stmt->fetch () ) {
			$timeToFormat = strtotime ( $time );
			$formattedTime = date ( "d M Y, G:i", $timeToFormat );
			$file = new File ( $id, $fileID, $filename, $content, $comment, $path, $type, $formattedTime, $version, $hash, $user, $this->Locked );
			array_push ( $result, $file );
		}
		
		return $result;
	}
	
	/**
	 *
	 * Method for getting a file with a certain ID
	 * 
	 * @param int $ID        	
	 * @return File
	 */
	function getFile($ID) {
		$stmt = $this->db->prepare ( "SELECT * FROM File WHERE ID=?" );
		$id = $this->db->real_escape_string ( $ID ); // Vasker input
		$stmt->bind_param ( 'i', $id );
		
		$stmt->bind_result ( $ID, $FileID, $Filename, $Content, $Comment, $Path, $Type, $Time, $Version, $Hash, $User, $this->Locked );
		$stmt->execute ();
		
		if ($stmt->fetch ()) {
			
			$file = new File ( $ID, $FileID, $Filename, $Content, $Comment, $Path, $Type, $Time, $Version, $Hash, $User, $this->Locked );
			return $file;
		} else {
			
			return null;
		}
	}
	
	/**
	 *
	 * @param int $type (1 -> manualsource, 2 -> alert and 3 -> swatch)     	
	 * @return array of files:
	 */
	function getAllFiles($type) {
		// preparing query
		$stmt = $this->db->prepare ( "SELECT * FROM File where Type = ?" );
		$stmt->bind_param ( 'i', $type );
		// prepare result array
		$result = [ ];
		
		$stmt->execute ();
		$stmt->bind_result ( $id, $fileID, $filename, $content, $comment, $path, $type, $time, $version, $hash, $user, $this->Locked );
		
		while ( $stmt->fetch () ) {
			$file = new File ( $id, $fileID, $filename, $content, $comment, $path, $type, $time, $version, $hash, $user, $this->Locked );
			array_push ( $result, $file );
		}
		
		return $result;
	}
	
	/**
	 * Method for create a file
	 *
	 * @param int $FileID        	
	 * @param string $Filename        	
	 * @param string $Content        	
	 * @param string $Comment        	
	 * @param string $Path        	
	 * @param int $Type        	
	 * @param int $Version        	
	 * @param string $Hash        	
	 * @param string $User     
	 * @return $file   	
	 */
	function createFile($FileID, $Filename, $Content, $Comment, $Path, $Type, $Version, $Hash, $User) {
		date_default_timezone_set ( 'Europe/Oslo' );
		$Time = date ( 'Y/m/d H:i:s' );
		$this->Locked = 0;
		if ($Version >= 0)
			$Version ++;
		
		if ($FileID == null)
			if (! $this->getHighestFileID ())
				$FileID = getHighestFileID ();
			else
				$FileID = $this->getHighestFileID () + 1; // Max FileID is returned and added +1.
		
		$stmt = $this->db->prepare ( "INSERT INTO file (FileID, Filename, Content, Comment, Path, Type, Time, Version, Hash, User, Locked)
		VALUES(?,?,?,?,?,?,?,?,?,?, ?)" );
		$stmt->bind_param ( 'issssisissi', $FileID, $Filename, $Content, $Comment, $Path, $Type, $Time, $Version, $Hash, $User, $this->Locked );
		
		$stmt->execute ();
		
		$file = new File ( 0, $FileID, $Filename, htmlspecialchars_decode($Content), $Comment, $Path, $Type, $Time, $Version, $Hash, $User, $this->Locked );
		$file->writeFile ();
		
		return $file;
	}
	
	/**
	 * @param int $id        	
	 * @return string Message
	 */
	function delete($id) {
		$failureMessage = "ID does not exist in table 'file'.";
		$successMessage = "File moved to deleted table and deleted from main table.";
		$fileID = $this->db->real_escape_string ( $id );
		try {
			$stmt = $this->db->prepare ( "INSERT INTO deletedfile (FileID, Filename, Content, Comment, Path, Type, Time, Version, Hash, User, Locked)
		SELECT FileID, Filename, Content, Comment, Path, Type, Time, Version, Hash, User, Locked 
		FROM file where FileID = ?" );
			$stmt->bind_param ( 'i', $fileID );
			$stmt->execute ();
			
			$stmt = $this->db->prepare ( "DELETE FROM file WHERE FileID=?" );
			$stmt->bind_param ( 'i', $fileID );
			$stmt->execute ();
		} catch ( Exception $e ) {
			return $failureMessage . $e;
		}
		return $successMessage;
	}
	
	/**
	 * @param int $id        	
	 * @return string Message
	 */
	function restoreDeletedFile($id) {
		$failureMessage = "ID does not exist in table 'deletedfile'.";
		$successMessage = "File restored and saved in original table.";
		$fileID = $this->db->real_escape_string ( $id );
		try {
			
			$stmt = $this->db->prepare ( "INSERT INTO file (FileID, Filename, Content, Comment, Path, Type, Time, Version, Hash, User, Locked)
		SELECT FileID, Filename, Content, Comment, Path, Type, Time, Version, Hash, User, Locked
		FROM deletedfile where FileID = ?" );
			
			$stmt->bind_param ( 'i', $fileID );
			$stmt->execute ();
			$stmt->close ();
			
			$stmt = $this->db->prepare ( "SELECT MAX(ID) FROM deletedfile WHERE FileID = ?" );
			$stmt->bind_param ( 'i', $fileID );
			$stmt->execute ();
			$stmt->bind_result ( $ID );
			
			if ($stmt->fetch ()) {
				$MyFileID = $ID;
			}
			$stmt->close ();
			
			$stmt = $this->db->prepare ( "SELECT * FROM deletedfile WHERE ID=?" );
			$stmt->bind_param ( 'i', $MyFileID );
			
			$stmt->execute ();
			$stmt->bind_result ( $ID, $FileID, $Filename, $Content, $Comment, $Path, $Type, $Time, $Version, $Hash, $User, $this->Locked );
			
			// If this failes, the ID doesn't exist in table
			if ($stmt->fetch ()) {
				
				$file = new File ( 0, $FileID, $Filename, $Content, $Comment, $Path, $Type, $Time, $Version, $Hash, $User, $this->Locked );
				$file->writeFile ();
			}
			$stmt->close ();
			
			$stmt = $this->db->prepare ( "DELETE FROM deletedfile WHERE FileID=?" );
			$stmt->bind_param ( 'i', $fileID );
			$stmt->execute ();
			$stmt->close ();
		} catch ( Exception $e ) {
			return $failureMessage . $e;
		}
		return $successMessage;
	}
	
	/**
	 * @param int $id        	
	 * @param int $fileId        	
	 * @param string $user        	
	 */
	function restoreSingleFile($id, $fileId, $user) {
		$_Id = $this->db->real_escape_string ( $id );
		$_fileID = $this->db->real_escape_string ( $fileId );
		try {
			date_default_timezone_set ( 'Europe/Oslo' );
			$Time = date ( 'Y/m/d H:i:s' );
			$newfile = $this->getFile ( $_Id );
			$Version = $this->getHighestVersionByFileid ( $_fileID );
			$Version ++;
			$stmt = $this->db->prepare ( "INSERT INTO file (FileID, Filename, Content, Comment, Path, Type, Time, Version, Hash, User, Locked)
			VALUES(?,?,?,?,?,?,?,?,?,?, ?)" );
			$Filename = $newfile->getFilename ();
			$Content = $newfile->getContent ();
			$Comment = $newfile->getComment ();
			$Path = $newfile->getPath ();
			$Type = $newfile->getType ();
			$Hash = $newfile->getHash ();
			$stmt->bind_param ( 'issssisissi', $_fileID, $Filename, $Content, $Comment, $Path, $Type, $Time, $Version, $Hash, $user, $this->Locked );
			$stmt->execute ();
			
			$file = new File ( 0, $_fileID, $Filename, $Content, $Comment, $Path, $Type, $Time, $Version, $Hash, $user, $this->Locked );
			$file->writeFile ();
		} catch ( Exception $e ) {
			return "error" . $e->getMessage ();
		}
		return "Single file restored with filename: " . $Filename;
	}
	
	/**
	 * Method for getting the highest version of a file by fileid
	 * 
	 * @param int $fileId        	
	 * @return File|NULL
	 */
	function getHighestVersionByFileid($fileId) {
		$stmt = $this->db->prepare ( "SELECT MAX(Version) FROM file WHERE FileID=?" );
		$_fileId = $this->db->real_escape_string ( $fileId ); // Vasker input
		$stmt->bind_param ( 'i', $_fileId );
		
		$stmt->bind_result ( $_fileId );
		$stmt->execute ();
		
		if ($stmt->fetch ())
			return $_fileId;
		else
			return false;
	}
	
	/**
	 * @param int $id     
	 *    	
	 * @return string Message
	 */
	function lockFile($id) {
		$fileID = $this->db->real_escape_string ( $id );
		$stmt = $this->db->prepare ( "UPDATE file SET Locked = true WHERE FileID = ?" );
		$stmt->bind_param ( 'i', $fileID );
		$stmt->execute ();
	}
	
	/**
	 * @param int $id        	
	 * 
	 * @return string Message
	 */
	function unlockFile($id) {
		$fileID = $this->db->real_escape_string ( $id );
		$stmt = $this->db->prepare ( "UPDATE file SET Locked = false WHERE FileID = ?" );
		$stmt->bind_param ( 'i', $fileID );
		$stmt->execute ();
	}
	
	/**
	 * Method for getting alert actions from DB
	 * 
	 * @return array of AlertAction:
	 */
	function getAlertActions() {
		// preparing query
		$stmt = $this->db->prepare ( "SELECT * FROM alertactions" );
		
		$result = [ ];
		
		$stmt->execute ();
		
		$stmt->bind_result ( $id, $action, $variable, $comment );
		
		while ( $stmt->fetch () ) {
			
			$alertaction = new AlertAction ( $action, $variable, $comment );
			$alertaction->setID ( $id );
			array_push ( $result, $alertaction );
		}
		return $result;
	}
	
	/**
	 * Method for creating alert actions.
	 * 
	 * @param string $action        	
	 * @param string $variable        	
	 * @param string $comment        	
	 */
	function createAlertAction($action, $variable, $comment) {
		$stmt = $this->db->prepare ( "INSERT INTO alertactions (Action, Variable, Comment) VALUES (?,?,?)" );
		$stmt->bind_param ( "sss", $action, $variable, $comment );
		$stmt->execute ();
	}
	
	/**
	 * Method for deleting alert actions
	 * 
	 * @param int $id        	
	 */
	function deleteAlertAction($id) {
		$actionID = $this->db->real_escape_string ( $id ); // washes input
		$stmt = $this->db->prepare ( "DELETE FROM alertactions WHERE ID=?" );
		$stmt->bind_param ( 'i', $actionID );
		$stmt->execute ();
	}
	
	/**
	 * Destructor for closing the db connection.
	 */
	function __destruct() {
		$this->db->close ();
	}
}
?>