<?php

namespace App\BattleSimulation;

use Retaliation;

/**
 * A class that returns types of blows
 */
class BlowFactory {
    /**
     * @param $strength
     * @param null $stunning
     * @return Attack
     */
    public function createAttack($strength, $stunning = null)
    {
        return new Attack($strength, $stunning);
    }

    /**
     * @param $strength
     * @return Retaliation
     */
    public function createRetaliation($strength) {
        return new Retaliation($strength);
    }
}
