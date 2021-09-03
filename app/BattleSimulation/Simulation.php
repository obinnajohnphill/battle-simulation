<?php

namespace App\BattleSimulation;

/**
 * A class that run the stimulation, and the code entry point
 */
class Simulation {
    private $combatants;
    private $combatantFactory;
    private $whoseTurn;
    private $turnsPassed = 0;

    /**
     * @param \App\BattleSimulation\CombatantFactory|null $factory
     * @param null $firstCombatantName
     * @param null $secondCombatantName
     * @return void
     */
    public function __construct(
        $firstCombatantName = null,
        $secondCombatantName = null,
        CombatantFactory $factory = null
    ) {
        $this->setCombatantFactory($factory);
        $this->combatants = [
            $this->getCombatantFactory()->createRandom($firstCombatantName),
            $this->getCombatantFactory()->createRandom($secondCombatantName)
        ];
        $this->whoseTurn  = $this->whoGoesFirst();
    }

    /**
     * @return \App\BattleSimulation\Turn|null
     */
    public function performTurn()
    {
        $turn = null;
        if(!$this->isOver()) {
            $turn = new Turn($this->getAttacker(), $this->getDefender());
            $this->switchTurn();
            $this->turnsPassed++;
        }
        return $turn;
    }

    /**
     * @return bool
     */
    public function isOver()
    {
        return $this->isWon() || $this->turnsPassed >= 30;
    }

    /**
     * @return bool
     */
    public function isWon()
    {
        return $this->combatants[0]->getHealth() <= 0 || $this->combatants[1]->getHealth() <= 0;
    }

    /**
     * @return mixed
     */
    public function getWinner()
    {
        $winner = null;
        if($this->getLoser() == $this->combatants[0]) {
            $winner = $this->combatants[1];
        } else if($this->getLoser() == $this->combatants[1]) {
            $winner = $this->combatants[0];
        }
        return $winner;
    }

    /**
     * @return mixed
     */
    public function getLoser()
    {
        $loser = null;
        if($this->combatants[0]->getHealth() <= 0) {
            $loser = $this->combatants[0];
        } else if($this->combatants[1]->getHealth() <= 0) {
            $loser = $this->combatants[1];
        }
        return $loser;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function getCombatant($key)
    {
        return $this->combatants[$key];
    }

    /**
     * @return int
     */
    public function getTurnNumber()
    {
        return $this->turnsPassed;
    }

    /**
     * @return void
     */
    private function switchTurn()
    {
        $this->whoseTurn = 1 - $this->whoseTurn;
    }

    /**
     * @return int
     */
    private function whoGoesFirst()
    {
        $first = 0;
        $one   = $this->combatants[0];
        $two   = $this->combatants[1];

        if($one->getSpeed() > $two->getSpeed()) {
            $first = 0;
        } else if($two->getSpeed() > $one->getSpeed()) {
            $first = 1;
        } else if($one->getDefence() < $two->getDefence()) {
            $first = 0;
        } else if($two->getDefence() < $one->getDefence()) {
            $first = 1;
        }
        return $first;
    }

    /**
     * @return mixed
     */
    private function getAttacker()
    {
        return $this->combatants[$this->whoseTurn];
    }

    /**
     * @return mixed
     */
    private function getDefender() {
        return $this->combatants[1-$this->whoseTurn];
    }


    /**
     * @param \App\BattleSimulation\CombatantFactory|null $factory
     * @return void
     */
    public function setCombatantFactory(CombatantFactory $factory = null)
    {
        $this->combatantFactory = $factory;
    }

    /**
     * @return \App\BattleSimulation\CombatantFactory
     */
    private function getCombatantFactory()
    {
        if(!$this->combatantFactory instanceof CombatantFactory) {
            $this->combatantFactory = new CombatantFactory();
        }
        return $this->combatantFactory;
    }
}

