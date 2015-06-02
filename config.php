<?php
/**
 * config.php
 * @author Tommy Langhelle
 * @name config-file for storing static information used by the application.
 * 
 * THIS FILE MUST BE UPDATED BY BASEFARM TO MATCH THEIR SYSTEM.
 * Currently written to work with HiN's LDAP-system.
 *
 */

class ldapLogin
{
	public static $adServer 	= "ldap://hin-dc1.hin.no";
	public static $base_dn 		= "dc=hin,dc=no";
	public static $sortfilter 	= "sn";
	public static $bind_rdn 	= 'HIN' . "\\";
	public static $filter 		= "(sAMAccountName="; //username from login-page gets added after the "=".
}

class ldapSearch
{
	public static $adServer 	= "ldap://hin-dc1.hin.no";
	public static $bind_rdn		='HIN' . "\\" . "501757";
	public static $password 	='Nakasakia09N'; //INSERT PASSWORD
	public static $filter 		= "(objectClass=*)";
	
	public static $HostnameAttr  = "samaccountname";
	public static $DamCluster = "samaccountname";
	public static $customerAttr = "displayname";
}

/**
 * Used in create alert to suggest matching customers when technician enters a filename.
 */
class ldapCustomerSearch extends ldapSearch
{
	public static $base_dn = "OU=Studenter,OU=HIN,DC=hin,DC=no";
	public static $attr = array("displayname");
}

/**
 * Used in create alert to suggest matching Hostnames when technician enters a hostname
 */
class ldapHostnameSearch extends ldapSearch
{
	public static $base_dn = "OU=Studenter,OU=HIN,DC=hin,DC=no";
	public static $attr = array("samaccountname");
}

/**
 * Used in create alert to suggest matching damclusters when technician enters a damcluster
 */
class ldapDamclusterSearch extends ldapSearch
{
	public static $base_dn = "OU=Studenter,OU=HIN,DC=hin,DC=no";
	public static $attr = array("samaccountname");
}

/**
 * Standard root destination is the repository root.
 */
class path {
	public static $swatch = "file/swatch/"; //where in the repository the files will be saved
	public static $alert = "file/alerts/"; //where in the repository the files will be saved
	public static $manualsource = "file/manualsource/"; //where in the repository the files will be saved
}
class dbconfig
{
	public static $host = "158.39.116.231"; //host IP
	public static $database = "TMKF_DB1"; //database name
	public static $user = "root"; //username in db
	public static $password = "tordm123"; //password in db. Should be set another place. Used when testing.
	
}