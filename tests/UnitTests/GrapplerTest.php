<?php

use PHPUnit\Framework\TestCase;

class GrapplerTest extends TestCase {

    protected $attributes = array(
        'health'   => ['lower' => 60,  'upper' => 100],
        'strength' => ['lower' => 75,  'upper' => 80],
        'defence'  => ['lower' => 35,  'upper' => 40],
        'speed'    => ['lower' => 60,  'upper' => 80],
        'luck'     => ['lower' => 0.3, 'upper' => 0.4]
    );

    function test6()
    {
        $this->assertTrue(true);
    }
}

