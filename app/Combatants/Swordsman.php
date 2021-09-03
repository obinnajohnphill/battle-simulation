<?php


namespace App\Combatants;


use Combatant;

/**
 * A class setting the Swordman combatant type
 */
class Swordsman extends Combatant {

    /**
     * @return void
     */
    protected function generateHealth() {
        $this->health = (int) $this->randomNumberBetween(40, 60);
    }

    /**
     * @return void
     */
    protected function generateStrength() {
        $this->strength = (int) $this->randomNumberBetween(60, 70);
    }

    /**
     * @return void
     */
    protected function generateDefence() {
        $this->defence = (int) $this->randomNumberBetween(20, 30);
    }

    /**
     * @return void
     */
    protected function generateSpeed() {
        $this->speed = (int) $this->randomNumberBetween(90, 100);
    }

    /**
     * @return void
     */
    protected function generateLuck() {
        $this->luck = $this->randomNumberBetween(0.3, 0.5);
    }
}
