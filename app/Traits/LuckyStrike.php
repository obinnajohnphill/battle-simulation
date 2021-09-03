<?php


namespace App\Traits;


use App\BattleSimulation\Attack;
use Randomiser;

/**
 * A trait that gives the combatant special skills
 * Gives 5% chance of doubling attack strength
 */
trait LuckyStrike {
    /**
     * @param Randomiser $randomise
     * @return Attack
     */
    public function createAttack(Randomiser $randomise = null) {
        $randomise = isset($randomise) ? $randomise : $this->getRandomiser();
        $attack = new Attack($this->getStrength());
        if(!$attack->hasMissed()) {
            $attack->setLucky($randomise->generateBoolean(0.02));
        }
        return $attack;
    }
}
