#!/usr/bin/env php
<?php
require_once('vendor/autoload.php');

use App\BattleSimulation\CombatantFactory;
use App\BattleSimulation\Simulation;


/**
 * Initialisation of the application
 */

$factory   = new CombatantFactory();
$describer = new Describer();

$firstName  = readline("What name will you deign to give the first combatant?\n");
$secondName = readline("What name shall the second combatant receive?\n");

$simulation = new Simulation($firstName, $secondName);

$describer->describeCombatants($simulation);

while($turn = $simulation->performTurn()) {
    print(PHP_EOL ." Turn " . $simulation->getTurnNumber() . ":".PHP_EOL);
    $describer->describeTurn($turn);
    if($simulation->isOver()) {
        print(PHP_EOL);
        if($simulation->isWon()) {
            $describer->describeBattleWon($simulation);
        } else {
            $describer->describeBattleDrawn($simulation);
        }
    }
}

exit;

