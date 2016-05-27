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
use Models\Business\Order as Order;
use Models\Business\StatusOrder as StatusOrder;
use Models\Business\Robot as Robot;
use Models\Business\Process as Process;

class OrderTest extends PHPUnit_Framework_TestCase{
    protected static $order;

	public static function setUpBeforeClass(){
        self::$order = new Order;
    }

    public static function tearDownAfterClass(){
        self::$order = NULL;
    }
	public function testCode(){
		self::$order->setCode(100);
		$this->assertGreaterThan(99, self::$order->getCode());
		$this->assertInternalType("int", self::$order->getCode());
	}
        
        public function testDescription(){
            self::$order->setDescription('prova');
            $this->assertGreaterThan(3, strlen(self::$order->getDescription()));
            $this->assertLessThan(50, strlen(self::$order->getDescription()));
        }

        public function testPriority(){
            self::$order->setPriority(5);
            $this->assertGreaterThan(0, self::$order->getPriority());
            $this->assertLessThan(10, self::$order->getPriority());
            $this->assertInternalType("int", self::$order->getPriority());
	}
//        
//        public function testDate($date){
//            self::$order->setDate($date);
//        }
//        
        public function testQuantity(){
		self::$order->setQuantity(99);
		$this->assertGreaterThan(0, self::$order->getQuantity());
		$this->assertInternalType("int", self::$order->getQuantity());
	}
        
        public function testStatusOrder(){
            $statusOrder = new StatusOrder;
            self::$order->setStatusOrder($statusOrder);
            self::$order->getStatusOrder()->setId(5);
            $this->assertGreaterThan(0, self::$order->getStatusOrder()->getId());
            $this->assertInternalType("int", self::$order->getStatusOrder()->getId());
	}
        
        public function testRobot(){
            $robot = new Robot;
            self::$order->setRobot($robot);
            self::$order->getRobot()->setId(1);
            $this->assertGreaterThan(0, self::$order->getRobot()->getId());
            $this->assertInternalType("int", self::$order->getRobot()->getId());
	}
        
        public function testProcess(){
            $process = new Process;
            self::$order->setProcess($process);
            self::$order->getProcess()->setId(3);
            $this->assertGreaterThan(0, self::$order->getProcess()->getId());
            $this->assertInternalType("int", self::$order->getProcess()->getId());
	}
        
}
