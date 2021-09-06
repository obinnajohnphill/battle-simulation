<?php

namespace App\BattleSimulation;


use Retaliation;


/**
 * A class that sets the transition between combatants
 *
 */
class Attack extends Blow {
    private $retaliation;
    private $stunning;
    private $missed;
    private $isLucky;
    private $multiplier = 1;
    private $damage   = 0;
    
    /**
     * @param int $strength
     * @param bool $stunning
     * @return null
     */
    public function __construct($strength, $stunning = null)
    {
        $this->strength = $strength;
        $this->stunning = isset($stunning) ? $stunning : false;
    }


    /**
     * @return float|int
     */
    public function getStrength()
    {
        return $this->strength * $this->multiplier;
    }

    /**
     * @return int
     */
    public function getDamage()
    {
        return $this->damage;
    }

    /**
     * @return mixed
     */
    public function getRetaliation()
    {
        return $this->retaliation;
    }

    /**
     * @param $isStunning
     * @return bool
     */
    public function setStunning($isStunning)
    {
        $this->stunning = $isStunning;
        return true;
    }

    /**
     * @param $isLucky
     * @return void
     */
    public function setLucky($isLucky)
    {
        $this->isLucky = $isLucky;
        if($this->isLucky()) {
            $this->multiplier = 2;
        }
    }

    /**
     * @param \Retaliation $retaliation
     * @return bool
     */
    public function setRetaliation(Retaliation $retaliation)
    {
        $this->retaliation = $retaliation;
        return true;
    }

    /**
     * @return bool
     */
    public function missed()
    {
        $this->missed = true;
        return true;
    }

    /**
     * @return bool
     */
    public function applyDefence($defenceStrength)
    {
        $this->damage = $this->getStrength() - $defenceStrength;
        return true;
    }

    /**
     * @return mixed
     */
    public function isLucky()
    {
        return $this->isLucky;
    }

    /**
     * @return bool
     */
    public function isStunning()
    {
        return $this->stunning;
    }

    /**
     * @return mixed
     */
    public function hasMissed()
    {
        return $this->missed;
    }
}

