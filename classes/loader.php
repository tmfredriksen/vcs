<?php

/**
 * 
 * loader.php
 * Class that handles URL values, and is used by Index.php to run the correct controller and action(method).
 *
 */
class Loader {
	private $controller; //string for controller name
	private $action; //string for method name
	private $urlvalues; //array holding controller and method name
	
	/**
	 * store URL values on object creation
	 * @param  $urlvalues
	 */
	public function __construct($urlvalues) {

		$this->urlvalues = $urlvalues;
		/**
		 * If used is logged in, controller and action is run.
		 */
		if (isset($_SESSION['authorized']) && $_SESSION['authorized']){
			
			if ($this->urlvalues ['controller'] == "") {
				$this->controller = "home";
			} else {
				$this->controller = $this->urlvalues ['controller'];
			}
			if ($this->urlvalues ['action'] == "") {
				$this->action = "index";
			} else {
				$this->action = $this->urlvalues ['action'];
			}
		}
		
		else if ($this->urlvalues ['action'] == "LoginWithLDAP") {
			$this->controller = "home";
			$this->action = "LoginWithLDAP";	
		}
			
		else {
			$this->controller = "home";
			$this->action = "login";
		}
	}
	
	/**
	 * makes the requested controller an object
	 * @return string
	 */
	public function CreateController() {
		// checks if the class exists
		if (class_exists ( $this->controller )) {
			$parents = class_parents ( $this->controller );
			// checks if the class extend the base controller
			if (in_array ( "BaseController", $parents )) {
				// does the class contain the requested method?
				if (method_exists ( $this->controller, $this->action )) {
					return new $this->controller ( $this->action, $this->urlvalues );
				} else {
					// bad method error
					return "Bad URL! " . implode ( $this->urlvalues ) . " does not exist.";
				}
			} else {
				// bad controller error
				return "Bad URL! " . implode ( $this->urlvalues ) . " does not exist.";
			}
		} else {
			// bad controller error
			return "Bad URL! " . implode ( $this->urlvalues ) . " does not exist.";
		}
	}
}
?>
