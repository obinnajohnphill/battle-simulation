<?php


namespace App\Traits;


use App\BattleSimulation\Attack;
use Randomiser;

/**
 * A trait that gives the combatant special skills
 * Gives 2% chance of stunning the enemy
 */
trait StunningBlow {
    /**
     * @param Randomiser $randomise Allows randomiser to be set just for this method - for testing
     * @return Attack
     */
    public function createAttack(Randomiser $randomise = null)
    {
        $randomise = isset($randomiser) ? $randomise : $this->getRandomiser();
        $attack = new Attack($this->getStrength());
        if(!$attack->hasMissed()) {
            $attack->setStunning($randomise->generateBoolean(0.02));
        }
        return $attack;
    }
}
