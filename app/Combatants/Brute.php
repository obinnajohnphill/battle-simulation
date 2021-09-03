<?php

namespace App\Combatants;

use Combatant;

/**
 * A class setting the Brute combatant type
 */
class Brute extends Combatant {

    /**
     * @return void
     */
    protected function generateHealth() {
        $this->health = (int) $this->randomNumberBetween(90, 100);
    }

    /**
     * @return void
     */
    protected function generateStrength() {
        $this->strength = (int) $this->randomNumberBetween(65, 75);
    }

    /**
     * @return void
     */
    protected function generateDefence() {
        $this->defence = (int) $this->randomNumberBetween(40, 50);
    }

    /**
     * @return void
     */
    protected function generateSpeed() {
        $this->speed = (int) $this->randomNumberBetween(40, 65);
    }

    /**
     * @return void
     */
    protected function generateLuck() {
        $this->luck = $this->randomNumberBetween(0.3, 0.35);
    }
}
