<?php

use App\BattleSimulation\Attack;
use App\BattleSimulation\Blow;
use  App\BattleSimulation\BlowFactory;


/**
 * A class that handles the combatants actions
 *
 */
abstract class Combatant {
    protected $health;
    protected $strength;
    protected $defence;
    protected $speed;
    protected $luck;
    protected $stunned;
    private   $name;
    protected $randomise;
    protected $blowFactory;

    /**
     * @param $name
     * @param \Randomiser|null $randomise
     * @throws \Exception
     */
    public function __construct($name, Randomiser $randomise = null) {
        $this->setRandomiser($randomise);
        $this->setName($name);
        $this->generateHealth();
        $this->generateStrength();
        $this->generateDefence();
        $this->generateSpeed();
        $this->generateLuck();
    }

    /**
     * @return mixed
     */
    public function getHealth() {
        return $this->health;
    }

    /**
     * @return mixed
     */
    public function getStrength() {
        return $this->strength;
    }

    /**
     * @return mixed
     */
    public function getDefence() {
        return $this->defence;
    }

    /**
     * @return mixed
     */
    public function getSpeed() {
        return $this->speed;
    }

    /**
     * @return mixed
     */
    public function getLuck() {
        return $this->luck;
    }

    /**
     * @return mixed
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param $name
     * @throws \Exception
     */
    private function setName($name)
    {
        if(strlen($name) > 30) {
            throw new Exception('Name not set: Must be 30 characters or less');
        } else {
            $this->name = $name;
        }
    }

    /**
     * @return \App\BattleSimulation\Attack
     */
    public function createAttack() {
        return $this->getBlowFactory()->createAttack($this->getStrength());
    }

    /**
     * @param \App\BattleSimulation\Attack $attack
     * @return \App\BattleSimulation\Attack|\App\BattleSimulation\Blow
     */
    public function receiveAttack(Attack $attack)
    {
        if($this->dodgedAttack()) {
            $attack->missed();
        } else {
            $attack->applyDefence($this->getDefence());
            $attack = $this->receiveBlow($attack);
            $this->setStunned($attack->isStunning());
        }
        return $attack;
    }

    /**
     * @param \App\BattleSimulation\Blow $blow
     * @return \App\BattleSimulation\Blow
     */
    public function receiveBlow(Blow $blow)
    {
        $this->dealDamage($blow->getDamage());
        return $blow;
    }

    /**
     * @param $damage
     * @return mixed
     */
    protected function dealDamage($damage)
    {
        $startingHealth = $this->getHealth();
        $this->health -= $damage;

        if($this->getHealth() < 0) {
            $this->health = 0;
        }
        return $startingHealth - $this->getHealth();
    }

    /**
     * @return bool
     */
    protected function dodgedAttack() {
        return 1 - $this->randomise->generate() < $this->getLuck();
    }

    /**
     * @param $lower
     * @param $upper
     * @return float|int
     */
    protected function randomNumberBetween($lower, $upper) {
        $difference = $upper - $lower;
        return $lower + $this->getRandomiser()->generate() * $difference;
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
    protected function getRandomiser() {
        if (!$this->randomise instanceof Randomiser) {
            $this->randomise = new Randomiser();
        }
        return $this->randomise;
    }

    /**
     * @param \App\BattleSimulation\BlowFactory $blowFactory
     * @return void
     */
    public function setBlowFactory(BlowFactory $blowFactory)
    {
        $this->blowFactory = $blowFactory;
    }

    /**
     * @return \App\BattleSimulation\BlowFactory
     */
    protected function getBlowFactory()
    {
        if(!$this->blowFactory instanceof BlowFactory) {
            $this->blowFactory = new BlowFactory();
        }
        return $this->blowFactory;
    }

    /**
     * @return bool
     */
    protected function isDead()
    {
        return $this->getHealth() <= 0;
    }

    /**
     * @return mixed
     */
    public function isStunned()
    {
        return $this->stunned;
    }

    /**
     * @return mixed
     */
    public function wasStunned()
    {
        $stunned = $this->stunned;
        if($stunned) {
            $this->stunned = false;
        }
        return $stunned;
    }


    /**
     * @param $stunned
     * @return bool
     */
    protected function setStunned($stunned)
    {
        $this->stunned = $stunned;
        return true;
    }


    abstract protected function generateHealth();

    abstract protected function generateStrength();

    abstract protected function generateDefence();

    abstract protected function generateSpeed();

    abstract protected function generateLuck();
}

