<?php
/**
 * index.php
 * This file is the center of the web application. Every request is handled here, and an action
 * is executed in chosen controller.
 * 
 */

//require the general classes
require("classes/loader.php");
require("config.php");
require("classes/basecontroller.php");
require("classes/basemodel.php");
require("classes/DB.class.php");
require("classes/Ldap.php");
require("classes/File.class.php");
require("classes/LDAP.class.php");
require("classes/User.class.php");
require("classes/Diff.php");
require("classes/Regex.class.php");
require("libs/Smarty.class.php");
require("classes/AlertAction.class.php");

//require the model classes
require("models/home.php");
require("models/manualsource.php");
require("models/alert.php");
require("models/swatch.php");

//require the controller classes
require("controllers/home.php");
require("controllers/manualsource.php");
require("controllers/alert.php");
require("controllers/swatch.php");

//include class that initiates session
include_once ('init.php');


//create the controller and execute the action
$loader = new Loader($_GET);
//if only a string is returned, it means there is no action to run
if(is_string($loader->CreateController()))
{
	echo $loader->CreateController();
}
else {
	$controller = $loader->CreateController();
	$controller->ExecuteAction();
}
?>