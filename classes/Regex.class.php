<?php

/**
 * NOT IN USE!!
 * 
 * @author Eivind
 *
 * Class for testing expressions(content) for each type(manual source, alert, swatch)
 * 
 * Site for testing expressions
 * https://regex101.com/
 */
class Regex {
	function __construct() {
	}
	/**
	 * @param int $type (1 for manual source, 2 for alert and 3 for swatch)
	 * @param string $content        	
	 */
	 function regexExpression($type, $content) {
		
		switch ($type) {		
			case 1 : //Manualsource
				//pattern for ip addresses, match a digit between (1-9), quantifier{1,3} that tells you can have a digit more than 3 times.
				//example, 100.000.00.00 /valid, 10.2222.213.33/not valid. too many 2
				//$pattern = '/(^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})(?=.*([a-z]+\.[a-z]+\.[a-z]+))(?=.*([a-z]+\-[a-z]+\-[a-z]))(?=.*([a-z]\_[a-z]))/s';
				//return $this->regexCheck ( $pattern, $content );
				return true;
				break;
			case 2 : //Alert
				/*$pattern = '/'.'(<alerts customer="([[:alpha:]]+)">)(?=.*(<alert>))(?=.*(<log level="([[:alpha:]]+)" oper="add" file="([a-zA-z0-9\/.-]+)"\/>))'
						 .'(?=.*(<marval oper="add"\/>))(?=.*(\/>))(?=.*(<\/alert>))(?=.*(<alert hostname="([a-zA-z0-9.]+)">))'. 
						 '(?=.*(<sms level="([0-9]+)" number="([a-zA-z]+)" oper="add"\/>))(?=.*(<email level="([a-zA-z]+)" oper="add" address="([a-zA-z.@]+)"\/>))(?=.*(<\/alerts>)$)' . '/s';*/
				return true;
				break;
			case 3 : //swatch
				/*kilder swatch
				 * http://linsec.ca/Using_swatch_to_Monitor_Logfiles
				 * http://linux.die.net/man/1/swatch
				 */
				/**
				 *# test rule (valid expression below)
						watchfor /something/
						        threshold track_by='number', type=both, count='number', seconds='number'
						        mail addresses='name'\@'something',subject=some subject
						        continue
						
						ignore /something/

						watchfor /something/
							 threshold 
						        pipe /something
				 */
				$pattern = '/(watchfor \/([a-zA-Z0-9!$%^\-\(&\\+_[\]:;<>?,.\/]+))(?=.*(threshold track_by=([0-9-$]+)))(?=.*(, ?type=(limit|threshold|both),))' .
				'(?=.*(count=([0-9]+)))(?=.*seconds=([0-9]+))(?=.*(mail addresses=([a-zA-Z0-9_]+)))(?=.*(\\@))(?=.*(,))(?=.*(subject=([a-zA-Z0-9]+)))' .
				'(?=.*(continue))(?=.*(ignore \/[a-zA-Z0-9-!-$-%-^-&-\[\]:;<>?,.\/]+))(?=.*(\/))(?=.*pipe \/[a-zA-Z0-9!$%^&\[\]:;<>?,.\/])' .
				'(?=.*(watchfor \/[a-zA-Z0-9!$%^&\_[\]:;<>?,.\/]+ ((?=.*(threshold))|(?=.*(pipe \/([a-zA-Z0-9!$%^&\[\]:;<>?,.\/]+)\/)))))/sm';		
 				return $this->regexCheck($pattern, $content);
				break;
				
		}
	}
	/**
	 * Method that checks the content of each type, if the content match the pattern it returns true or else false.
	 * @param string $pattern
	 * @param string $content
	 * @return boolean true or false
	 */
	 private function regexCheck($pattern, $content) {
		if (preg_match ($pattern, $content) == 1)
			return true;
		else
			return false;
	}
}
?>