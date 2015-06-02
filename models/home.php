<?php
/**
 * 
 * @author Eivind Skreddernes, Tord-Marius Fredriksen
 *	
 */
class HomeModel extends BaseModel {
	
	// Start of views
	public function Index() {
	}
	
	public function Login() {
	}
	
	public function Logout() {
	}
	
	//End of views
	
	/**
	 * For loggin in to the system
	 * @param JsonSerializable $json(username and password)
	 */
	public function LoginWithLDAP($json) {
		$username = $json->username;
		$password = $json->password;
		
		try {
			$log = ldaplogin ( $username, $password );
			if (strcmp ( $log, 'login' ) == 0) {
				
				echo json_encode ( "ok" );
			}
			else {
				echo json_encode ("error" . $log);
			}
		} catch ( Exception $e ) {
			echo json_encode ( "error" . $e->getMessage () );
		}
	}

	/**
	 * Method for creating a new alert action
	 * @param JsonSerializable $json(object)
	 */
	public function createAlertAction($json) {
		
		try {
			
			$this->database->createAlertAction($json->action, $json->variable, $json->comment);
			echo json_encode("success");
		}
		catch (Exception $e){
			echo json_encode("error" . $e->getMessage());
		}
		
	}
	
	/**
	 * Method for deleting a alert action 
	 * @param JsonSerializable $json(id for alertaction)
	 */
	public function deleteAlertAction($json) {
		try {
			$this->database->deleteAlertAction($json->id);
			echo json_encode("Action deleted");
		} catch (Exception $e) {
			echo json_encode("error" . $e->getMessage());
		}
	}
}
?>