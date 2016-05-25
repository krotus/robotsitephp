<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OrderTest
 *
 * @author Marc
 */
class OrderTest extends PHPUnit_Framework_TestCase{
    protected static $order;

	public static function setUpBeforeClass(){
        self::$order = new Models\Business\Order();
    }

    public static function tearDownAfterClass(){
        self::$order = NULL;
    }
    
	public function testCode($code){
		self::$order->setCode($code);
		$this->assertGreaterThan(99, self::$order->getCode());
		$this->assertType("int", self::$order->getCode());
	}
        
        public function testDescription($description){
            self::$order->setDescription($description);
            $this->assertGreaterThan(3, str_len(self::$order->getDescription()));
            $this->assertLessThan(50, str_len(self::$order->getDescription()));
        }

        public function testPriority($priority){
            self::$order->setPriority($priority);
            $this->assertGreaterThan(0, self::$order->getPriority());
            $this->assertLessThan(10, self::$order->getPriority());
            $this->assertType("int", self::$order->getPriority());
	}
        
        public function testDate($date){
            self::$order->setDate($date);
        }
        
        public function testQuantity($quantity){
		self::$order->setQuantity($quantity);
		$this->assertGreaterThan(0, self::$order->getQuantity());
		$this->assertType("int", self::$order->getQuantity());
	}
        
        public function testStatusOrder($idstatusOrder){
		self::$order->getStatusOrder()->setId($idstatusOrder);
		$this->assertGreaterThan(0, self::$order->getStatusOrder()->getId());
		$this->assertType("int", self::$order->getStatusOrder()->getId());
	}
        
        public function testRobot($idrobot){
		self::$order->getRobot()->setId($idrobot);
		$this->assertGreaterThan(0, self::$order->getRobot()->getId());
		$this->assertType("int", self::$order->getRobot()->getId());
	}
        
        public function testProcess($idprocess){
		self::$order->getProcess()->setId($idprocess);
		$this->assertGreaterThan(0, self::$order->getProcess()->getId());
		$this->assertType("int", self::$order->getProcess()->getId());
	}
        
//	public function testSetCode(){
//		self::$order->setCode(100);
//		$this->assertEquals(100, self::$order->getCode());
//	}
}
