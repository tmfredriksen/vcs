<?php
use \AcceptanceTester;
class alertCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
    	$I->amOnPage("alert");
    	$I->see("alert");
    }
    
}

?>