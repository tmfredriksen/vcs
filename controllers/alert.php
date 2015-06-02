<?php
/**
 * alert.php
 * @author Tord-MariusK
 * @name Alert controller
 * 
 */
class Alert extends BaseController 
{
	/*
	 * --Start of views--
	 * returns data to be assigned to the view template through smarty-assign
	 * See each method in basemodel for more information.
	 */
	protected function index() {
		$viewmodel = new AlertModel ();
		$this->ReturnView ( $viewmodel->viewIndex (2), true );
	}
	protected function create() {
		$viewmodel = new AlertModel ();
		$this->ReturnView ( $viewmodel->viewCreate (), true );
	}
	protected function recentlyChanged() {
		$viewmodel = new AlertModel ();
		$this->ReturnView ( $viewmodel->viewRecentlyChanged(), true );
	}
	protected function fileHistory() {
		$viewmodel = new AlertModel();
		$this->ReturnView($viewmodel->viewFileHistory(2), true);
	}
	protected function restoreDeleted() {
		$viewmodel = new AlertModel ();
		$this->ReturnView ( $viewmodel->viewRestoreDeleted (2), true );
	}
	protected function settings() {
		$viewmodel = new AlertModel();
		$this->ReturnView($viewmodel->settings(), true);
	}
	/*
	 * --End of views--
	 */
	
	/**
	 * Creates new alert file. Data is received from an AJAX-request.
	 */
	protected function createFile() {
		$json = json_decode(file_get_contents("php://input"));
		$viewmodel = new AlertModel();
		return $viewmodel->createFile($json, 2);
	}
	
	/**
	 *  Saves changes in file. Data is received from an AJAX-request.
	 */
	protected function editFile() {
		$json = json_decode(file_get_contents("php://input"));
		$viewmodel = new AlertModel();
		return $viewmodel->editFile($json, 2);
	}
	
	/**
	 * Deletes file. ID to which file to be deleted, is retrieved from AJAX-request.
	 */
	protected function deleteFile() {
		$json = json_decode(file_get_contents("php://input"));
		$viewmodel = new AlertModel ();
	return $viewmodel->deleteFile($json);	
	}
	
	/**
	 * Mehtod for restoring a file.
	 */
	protected function restoreFile() {
		$json = json_decode(file_get_contents("php://input"));
		$viewmodel = new AlertModel();
		return $viewmodel->restoreFile($json);
	}
	/**
	 * Restores a single file.
	 */
	protected function restoreSingleFile(){
		$json = json_decode(file_get_contents("php://input"));
		$viewmodel = new AlertModel();
		return $viewmodel->restoreSingleFile($json);
	}
	/**
	 * Get all files from one FileID.
	 */
	protected function getFilesOfFileID() {
		$viewmodel = new AlertModel();
		$json = json_decode(file_get_contents('php://input'));
		return $viewmodel->getFilesOfFileID($json, 2);
	}
	
	/**
	 * Get file by fileID.
	 */
	protected function getFile() {
		$json = json_decode(file_get_contents("php://input"));
		$viewmodel = new AlertModel();
		return $viewmodel->getFile($json);
	}
	
	/**
	 * Lock file when someone starts editing to lock the file.
	 */
	protected function lockFile() {
		$json = json_decode(file_get_contents("php://input"));
		$viewmodel = new AlertModel();
		return $viewmodel->lockFile($json);
	}
	
	/**
	 * Unlock file when editing is done.
	 */
	protected function unlockFile() {
		$json = json_decode(file_get_contents("php://input"));
		$viewmodel = new AlertModel();
		return $viewmodel->unlockFile($json);
	}
	
	/**
	 * Find differences in two respective fileversions.
	 */
	protected function calculateDiff() {
		$viewmodel = new AlertModel();
		$json = json_decode(file_get_contents('php://input'));
		return $viewmodel->calculateDiff($json);
	}
	/**
	 * See method information in alert model class
	 */
	protected function ldapSearch(){
		$viewmodel = new AlertModel();
		return $viewmodel->ldapSearch();
	}
	
	/**
	 * See method information in alert model class
	 */
	protected function alertActions(){
		$viewmodel = new AlertModel();
		return $viewmodel->alertActions();
	}
}
?>