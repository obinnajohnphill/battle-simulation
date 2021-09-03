<?php

namespace App\Traits;

use App\BattleSimulation\Attack;

/**
 * A trait that gives the combatant special skills
 * Opponent is dealt 10 damage a grappler evades an attack.
 */
trait CounterAttack {
    /**
     * @param \App\BattleSimulation\Attack $attack
     * @return Attack
     */
    public function receiveAttack(Attack $attack)
    {
        if($this->dodgedAttack()) {
            $attack->missed();
            $attack->setRetaliation($this->getBlowFactory()->createRetaliation(10));
        } else {
            $attack->applyDefence($this->getDefence());
            $attack = $this->receiveBlow($attack);
            $this->setStunned($attack->isStunning());
        }
        return $attack;
    }
}
