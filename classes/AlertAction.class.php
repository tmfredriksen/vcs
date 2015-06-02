<?php
/**
 * Object class for alert action definitions. Class is used by Alert Model and DB.class to store new, or get existing alert action.
 * @author Eivind Skreddernes
 *
 */
class AlertAction implements JsonSerializable {
	private $id;
	private $action;
	private $variable;
	private $comment;

	/**
	 * Constructor for create an alertaction object
	 * @param string $action
	 * @param string $variable
	 * @param string $comment
	 */
	function __construct($action, $variable, $comment) {
		$this->action = $action;
		$this->variable = $variable;
		$this->comment = $comment;
	}
	
	public function jsonSerialize()
	{
		return [
				'action' => $this->action,
				'variable' => $this->variable,
				'comment' => $this->comment
		];
	}

	public function setID($id){
		$this->id = $id;
	}
	public function getID(){
		return $this->id;
	}
	public function setAction($action) {
		$this->action = $action;
	}
	public function getAction(){
		return $this->action;
	}
	public function setVariable($variable) {
		$this->variable = $variable;
	}
	public function getVariable(){
		return $this->variable;
	}
	public function setComment($comment) {
		$this->comment = $comment;
	}
	public function getComment() {
		return $this->comment;
	}
}
?>