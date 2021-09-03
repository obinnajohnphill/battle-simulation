<?php

use App\BattleSimulation\Blow;

/**
 * A class that sets the type of blow that can be used to inflict damage to combatant
 */
class Retaliation extends Blow {

    /**
     * @return float|int|null
     */
    public function getDamage()
    {
        return $this->getStrength();
    }
}


