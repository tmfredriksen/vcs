<?php

/**
 * manualsource.php
 * @author Tommy Langhelle
 * @name Manual Source controller
 *
 */
class Manualsource extends BaseController 
{
	/*
	 * --Start of views--
	 * returns data to be smarty assigned to the view template
	 * See each method in basemodel for more information.
	 */
	protected function index() {
		$viewmodel = new ManualsourceModel();
		$this->ReturnView($viewmodel->viewIndex(1), true);
	}
	protected function create() {
		$viewmodel = new ManualsourceModel();
		$this->ReturnView($viewmodel->viewCreate(), true);
	}
	protected function recentlyChanged() {
		$viewmodel = new ManualsourceModel();
		$this->ReturnView($viewmodel->viewRecentlyChanged(), true);
	}
	protected function fileHistory() {
		$viewmodel = new ManualsourceModel();
		$this->ReturnView($viewmodel->viewFileHistory(1), true);
	}
	protected function RestoreDeleted() {
		$viewmodel = new ManualsourceModel();
		$this->ReturnView($viewmodel->viewRestoreDeleted(1), true );
	}
	/*
	 * --End of views--
	 */
	
	protected function createFile() {
		$json = json_decode(file_get_contents("php://input"));
		$viewmodel = new ManualsourceModel();
		return $viewmodel->createFile($json, 1);
	}
	
	protected function editFile() {
		$viewmodel = new ManualsourceModel();
		$json = json_decode(file_get_contents('php://input'));
		return $viewmodel->editFile($json, 1);
	}

	protected function deleteFile() {
		$viewmodel = new ManualSourceModel();
		$json = json_decode(file_get_contents("php://input"));
		return $viewmodel->deleteFile($json);
	}

	protected function restoreFile() {
		$json = json_decode(file_get_contents("php://input"));
		$viewmodel = new ManualSourceModel();
		return $viewmodel->restoreFile($json);
	}

	protected function restoreSingleFile(){
		$json = json_decode(file_get_contents("php://input"));
		$viewmodel = new ManualsourceModel();
		return $viewmodel->restoreSingleFile($json);
	}

	protected function getFilesOfFileID() {
		$viewmodel = new ManualsourceModel();
		$json = json_decode(file_get_contents('php://input'));
		return $viewmodel->getFilesOfFileID($json, 1);
	}
	
	protected function getFile() {
		$json = json_decode(file_get_contents("php://input"));
		$viewmodel = new ManualsourceModel();
		return $viewmodel->getFile($json);
	}
	protected function getFileView() {
		$json = json_decode(file_get_contents("php://input"));
		$viewmodel = new ManualsourceModel();
		return $viewmodel->getFileView($json);
	}

	protected function lockFile() {
		$json = json_decode(file_get_contents("php://input"));
		$viewmodel = new ManualsourceModel();
		return $viewmodel->lockFile($json);
	}
	
	protected function unlockFile() {
		$json = json_decode(file_get_contents("php://input"));
		$viewmodel = new ManualsourceModel();
		return $viewmodel->unlockFile($json);
	}

	protected function calculateDiff() {
		$viewmodel = new ManualsourceModel();
		$json = json_decode(file_get_contents('php://input'));
		return $viewmodel->calculateDiff($json);
	}
}
?>