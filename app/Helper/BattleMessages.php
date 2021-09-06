<?php

namespace App\Helper;

/**
 * A class that prints the battle simulation messages
 */
class BattleMessages
{
    /**
     * @param $vars
     * @return void
     */
   public function specialSkills($vars)
   {
       if (isset($vars['luckyStrike']) OR isset($vars['stunningBlow']) OR isset($vars['counterAttack'])) {
           if (isset($vars['luckyStrike'])) {
               print('A Lucky Strike! ' . $vars['attacker'] . ' dealt double damage! ' . PHP_EOL);
           }
           if (isset($vars['stunningBlow'])) {
               print('Stunning Blow! ' . $vars['defender'] . ' is now stunned! ' . PHP_EOL);
           }
           if (isset($vars['counterAttack'])) {
               print('Counter Attack! ' . PHP_EOL);
               print('Stunning Blow! ' . $vars['defender'] . ' is now stunned! ' . PHP_EOL);
               print($vars['defender'] . ' dealt ' . $vars['damage'] . ' damage to ' . $vars['attacker'] . PHP_EOL);
               print($vars['attacker'] . ' now has ' . $vars['health'] . ' health ' . PHP_EOL);
           }
       }
   }

    /**
     * @param $vars
     * @return void
     */
    public function combatantDescription($vars)
    {
        if (isset($vars['name']))
        {
            $classParts = explode("\\", $vars['class']);
            print(PHP_EOL . $vars['name']. ' is a '.  end($classParts).' with:' . PHP_EOL);
            print('Health:'. $vars['health']. PHP_EOL);
            print('Strength:'. $vars['strength']. PHP_EOL);
            print('Defence:'. $vars['defence']. PHP_EOL);
            print('Speed:'. $vars['speed']. PHP_EOL);
            print('Luck:'. $vars['luck']. PHP_EOL);
        }
    }

    /**
     * @param $vars
     * @return void
     */
    public function battleDrawn($vars)
    {
        if (isset($vars['combatantOne']))
        {
            print('After 30 turns the battle has not ended'. PHP_EOL);
            print('Both combatants showed absolutely no initiative in finishing each other off.'. PHP_EOL);
            print(' We\'re calling a draw.'. PHP_EOL);
            print($vars['combatantOne'].' has '. $vars['healthOne']. PHP_EOL);
            print($vars['combatantTwo'].' has '. $vars['healthTwo']. PHP_EOL);
            print(PHP_EOL);
        }

    }

    /**
     * @param $vars
     * @return void
     */
    public function successfulAttack($vars)
    {
        if (isset($vars['weaponAdjective']) AND isset($vars['attackStrength']) AND isset($vars['defence']) AND isset($vars['damage']) AND isset($vars['health']))
        {
            print($vars['attacker'] . ' ' .$vars['verb']. ' ' .$vars['weaponAdjective']. ' ' .$vars['noun']. ' of '.  $vars['appendix'] . ' at '. $vars['defender']. ' Got em!'. PHP_EOL);
            print('Attack strength: '.$vars['attackStrength'] .  PHP_EOL);
            print('Defence: '.$vars['defence'] . PHP_EOL);
            print('Damage dealt: '. $vars['damage'] .PHP_EOL);
            print($vars['defender'] .' now has '.$vars['health'] . ' health' . PHP_EOL);
        }
    }

    /**
     * @param $vars
     * @return void
     */
    public function promptForName($vars)
    {
        if(isset($vars['number'])){
            print('What is the '.$vars['number'] . ' combatant\'s name' . PHP_EOL);
       }
    }

    /**
     * @param $vars
     * @return void
     */
    public function missedTurn($vars)
    {
        if(isset($vars['attacker'])){
            print($vars['attacker'] . ' forfeited their turn because they were stunned. Or maybe just asleep' . PHP_EOL);
        }
    }

    /**
     * @param $vars
     * @return void
     */
    public function dodgedAttack($vars)
    {
        if(isset($vars['attacker'])){
            print($vars['attacker'] . ' '. $vars['verb']. ' '.  $vars['weaponAdjective']. ' '. $vars['noun'] . ' of '. $vars['appendix']. ' at '. $vars['defender'] . PHP_EOL);
            print('but in '. $vars['dodgeAdjective'] . ' show of '. $vars['abstractNoun'] . ' ' . $vars['defender']. ' dodged the attack.' . PHP_EOL);
        }
    }


    /**
     * @param $vars
     * @return void
     */
    public function battleWon($vars)
    {
        if(isset($vars['winner'])){
            print($vars['winner'] . ' has won ' .'(with '.$vars['health'] .' health left)' . PHP_EOL);
            print($vars['loser'] . ' is dead. Shame.' . PHP_EOL);
            print(PHP_EOL);
        }
    }

}
