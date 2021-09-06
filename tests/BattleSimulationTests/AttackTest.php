<?php

use PHPUnit\Framework\TestCase;
use \App\BattleSimulation\Attack;

class AttackTest extends TestCase{

     private $attack;
     private $mock;

    protected function setUp():void
    {
        $this->attack = new Attack(10, 5);
        $this->mock =  Mockery::mock('Attack');
    }

    public function tearDown():void
    {
        Mockery::close();
    }

    public function testClassInstance(){
        $this->assertInstanceOf(Attack::class,  $this->attack);
    }

    public function testGetStrength(){
      $this->assertIsInt($this->attack->getStrength());
    }

    public function testGetDamage(){
        $this->assertIsInt($this->attack->getStrength());
    }



    public function testSetLucky(){
        $this->mock->shouldReceive('setLuck')
            ->withArgs([1])
            ->zeroOrMoreTimes();
        $this->addToAssertionCount(
            Mockery::getContainer()->mockery_getExpectationCount()
        );
    }

    public function testSetRetaliation(){
        $this->assertTrue($this->attack->setRetaliation(new Retaliation(10)));
    }

    public function testMissed(){
        $this->assertTrue($this->attack->missed());
    }

    public function testApplyDefence(){
        $this->assertTrue($this->attack->applyDefence(10));
    }

    public function testisLucky(){
        $this->mock->shouldReceive('isLucky')
            ->zeroOrMoreTimes();
        $this->addToAssertionCount(
            Mockery::getContainer()->mockery_getExpectationCount()
        );
    }

    public function testIsStunning(){
        $this->assertTrue($this->attack->setStunning(10));
    }

    public function testHasMissed(){
        $this->mock->shouldReceive('hasMissed')
            ->zeroOrMoreTimes();
        $this->addToAssertionCount(
            Mockery::getContainer()->mockery_getExpectationCount()
        );
    }

}

