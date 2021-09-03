<?php

namespace App\BattleSimulation;

use Combatant;
use Retaliation;


/**
 * A class used to generate turns of attacks between combatants
 */
class Turn {
    private $attacker;
    private $defender;
    private $attack;
    private $attackerStunned;

    /**
     * @param \Combatant $attacker
     * @param \Combatant $defender
     * @return void
     */
    public function __construct(Combatant $attacker, Combatant $defender)
    {
        $this->attacker = $attacker;
        $this->defender = $defender;
        $this->attackerStunned = $this->getAttacker()->wasStunned();
        $this->attack = $this->performAttack();
    }

    /**
     * @return \Combatant
     */
    public function getAttacker()
    {
        return $this->attacker;
    }

    /**
     * @return \Combatant
     */
    public function getDefender()
    {
        return $this->defender;
    }

    /**
     * @return \App\BattleSimulation\Attack|\App\BattleSimulation\Blow|null
     */
    private function performAttack()
    {
        $attack = null;
        if(!$this->missed()) {
            $attack = $this->getAttacker()->createAttack();
            $attack = $this->getDefender()->receiveAttack($attack);
            if($attack->getRetaliation() instanceof Retaliation) {
                $this->getAttacker()->receiveBlow($attack->getRetaliation());
            }
        }
        return $attack;
    }

    /**
     * @return \App\BattleSimulation\Attack|\App\BattleSimulation\Blow|null
     */
    public function getAttack()
    {
        return $this->attack;
    }

    /**
     * @return mixed
     */
    public function missed()
    {
        return $this->attackerStunned;
    }
}

