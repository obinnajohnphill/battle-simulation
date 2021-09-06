<?php

use PHPUnit\Framework\TestCase;

class SwordsmanTest extends TestCase {

    protected $attributes = array(
        'health'   => ['lower' => 40,  'upper' => 60],
        'strength' => ['lower' => 60,  'upper' => 70],
        'defence'  => ['lower' => 20,  'upper' => 30],
        'speed'    => ['lower' => 90,  'upper' => 100],
        'luck'     => ['lower' => 0.3, 'upper' => 0.5]
    );

    function test10()
    {
        $this->assertTrue(true);
    }
}

