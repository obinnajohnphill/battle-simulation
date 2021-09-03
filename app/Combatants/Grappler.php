<?php


namespace App\Combatants;


use Combatant;

/**
 * A class setting the Grappler combatant type
 */
class Grappler extends Combatant {

    /**
     * @return void
     */
    protected function generateHealth() {
        $this->health = (int) $this->randomNumberBetween(60, 100);
    }

    /**
     * @return void
     */
    protected function generateStrength() {
        $this->strength = (int) $this->randomNumberBetween(75, 80);
    }

    /**
     * @return void
     */
    protected function generateDefence() {
        $this->defence = (int) $this->randomNumberBetween(35, 40);
    }

    /**
     * @return void
     */
    protected function generateSpeed() {
        $this->speed = (int) $this->randomNumberBetween(60, 80);
    }

    /**
     * @return void
     */
    protected function generateLuck() {
        $this->luck = $this->randomNumberBetween(0.3, 0.4);
    }
}
