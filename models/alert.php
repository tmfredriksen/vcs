<?php
/**
 * alert.php
 * @author Tord-MariusK
 * BaseModel takes care of most requests.
 *
 */
class AlertModel extends BaseModel {
	/**
	 * Returns ldap-names when creating alert file
	 */
	public function ldapSearch(){
		$result = @ldapSearch();
		echo json_encode($result);
	}
	/**
	 * Returns list of alert actions to be shown in create view. 
	 */
	public function alertActions(){
		$result = $this->database->getAlertActions();
		echo json_encode($result);
	}
	public function Settings() {
		return $this->database->getAlertActions ();
	}
}
?>