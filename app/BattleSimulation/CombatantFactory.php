<?php

namespace App\BattleSimulation;

use App\Combatants\Brute;
use App\Combatants\Grappler;
use App\Combatants\Swordsman;
use Randomiser;

/**
 * A class that generates combatants for the battle simulation
 * It sets the combatants as random class
 */
class CombatantFactory {

    private $randomise = null;
    private $classes = ['Swordsman', 'Brute', 'Grappler'];

    /**
     * @param \Randomiser|null $randomise
     * @return void
     */
    public function __construct(Randomiser $randomise = null)
    {
        $this->setRandomiser($randomise);
    }

    /**
     * @param $name
     * @return mixed
     */
    public function createRandom($name)
    {
        $className = $this->getRandomiser()->getArrayItem($this->classes);
        return $this->{'create'.$className}($name);
    }

    /**
     * @param \Randomiser|null $randomise
     * @return void
     */
    public function setRandomiser(Randomiser $randomise = null)
    {
        $this->randomise = $randomise;
    }

    /**
     * @return \Randomiser
     */
    private function getRandomiser()
    {
        if(!$this->randomise instanceof Randomiser) {
            $this->randomise = new Randomiser();
        }
        return $this->randomise;
    }

    /**
     * @param $name
     * @param \Randomiser|null $randomise
     * @return \App\Combatants\Swordsman
     * @throws \Exception
     */
    public function createSwordsman($name, Randomiser $randomise = null)
    {
        return new Swordsman($name, $randomise);
    }

    /**
     * @param $name
     * @param \Randomiser|null $randomise
     * @return \App\Combatants\Brute
     * @throws \Exception
     */
    public function createBrute($name, Randomiser $randomise = null)
    {
        return new Brute($name, $randomise);
    }

    /**
     * @param $name
     * @param \Randomiser|null $randomise
     * @return \App\Combatants\Grappler
     * @throws \Exception
     */
    public function createGrappler($name, Randomiser $randomise = null)
    {
        return new Grappler($name, $randomise);
    }

}

