<?php

// Pour utiliser la classe il faut l'inclure :
// require 'entity/Player.php';

/*
 * Ou alors on peut utiliser un système d'autoload :
 * Permet de charger une classe au moment où on a besoin
 */
function loadEntity($class) {
    $filename = "entity/".$class.".php";
    if (file_exists($filename)) {
        require $filename;
    }
}
function loadUtility($class) {
    $filename = "utility/".$class.".php";
    if (file_exists($filename)) {
        require $filename;
    }
}

spl_autoload_register('loadEntity');
spl_autoload_register('loadUtility');

$player = new Player();


