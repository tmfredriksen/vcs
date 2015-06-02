<?php
use \AcceptanceTester;

class manualsourceCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    // tests
    public function testManualsource(AcceptanceTester $I)
    {
    	//$I->setCookie('sessionid', '123213123123123');
    	$I->amOnPage("manualsource");
    	$I->see("manualsource");
    }
//     public function testMsCreateView(AcceptanceTester $I){
//     	$I->wantTo("");
//     	$I->setCookie('sessionid', '123213123123123');
//     	$I->am("admin");
//     	$I->amOnPage("manualsource/create");
//     	$I->see("create");
//     }
}