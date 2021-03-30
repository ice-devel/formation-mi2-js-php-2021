<?php
require 'src/Slugger.php';
/*
 * Faire ça c'est déjà un début mais c'est pas pratique :
 * utilisons un outil de tests comme PHPUnit
 */

$slugger = new Slugger();

$str = "Test de slug";
$slug = $slugger->slug($str);

if ($slug !== "test-de-slug") {
    throw new Exception();
}
