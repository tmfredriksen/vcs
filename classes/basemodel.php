<?php
/**
 * basemodel.php
 * @author Eivind Skreddernes, Tord-Marius Fredriksen, Tommy Langhelle
 * Abstract class acting as base for all models. Assigns the models a database connection.
 * 
 * 10.04.2015
 * 
 **/
abstract class BaseModel {
	protected $database; //database connection
	private $file; //file can either contain an alert, manual source or swatch
	private $user; //user object. See User.class.php in folder classes.
	private $value; //ID. Used by swatch
	
	public function __construct() {
		$this->database = new DB();	
		
		// Checks if the sessions is set(user)
		if(isset($_SESSION['user']))
			$this->user = $_SESSION['user'];
		
	}	
	
	/** 
	 * Used as ID by swatch
	 * @param $value
	 */
	public function setValue($value) {
		$this->value = $value;
	}
	
	/**
	 * Puts value to frontend. Used by swatch.
	 * @return string
	 */
	public function viewCreateNew() {
		if (isset ( $this->value )) {
			$file = $this->database->getFile ( $this->value );
			if ($file != null) {
				return $file->getContent ();
			}
		}
	}
	
	/**
	 * Returns IDs of all files to be displayed.
	 * @param int $type (1 for manual source, 2 for alerts and 3 for Swatch)
	 * @return multitype:
	 */
	public function viewIndex($type) {
		$filetree = [ ];
		
		$Mainfile = $this->database->getFileIDs ( $type );
		
		foreach ( $Mainfile as $mainfile ) {
			$files = $this->database->getFiles ( $type, $mainfile );
		
			array_push ( $filetree, $files );
		}
		return $filetree;	
	}
	
	public function viewCreate() {
	}
	
	/**
	 * View all recently changed files.
	 * @return multitype:multitype:
	 */
	public function viewRecentlyChanged() {
		$arrayOfArrays = [];
		
		for($i = 1; $i <= 3; $i++){
			$arrayOfArrays[$i-1] = $this->database->getLastFiveFiles($i);
		}
		 return $arrayOfArrays;
	}
	
	/**
	 * View file history, to restore old files.
	 * @param int $type (1 for manual source, 2 for alerts and 3 for Swatch)
	 * @return multitype:
	 */
	public function viewFileHistory($type) {
		$files = $this->database->getActiveFiles ( $type );
		return $files;
	}
	
	/**
	 * View deleted files.
	 * @param int $type (1 for manual source, 2 for alerts and 3 for Swatch)
	 * @return multitype:
	 */
	public function viewRestoreDeleted($type) {
		$result = [ ];
	
		$CurrentFile = $this->database->getNewestVersionOfDeletedFile ( $type );
	
		foreach ( $CurrentFile as $current ) {
			$files = $this->database->getDeletedFiles ( $type, $current );
				
			array_push ( $result, $files );
		}
	
		return $result;
	}
	
	/**
	 *	Method for creating file 
	 * @param JsonSerializable $json()
	 * @param int $type (1 for manual source, 2 for alerts and 3 for Swatch)
	 */
	public function createFile($json, $type) {
		$fileid = null; //if fileID is null, DB reacts like this is a new file. Se DB.class.php.
		$version = null; //version 1 is set in DB.class.php.
		$filename = $json->filename;
		$type = $json->type;
		$hash;
		if($type == 1) //1 equals manualSource in database. Content of manualsource comes as an array.
		{	
			$content = implode ( "\n", $json->content );
			$hash = md5 ( $content );
			$filename = $json->filename . ".conf";
		}
		else if($type == 2)
		{
			$content = $json->content;
			$hash = md5 ( $content );
			$filename = $json->filename . ".xml";
		}
		else {
			$content = $json->content;
			$hash = md5 ( $content );
			$filename = $json->filename . ".txt";
		}
		$comment = $json->comment;
		$path = $json->path;
	
		try {
			if (! empty ( $json->filename ) && ! empty ( $json->content ) && ! empty ( $json->path )) {

				
				//Creating new file. json_encode to send success message back to frontend.
				$this->file = $this->database->createFile($fileid, $filename, htmlspecialchars($content), $comment, $path, $type, $version, $hash, $this->user); 
				echo json_encode ( "<strong>Success!</strong> New File with filename " . $this->file->getFilename() . " created!" );
			}
			else {
				echo json_encode ( "<strong>ERROR! </strong> Something is wrong with input.");
	
			}
		}catch (Exception $e) {
			echo json_encode ( "<strong>ERROR! </strong> Something is wrong! Error code: " . $e );
	
		}
	}
	
