<?php

use \App\BattleSimulation\Blow;
use PHPUnit\Framework\TestCase;

abstract class BlowTest extends TestCase {

    private $blow;

    protected function setUp():void
    {
        $this->blow = Blow::class(10, 5);
    }

    public function testClassInstance(){
        $this->assertInstanceOf(Blow::class,  $this->blow);
    }

    public function testStrength(){
        $this->assertIsInt($this->blow->getStrength());
    }
}

