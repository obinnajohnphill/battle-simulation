<?php

namespace App\BattleSimulation;

/**
 * A class for attack and retaliation blows which are used for fights between combatants
 *
 */
abstract class Blow {
    protected $strength    = null;
    
    /**
     * @param int $strength
     * @param bool $stunning
     * @return null
     */
    public function __construct($strength, $stunning = null)
    {
        $this->strength = $strength;
    }

    /**
     * @return float|int|null
     */
    public function getStrength()
    {
        return $this->strength;
    }
}

