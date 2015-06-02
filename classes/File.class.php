<?php
/**
 * File class that creates a object of a file
 * @author Eivind Skreddernes, Tommy Langhelle, Tord-Marius Fredriksen
 *
 */
class File implements JsonSerializable
{
	private $ID;
	private $fileID;
	private $filename;
	private $content;
	private $comment;
	private $path;
	private $type;
	private $time;
	private $version;
	private $hash;
	private $user;
	private $locked;
	
	
	function __construct($ID, $fileID, $filename, $content, $comment, $path, $type, $time, $version, $hash, $user, $locked)
	{
		$this->ID = $ID;
		$this->fileID = $fileID;
		$this->filename = $filename;
		$this->content = $content;
		$this->comment = $comment;
	    $this->path = $path;
		$this->type = $type;
		$this->time = $time;
		$this->version = $version;
		$this->hash = $hash;
		$this->user = $user;
		$this->locked = $locked;	
	}

	public function jsonSerialize()
	{
		return [
				'ID' => $this->ID,
				'FileID' => $this->fileID,
				'Filename' => $this->filename,			
				'Content' => htmlspecialchars_decode($this->content), //Convert special HTML entities back to characters(For alert)
				'Comment' => $this->comment,
				'Path' => $this->path,
				'Type' => $this->type,
				'Time' => $this->time,
				'Version' => $this->version,
				'Hash' => $this->hash,
				'User' => $this->user,
				'Locked' => $this->locked
		];
	}
	public function getID() {
		return $this->ID;
	}
	public function setID($ID) {
		$this->ID = $ID;
	}
	public function getFileID() {
		return $this->fileID;
	}
	public function setFileID($fileID) {
		$this->fileID = $fileID;
	}
	public function getFilename() {
		return $this->filename;
	}
	public function setFilename($filename) {
		$this->filename = $filename;
	}
	public function getContent() {
		return htmlspecialchars_decode($this->content);
	}
	public function setContent($content) {
		$this->content = $content;
	}
	public function getComment() {
		return $this->comment;
	}
	public function setComment($comment) {
		$this->comment = $comment;
	}
	public function getPath() {
		return $this->path;
	}
	public function setPath($path) {
		$this->path = $path;
	}
	public function getType() {
		return $this->type;
	}
	public function setType($type) {
		$this->type = $type;
	}
	public function getTime() {
		return $this->time;
	}
	public function setTime($time) {
		$this->time = $time;
	}
	public function getVersion() {
		return $this->version;
	}
	public function setVersion($version) {
		$this->version = $version;
	}
	public function getHash() {
		return $this->hash;
	}
	public function setHash($hash) {
		$this->hash = $hash;
	}
	public function getUser() {
		return $this->user;
	}
	public function setUser($user) {
		$this->user = $user;
	}
	public function getLocked() {
		return $this->locked;
	}
	public function setLocked($locked) {
		$this->locked = $locked;
	}
	/**
	 * This method writes file to system disk. Path root can be changed in Config.php
	 */
	public function writeFile() {
		$isDir = is_dir($this->path);
		if($this->type === 3){
			$this->path = path::$swatch;
		}
		else if($this->type === 2){
			$this->path = path::$alert;
		}
		else {
			$this->path  = path::$manualsource;
		}		
		$File = $this->filename;
		$Handle = fopen ( $this->path . $File, 'w' );
		$Data = $this->content;
		fwrite ( $Handle, $Data );
		fclose ( $Handle );
	}
}
?>