	/**
	 * Edit file. Methos is called by AJAX, and success or failure message is returned by json_encode.
	 * @param JsonSerializable $json object file
	 * @param int $type (1 for manual source, 2 for alerts and 3 for Swatch)
	 */
	public function editFile($json, $type) {
		try {
			$hash = md5 ( $json->content );
			$file = $this->database->getFile ( $json->id );
			/*
			 * Check if the content is not the same.
			 */
			if (strcmp ( $file->getHash (), $hash ) == 0) {
				echo json_encode ( "File with this content allready exist" );
			} 
			else {
				$this->database->unlockFile($json->fileid); 
				$this->database->createFile ( $json->fileid, $json->filename,  htmlspecialchars($json->content), $json->comment, $json->filepath, $type, $json->version, $hash, $this->user );
				echo json_encode ( "Success" );
			}
		} catch ( Exception $e ) {
			echo json_encode ( "Error code: " . $e->getMessage () );
		}
	}
	
	/**
	 * Method for deleting a file from the db
	 * @param JsonSerializable $json (json->id, contains file_id for a file)
	 */
	public function deleteFile($json) {
		try {
			$file = $this->database->getFile ( $json->id );
			
			/*
			 * Check if the file is locked before deleting.
			*/
			if ($file->getLocked () === 1) {
				echo json_encode ( "Can't delete file. It is being edited" );
			} else {
				$result = $this->database->delete ( $json->fileid );
				echo json_encode ( "Result from DB: " . $result );
			}
		} catch (Exception $e) {
			echo json_encode("Error: " . $e->getMessage());
		}
		
	}
	
	/**
	 * @param JsonSerializable $json (json->id, contains id for a file)
	 */
	public function restoreFile($json) {
		$result = $this->database->restoreDeletedFile($json->id);
		echo json_encode ( "Result from DB: " . $result);
	}
	
	/**
	 * Restores a single file by id
	 * @param JsonSerializable $json (json->id, contains id for a file)
	 */
	public function restoreSingleFile($json) {
		try {
			$result = $this->database->restoreSingleFile($json->id, $json->fileid, $this->user);
			echo json_encode("Result from DB: " . $result);
		} catch (Exception $e) {
			echo json_encode("Error: " . $e->getMessage());
		}
	}
	
	/**
	 * Get all files from one fileID (all versions of a file).
	 * @param int $FileID
	 * @param int $type (1 for manual source, 2 for alerts and 3 for Swatch)
	 */
	public function getFilesOfFileID($FileID, $type) {
		try {
			$files = $this->database->getFiles ( $type, $FileID );
			echo json_encode ( $files );
		} catch (Exception $e) {
			echo json_encode("Error: " . $e->getMessage());
		}	
	}
	
	/**
	 * Method for getting a file. Called when you start editing a file. 
	 * @param JsonSerializable $json (json->id, contains id for a file)
	 */
	public function getFile($json) {
		try {
			$result = $this->database->getFile( $json->id );
			/*
			 * Checks if the file is locked or not. If it is not locked it is set to locked.
			 * returns the file to the view.
			*/
			if($result->getLocked() === 0){
				$this->database->lockFile($result->getFileID());
				echo json_encode ( $result );
			
			}
			else {
				echo json_encode(array("File" => "File is beeing edited!"));
			}
		} catch (Exception $e) {
			echo json_encode("Error: " . $e->getMessage());
		}
	}
	
	/**
	 * Method for getting file to view. Only for reading a file.
	 * @param JsonSerializable $json (json->id, contains id for a file)
	 */
	public function getFileView($json){
		try {
			$result = $this->database->getFile( $json->id );
			echo json_encode($result);
		} catch (Exception $e) {
			echo json_encode("Error: " . $e->getMessage());
		}
	
	}
	
	/**
	 * Unlock a file.
	 * @param JsonSerializable $json (json->id, contains id for a file)
	 */
	public function unlockFile($json) {
		try {
			$result = $this->database->unlockFile($json->id);
			echo json_encode ( "Unlocked!");
		} catch (Exception $e) {
			echo json_encode("Error: " . $e->getMessage());
		}
	}
	
	/**
	 *  Locks a file
	 * @param JsonSerializable $json (json->id, contains id for a file)
	 */
	public function lockFile($json) {
		try {
			$result = $this->database->lockFile($json->fileid);
			echo json_encode ( "Locked!");
		} catch (Exception $e) {
			echo json_encode("Error: " . $e->getMessage());
		}
	}
	
	/**
	 * Calculates the difference between two files
	 * @param JsonSerializable $json
	 */
	public function calculateDiff($json)
	{
		try {
			$oldString = $json->oldString;
			$newString = $json->newString;
			
			$diff = Diff::compare($oldString, $newString);
			$toHTML = Diff::toHTML($diff);
			
			echo json_encode($toHTML);
		} catch (Exception $e) {
			echo json_encode("Error: " . $e->getMessage());
		}
	
	}
}
?>