<?php

use \AcceptanceTester;

class swatchCest
{
    public function _before(AcceptanceTester $I)
    {
	
    }

    public function _after(AcceptanceTester $I)
    {
    
    }
	public function testLoginView(AcceptanceTester $I){
		$I->amOnPage('home/login');
		$I->see("User login");
	}
    // tests
    public function tryToTest(AcceptanceTester $I)
    {
    	$I->amOnPage("swatch");
    	$I->see("swatch");
    
    }
  
    public function testView(AcceptanceTester $I){
     	$I->amOnPage('swatch/create');
     	$I->see("user login");
    }
}