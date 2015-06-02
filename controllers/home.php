<?php
/**
 * 
 * @author Tord-Marius Fredriksen
 *
 */

class Home extends BaseController 
{
	/*
	 * --Start of views--
	 * returns data to be smarty assigned to the view template
	 * See each method in basemodel for more information.
	 */
	protected function index() {
		$viewmodel = new HomeModel();
		$this->ReturnView($viewmodel->Index(), true);
	}
	protected function login() {
		$viewmodel = new HomeModel();
		$this->ReturnView($viewmodel->Login(), true);
	}
	
	/*
	 * --End of views--
	 */
	
	protected function loginWithLDAP() {
		$json = json_decode(file_get_contents("php://input"));
		$viewmodel = new HomeModel();
		return $viewmodel->LoginWithLDAP($json);
	}
		
	protected function settings() {
		$viewmodel = new HomeModel();
		$this->ReturnView($viewmodel->settings(), true);
	}

	protected function createAlertAction() {
		$viewmodel = new HomeModel();
		$json = json_decode(file_get_contents("php://input"));
		return $viewmodel->createAlertAction($json);
	}

	protected function deleteAlertAction(){
		$viewmodel = new HomeModel();
		$json = json_decode(file_get_contents("php://input"));
		return $viewmodel->deleteAlertAction($json);
	}

	protected function logout() {
		session_destroy();		
		$viewmodel = new HomeModel();
		$this->ReturnView($viewmodel->Login(), true);
	}
}
?>