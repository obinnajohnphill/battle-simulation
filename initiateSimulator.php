#!/usr/bin/env php

<?php


require_once('vendor/autoload.php');


use App\BattleSimulation\CombatantFactory;
use App\BattleSimulation\Simulation;

$factory   = new CombatantFactory();
$describer = new Describer();

// Get combatant names
$firstName  = readline("What name will you deign to give the first combatant?\n");
$secondName = readline("What name shall the second combatant receive?\n");

// Create simulation
$simulation = new Simulation($firstName, $secondName);

// Describe combatants
$describer->describeCombatants($simulation);

// Start running turns
while($turn = $simulation->performTurn()) {
    echo "\n\nTurn " . $simulation->getTurnNumber() . ":\n\n";

    $describer->describeTurn($turn);

    if($simulation->isOver()) {
        echo "\n";

        if($simulation->isWon()) {
            $describer->describeBattleWon($simulation);
        } else {
            $describer->describeBattleDrawn($simulation);
        }
    }
}

exit;

