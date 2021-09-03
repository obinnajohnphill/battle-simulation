<?php

use App\BattleSimulation\Simulation;
use App\BattleSimulation\Turn;
use App\Helper\BattleMessages;
use App\Helper\TextGenerator;

/**
 * A class for describing actions during the battle stimulation
 */
class Describer extends BattleMessages{

    private $textGenerator;

    const BATTLE_DRAWN          = 'battleDrawn';
    const BATTLE_WON            = 'battleWon';
    const COMBATANT_DESCRIPTION = 'combatantDescription';
    const MISSED_TURN           = 'missedTurn';
    const SUCCESSFUL_ATTACK     = 'successfulAttack';
    const DODGED_ATTACK         = 'dodgedAttack';
    const SPECIAL_SKILL         = 'specialSkill';

    /**
     * @param \App\Helper\TextGenerator|null $generator
     * @return void
     */
    public function __construct(TextGenerator $generator = null)
    {
        $this->setTextGenerator($generator);
    }

    /**
     * @param \App\BattleSimulation\Simulation $simulation
     * @return void
     */
    public function describeBattleWon(Simulation $simulation)
    {
        $this->displayTemplate(
            [
                'winner' => $simulation->getWinner()->getName(),
                'health' => $simulation->getWinner()->getHealth(),
                'loser'  => $simulation->getLoser()->getName(),
            ],
            self::BATTLE_WON
        );
    }

    /**
     * @param \App\BattleSimulation\Simulation $simulation
     * @return void
     */
    public function describeBattleDrawn(Simulation $simulation)
    {
        $this->displayTemplate(
            [
                'combatantOne' => $simulation->getCombatant(0)->getName(),
                'healthOne'    => $simulation->getCombatant(0)->getHealth(),
                'combatantTwo' => $simulation->getCombatant(1)->getName(),
                'healthTwo'    => $simulation->getCombatant(1)->getHealth(),
            ],
            self::BATTLE_DRAWN
        );
    }

    /**
     * @param \Combatant $combatant
     * @return void
     */
    public function describeCombatant(Combatant $combatant)
    {
        $this->displayTemplate(
            [
                'name'     => $combatant->getName(),
                'class'    => get_class($combatant),
                'health'   => $combatant->getHealth(),
                'strength' => $combatant->getStrength(),
                'defence'  => $combatant->getDefence(),
                'speed'    => $combatant->getSpeed(),
                'luck'     => round($combatant->getLuck(), 2)
            ],
            self::COMBATANT_DESCRIPTION
        );
    }

    /**
     * @param \App\BattleSimulation\Turn $turn
     * @return void
     */
    public function describeTurn(Turn $turn)
    {
        if($turn->missed()) {
            $this->describeMissedTurn($turn);
        } else {
            if($turn->getAttack()->hasMissed()) {
                $this->describeDodgedAttack($turn);
            } else {
                $this->describeSuccessfulAttack($turn);
            }

            echo "\n";

            $this->describeSpecialSkill($turn);
        }
    }

    /**
     * @param \App\BattleSimulation\Simulation $simulation
     * @return void
     */
    public function describeCombatants(Simulation $simulation)
    {
        $this->describeCombatant($simulation->getCombatant(0));
        echo "\n";
        $this->describeCombatant($simulation->getCombatant(1));
    }


    /**
     * @param \App\BattleSimulation\Turn $turn
     * @return void
     */
    private function describeMissedTurn(Turn $turn)
    {
        $this->displayTemplate(
            ['attacker' => $turn->getAttacker()->getName()],
            self::MISSED_TURN
        );
    }

    /**
     * @param \App\BattleSimulation\Turn $turn
     * @return void
     */
    private function describeDodgedAttack(Turn $turn) {
        $this->displayTemplate(
            [
                'attacker'        => $turn->getAttacker()->getName(),
                'defender'        => $turn->getDefender()->getName(),
                'verb'            => $this->getTextGenerator()->getVerb(),
                'weaponAdjective' => $this->getTextGenerator()->getWeaponAdjective(),
                'noun'            => $this->getTextGenerator()->getNoun(),
                'appendix'        => $this->getTextGenerator()->getAppendix(),
                'dodgeAdjective'  => $this->getTextGenerator()->getDodgeAdjective(),
                'abstractNoun'    => $this->getTextGenerator()->getAbstractNoun()
            ],
            self::DODGED_ATTACK
        );
    }

    /**
     * @param \App\BattleSimulation\Turn $turn
     * @return void
     */
    private function describeSuccessfulAttack(Turn $turn) {
        $this->displayTemplate(
            [
                'attacker'        => $turn->getAttacker()->getName(),
                'attackStrength'  => $turn->getAttack()->getStrength(),
                'defender'        => $turn->getDefender()->getName(),
                'defence'         => $turn->getDefender()->getDefence(),
                'damage'          => $turn->getAttack()->getDamage(),
                'health'          => $turn->getDefender()->getHealth(),
                'verb'            => $this->getTextGenerator()->getVerb(),
                'weaponAdjective' => $this->getTextGenerator()->getWeaponAdjective(),
                'noun'            => $this->getTextGenerator()->getNoun(),
                'appendix'        => $this->getTextGenerator()->getAppendix(),
                'dodgeAdjective'  => $this->getTextGenerator()->getDodgeAdjective(),
                'abstractNoun'    => $this->getTextGenerator()->getAbstractNoun()
            ],
            self::SUCCESSFUL_ATTACK
        );
    }

    /**
     * @param \App\BattleSimulation\Turn $turn
     * @return void
     */
    private function describeSpecialSkill(Turn $turn) {
        $retaliation = $turn->getAttack()->getRetaliation();
        $this->displayTemplate(
            [
                'attacker' => $turn->getAttacker()->getName(),
                'defender' => $turn->getDefender()->getName(),
                'health'   => $turn->getAttacker()->getHealth(),
                'damage'   => isset($retaliation) ? $retaliation->getStrength() : false,
                'luckyStrike'   => $turn->getAttack()->isLucky(),
                'stunningBlow'  => $turn->getAttack()->isStunning(),
                'counterAttack' => isset($retaliation)
            ],
            self::SPECIAL_SKILL
        );
    }

    /**
     * @param array $vars
     * @param $message
     * @return void
     */
    private function displayTemplate(Array $vars, $message) {
        switch ($message) {
            case "combatantDescription":
                $this->combatantDescription($vars);
                break;
            case "specialSkills":
                $this->specialSkills($vars);
                break;
            case "battleDrawn":
                $this->battleDrawn($vars);
                break;
            case "successfulAttack":
                $this->successfulAttack($vars);
                break;
            case "missedTurn":
                $this->missedTurn($vars);
                break;
            case "dodgedAttack":
                $this->dodgedAttack($vars);
                break;
            case "battleWon":
                $this->battleWon($vars);
                break;
        }
    }


    /**
     * @param \App\Helper\TextGenerator|null $generator
     * @return void
     */
    public function setTextGenerator(TextGenerator $generator = null) {
        $this->textGenerator = $generator;
    }

    /**
     * @return \App\Helper\TextGenerator
     */
    public function getTextGenerator() {
        if(!$this->textGenerator instanceof TextGenerator) {
            $this->textGenerator = new TextGenerator();
        }
        return $this->textGenerator;
    }

}

