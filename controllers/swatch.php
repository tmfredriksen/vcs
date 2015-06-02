<?php
/**
 * swatch.php
 * @author Eivind Skreddernes
 * @name Swatch controller
 */

class Swatch extends BaseController 
{
	/*
	 * --Start of views--
	 * returns data to be smarty assigned to the view template
	 * See each method in basemodel for more information.
	 */
	protected function index() {
		$viewmodel = new SwatchModel();
		$this->ReturnView($viewmodel->viewIndex(3), true);
	}
	
	protected function create() {
		$viewmodel = new SwatchModel();
		$viewmodel->setValue($_GET["id"]);
		$this->ReturnView($viewmodel->viewCreateNew(), true);
	}
	
	protected function recentlyChanged() {
		$viewmodel = new SwatchModel();
		$this->ReturnView($viewmodel->viewRecentlyChanged(), true);
	}
	
	protected function fileHistory() {
		$viewmodel = new SwatchModel();
		$this->ReturnView($viewmodel->viewFileHistory(3), true);
	}
	
	protected function restoreDeleted() {
		$viewmodel = new SwatchModel();
		$this->ReturnView ( $viewmodel->viewRestoreDeleted (3), true );
	}
	/*
	 * --End of views--
	 */
	
	protected function createFile() {
		$viewmodel = new SwatchModel();
		//http://samcroft.co.uk/2014/php-json-encode-decode-functions-tutorial/
		//http://stackoverflow.com/questions/10947483/submitting-json-data-via-jquery-ajax-post-to-php
		//For fetching JSON object from POST, use php://input stream wrapper. Accessing input stream will allow reading the raw request body.
		$json = json_decode(file_get_contents("php://input"));
		return $viewmodel->createFile($json, 3);
	}
	protected function createNew() {
		$viewmodel = new SwatchModel();
		
		$json = json_decode(file_get_contents("php://input"));
		return $viewmodel->viewCreateNew($json);
	}

	protected function editFile() {
		$viewmodel = new SwatchModel();
		$json = json_decode(file_get_contents("php://input"));
		return $viewmodel->editFile($json, 3);
	}
	
	protected function deleteFile() {
		$viewmodel = new SwatchModel();
		$json = json_decode(file_get_contents("php://input"));
		return $viewmodel->deleteFile($json);
	}
	
	protected function restoreFile() {
		$json = json_decode(file_get_contents("php://input"));
		$viewmodel = new SwatchModel();
		return $viewmodel->restoreFile($json);
	}

	protected function restoreSingleFile(){
		$json = json_decode(file_get_contents("php://input"));
		$viewmodel = new SwatchModel();
		return $viewmodel->restoreSingleFile($json);
	}

	protected function getFilesOfFileID() {
		$viewmodel = new SwatchModel();
		$json = json_decode(file_get_contents('php://input'));
		return $viewmodel->getFilesOfFileID($json, 3);
	}

	protected function getFile() {
		$json = json_decode(file_get_contents("php://input"));
		$viewmodel = new SwatchModel();
		return $viewmodel->getFile($json);
	}
	
	protected function lockFile() {
		$json = json_decode(file_get_contents("php://input"));
		$viewmodel = new SwatchModel();
		return $viewmodel->lockFile($json);
	}
	
	protected function unlockFile() {
		$json = json_decode(file_get_contents("php://input"));
		$viewmodel = new SwatchModel();
		return $viewmodel->unlockFile($json);
	}

	protected function calculateDiff() {
		$viewmodel = new SwatchModel();
		$json = json_decode(file_get_contents('php://input'));
		return $viewmodel->calculateDiff($json);
	}
}
?>