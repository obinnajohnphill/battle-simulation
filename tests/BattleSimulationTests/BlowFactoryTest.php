<?php

use PHPUnit\Framework\TestCase;
use \App\BattleSimulation\BlowFactory;

class BlowFactoryTest extends TestCase{

     private $blowfactory;
     private $mock;

    protected function setUp():void
    {
        $this->blowfactory = new BlowFactory();
        $this->mock =  Mockery::mock('Attack');
    }

    public function tearDown():void
    {
        Mockery::close();
    }

    public function testClassInstance(){
        $this->assertInstanceOf(BlowFactory::class,  $this->blowfactory);
    }

    public function testCreateAttack(){
       $object = $this->blowfactory->createAttack(10, 5);
       $this->assertObjectHasAttribute('retaliation',$object);
       $this->assertObjectHasAttribute('stunning',$object);
       $this->assertObjectHasAttribute('missed',$object);
       $this->assertObjectHasAttribute('isLucky',$object);
       $this->assertObjectHasAttribute('multiplier',$object);
       $this->assertObjectHasAttribute('damage',$object);
       $this->assertObjectHasAttribute('strength',$object);
    }

}

