<?php
/*
 * POO : programmation orientée objet
 * Consiste à créer des classes d'objets et à les utiliser dans les classes via des instances
 *
 * 1 - Modéliser une classe :
 * Regrouper des propriétés et des fonctions concernant le même concept
 * Cela va créer un nouveau type dans PHP
 *
 * 2 - Instancier une classe :
 * Créer une variable qui est de type de la classe concernée
 */

/*
 * En procédural : player
 */

$name1 = "Thor";
$points1 = 33;
$zipcode1 = "59000";

$name2 = "Hulk";
$points2 = 45;
$zipcode2 = "75000";

if ($points2 > $points1) {

}

$thor = ["name" => "Thor", 'points' => 33];
$hulk = ["name" => "Hulk", 'points' => 45, 'otherProperty' => "coucou"];

if ($hulk['points'] > $thor['points']) {

}

function hit(&$player1, &$player2) {
    $player1['points'] += 10;
    $player2['points'] -= 10;
    echo $player1['name']." frappe ".$player2['name'];
}

hit($thor, $hulk);

echo "<pre>";
var_dump($thor);
var_dump($hulk);

/*
 * En POO
 */
class Player {
    public string $name;
    public $points;
    public $zipcode;
    public $isEnabled;

    public function hit(Player $hitPlayer) {
        $this->points += 10;
        $hitPlayer->points -= 10;
        echo $this->name." frappe ".$hitPlayer->name;
    }
}

$thor = new Player();
$thor->name = "Thor";
$thor->points = 33;

$hulk = new Player();
$hulk->name = "Hulk";
$hulk->points = 45;

// passage par référence
$thor->hit($hulk);
$thor->hit($hulk);

echo "<pre>";
var_dump($thor);
var_dump($hulk);




