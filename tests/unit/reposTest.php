<?php

include_once("classes/DB.class.php");
include_once 'classes/AlertAction.class.php';
include_once 'classes/File.class.php';
include_once 'config.php';
class reposTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;
	private $db;
    protected function _before()
    {
    	$this->db = new DB();
    }

    protected function _after()
    {
    }
    // tests
    
    public function testAlertactions()
    {	
    	$alert = count($this->db->getAlertActions());
    	$this->tester->assertGreaterThanOrEqual(7, $alert);
    }
	public function testAllSwatchFiles(){;
		$files = count($this->db->getAllFiles(3));
		$this->tester->assertGreaterThanOrEqual(1, $files);
	}
	public function testAllAlertfiles(){
		$files = count($this->db->getAllFiles(2));
		$this->tester->assertGreaterThanOrEqual(1, $files);
	}
	public function testAllMsfiles(){
		$files = count($this->db->getAllFiles(1));
		$this->tester->assertGreaterThanOrEqual(1, $files);
	}
	public function testSingleFile(){
		$file = count($this->db->getFile(1));
		$this->tester->assertEquals(1, $file);
	}
	public function testHighestFileID() {
		 $file = count($this->db->getHighestFileID());
		 $this->tester->assertEquals(1, $file);
	}
	public function testLastFiveFiles(){
		$files = count($this->db->getLastFiveFiles(3));
		$this->tester->assertEquals(1, $files);
	}
	public function testHighestVsByFileID(){
		$file = count($this->db->getHighestVersionByFileid(2));
		$this->tester->assertEquals(1, $file);
	}
	
}