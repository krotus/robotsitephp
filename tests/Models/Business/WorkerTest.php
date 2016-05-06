<?php 

class WorkerTest extends PHPUnit_Framework_TestCase{

	protected static $worker;

	public static function setUpBeforeClass(){
        self::$worker = new Models\Business\Worker();
    }

    public static function tearDownAfterClass(){
        self::$worker = NULL;
    }

	public function testGetName(){
		self::$worker->setName("Andreu");
		$this->assertEquals("Andreu", self::$worker->getName());
	}

	public function testSetName(){
		self::$worker->setName("Andreu");
		$this->assertEquals("Andreu", self::$worker->getName());
	}


}

?>