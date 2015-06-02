<?php
/**
 * User class that creates a object of a ldap-user.
 * @author Eivind Skreddernes
 *
 */

class User {
	
	private $ID;
	private $username;
	private $email;
	private $password;
	private $surname;
	private $givenname;
	private $group;
	private $userAgent;
	private $ipAdress;

	function __construct($username, $email, $givenname, $surname, $group){
		
		$this->group = $group;
		$this->surname = $surname;
		$this->givenname = $givenname;
		$this->email = $email;
		$this->username = $username;
		$this->ipAdress = $_SERVER["REMOTE_ADDR"];
		$this->userAgent = $_SERVER['HTTP_USER_AGENT'];
	}
	
	public function getGroup()
	{
		return $this->group;
	}
	
	public function setGroup($value)
	{
		$this->group = $value;
	}
	public function getGivenname()
	{
		return $this->givenname;
	}
	
	public function setGivenname($value)
	{
		$this->givenname = $value;
	}
	 
	public function getSurname()
	{
		return $this->surname;
	}
	
	public function setSurname($value)
	{
		$this->surname = $value;
	}
	
	public function getPassword() 
	{
	  return $this->password;
	}
	
	public function setPassword($value) 
	{
	  $this->password = $value;
	}
	    
	public function getEmail() 
	{
	  return $this->email;
	}
	
	public function setEmail($value) 
	{
	  $this->email = $value;
	}
	    
	public function getID() 
	{
	  return $this->ID;
	}
	
	public function setID($value) 
	{
	  $this->ID = $value;
	}
	    
	public function getUsername() 
	{
	  return $this->username;
	}
	
	public function setUsername($value) 
	{
	  $this->username = $value;
	}
	/**
	 * To avoid session hijacking.
	 */
	public function verify() {
		if(($this->ipAdresse == $_SERVER["REMOTE_ADDR"])
				&& ($this->userAgent == $_SERVER['HTTP_USER_AGENT'] )){
			return true;
		}
		else
			return false;
			
	}
	public function __toString() {
		
		return "Name: " . $this->givenname . " Surname: " . $this->surname . " Email: " . $this->email . " Username: " . $this->username . " Groups: " . $this->group;
	}
	
}

?>