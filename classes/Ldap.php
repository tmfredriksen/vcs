<?php
/**
 * This class was developed and customized to work on HiN's internal LDAP system, because of lack of access to basefarm's system. 
 * Therefore it might have to be edited to be compatible to basefarm's LDAP-system.
 *
 * @author Eivind Skreddernes, Tommy Langhelle, Tord-Marius Fredriksen
 *        
 */

/**
 * Handles the connection to the LDAP system, and set a login session.
 * 
 *
 * 
 * All variables are set in the config.php file
 * @param string $username
 * @param string $bind_password
 * @return string message 
 */
function ldaplogin($username, $bind_password) {
	$adServer = ldapLogin::$adServer; //Henter statisk informasjon fra config.php
	$base_dn = ldapLogin::$base_dn; //Henter statisk informasjon fra config.php
	$sortfilter = ldapLogin::$sortfilter; //Henter statisk informasjon fra config.php
	
 	try {
		$link_identifier = ldap_connect ( $adServer ); // connection to server
		
		$bind_rdn = ldapLogin::$bind_rdn . $username;
		
		//Setting ldap option
		ldap_set_option ( $link_identifier, LDAP_OPT_PROTOCOL_VERSION, 3 );
		ldap_set_option ( $link_identifier, LDAP_OPT_REFERRALS, 0 );
		
		//Binds a connection
		$bind = @ldap_bind ( $link_identifier, $bind_rdn, $bind_password );
		
		//Checking if the bind is true
		if ($bind) {
			$filter = ldapLogin::$filter . $username . ")"; //Filter
			$result = ldap_search ( $link_identifier, $base_dn, $filter ); //Search by filter
			ldap_sort ( $link_identifier, $result, $sortfilter ); //Sorting
			$info = ldap_get_entries ( $link_identifier, $result ); //Get info from ldap by filter
			
			//Goes throug the info 
			for($i = 0; $i < $info ["count"]; $i ++) {
				if ($info ['count'] > 1)
					break;
				
				//Creating a user object 
				$user = new User ( $info [$i] ["samaccountname"] [0], $info [$i] ["mail"] [0], $info [$i] ["givenname"] [0], $info [$i] ["sn"] [0], strpbrk ( $info [$i] ["memberof"] [0], "OU" ) );
				$user->setID ( bin_to_str_sid ( $info [$i] ["objectsid"] [0] ) );
				
				$_SESSION ['authorized'] = true;
				
				$_SESSION ['user'] = $user->getSurname () . ", " . $user->getGivenname ();
				$_SESSION ['username'] = $user->getUsername ();
				return "login";
			}
			@ldap_close ( $link_identifier ); //Closing connection
		} else {
			// http://php.net/manual/en/function.ldap-error.php
			$msg = " Code: " . ldap_errno ( $link_identifier ) . " Details: " . ldap_err2str ( ldap_errno ( $link_identifier ) );
			return $msg;
		}
 	} catch ( Exception $e ) {
 		return "Error: " . $e->getMessage ();
 	}
}
/**
 * Retrieves information about customers, hostnames and damcluster, for use in the alert/create-template.
 * variables are set in config.php
 * 
 * @return string|LDAPObject
 */
function ldapSearch(){
	$adServer = ldapSearch::$adServer;
	$bind_rdn = ldapSearch::$bind_rdn;
	$password = ldapSearch::$password;
	$filter = ldapSearch::$filter;
	
	
	$link_identifier = ldap_connect ( $adServer ); // connection to hin servers
	
	ldap_set_option ( $link_identifier, LDAP_OPT_PROTOCOL_VERSION, 3 );
	ldap_set_option ( $link_identifier, LDAP_OPT_REFERRALS, 0 );
	
	$bind = @ldap_bind ( $link_identifier, $bind_rdn, $password );
	
	try{
		
		$sizelimit = 100; //max amount of results fetched from LDAP
		
		//Customer-Info from LDAP
		$base_dn = ldapCustomerSearch::$base_dn;
		$attr = ldapCustomerSearch::$attr;
		$result = ldap_search ( $link_identifier, $base_dn, $filter, $attr, 0, $sizelimit);
		$customerInfo = ldap_get_entries($link_identifier, $result);
		
		//Hostname-info from LDAP
		$base_dn = ldapHostnameSearch::$base_dn; 
		$attr = ldapHostnameSearch::$attr;
		$result = ldap_search ( $link_identifier, $base_dn, $filter, $attr, 0, $sizelimit);
		$hostNameInfo = ldap_get_entries($link_identifier, $result);
		
		//Damcluster-info from LDAP
		$base_dn = ldapDamclusterSearch::$base_dn;
		$attr = ldapDamclusterSearch::$attr;
		$result = ldap_search ( $link_identifier, $base_dn, $filter, $attr, 0, $sizelimit);
		$damclusterInfo = ldap_get_entries($link_identifier, $result);
		
	}
	catch(Exception $e){
		return "something went wrong, please contact administrator.";		
	}
	//Content in array-brackets must be updated by basefarm to match their info
	$customerArray;
	for($i = 1; $i<$customerInfo['count']; $i++){
		$customerArray[] = $customerInfo[$i][ldapCustomerSearch::$customerAttr][0];
	}
	$hostNameArray;
	for($i = 1; $i<$hostNameInfo['count']; $i++){
		$hostNameArray[] = $hostNameInfo[$i][ldapCustomerSearch::$HostnameAttr][0];
	}
	$damclusterArray;
	for($i = 1; $i<$damclusterInfo['count']; $i++){
		$damclusterArray[] = $damclusterInfo[$i][ldapCustomerSearch::$DamCluster][0];
	}
	
	$LDAPObject = new LDAPObject($customerArray, $hostNameArray, $damclusterArray);

	return $LDAPObject;
	
}

/**
 * link -> http://php.net/manual/fr/function.ldap-get-values-len.php
 * Function for handling the id from Active Directory
 * @param string $binsid
 * @return string the textual SID
 */
function bin_to_str_sid($binsid) {
	$hex_sid = bin2hex ( $binsid );
	$rev = hexdec ( substr ( $hex_sid, 0, 2 ) );
	$subcount = hexdec ( substr ( $hex_sid, 2, 2 ) );
	$auth = hexdec ( substr ( $hex_sid, 4, 12 ) );
	$result = "$rev-$auth";
	
	for($x = 0; $x < $subcount; $x ++) {
		$subauth [$x] = hexdec ( little_endian ( substr ( $hex_sid, 16 + ($x * 8), 8 ) ) );
		$result .= "-" . $subauth [$x];
	}
	
	// Cheat by tacking on the S-
	return 'S-' . $result;
}

/**
 * Converts a little-endian hex-number to one, that 'hexdec' can convert
 * @param string $hex
 * @return Ambigous <NULL, string>
 */
function little_endian($hex) {
	$result = null;
	for($x = strlen ( $hex ) - 2; $x >= 0; $x = $x - 2) {
		$result .= substr ( $hex, $x, 2 );
	}
	return $result;
}

?>

