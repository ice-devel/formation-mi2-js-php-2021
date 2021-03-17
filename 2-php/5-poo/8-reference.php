<?php
/*
 * Passage par référence
 */

/*
 * Passage par valeur : passage par défaut pour les types primitifs : string, int, boolean
 * Ainsi que les arrays
 */
function strtoupper_custom($str) {
    $str = mb_strtoupper($str);
}

$chaine = "coucou";
strtoupper_custom($chaine);
echo $chaine;

function strtoupper_custom_reference(&$str) {
    $str = mb_strtoupper($str);
}

$chaine = "coucou";
strtoupper_custom($chaine);
echo $chaine;

/*
 * Pour les objets, le passage par défaut se fait par référence
 */
class User {
    public $name;
}


function strtoupper_object($obj) {
    $obj->name = strtoupper($obj->name);
}

$user = new User();
$user->name = "Manu";

strtoupper_object($user);
echo $user->name;

// si vous voulez passer une copie de l'objet, il faut manuellement faire une copie de l'objet
$user2 = clone $user;

// le principe de passage par référence vaut aussi pour les affections
$user3 = $user;
// $user3 est une référence à un $user, c'est le même objet en mémoire
// donc modifier l'un implique que la modification de l'autre aussi
$user3->name = "Nouveau nom";

echo "<pre>";
var_dump($user);
var_dump($user2);
var_dump($user3);

// comparaisons de type primitif
$chaine = "test";
$chaine2 = $chaine;

if ($chaine == $chaine2) {
    // oui
}

if ($chaine === $chaine2) {
    // oui
}

// comparaison d'objet
if ($user == $user2) {
    // oui : si les valeurs de toutes les propriétés des deux objets sont égales, alors
    // les objets sont équivalents
}

if ($user === $user2) {
    // faux : la comparaison stricte ne compare les valeurs des propriétés mais
    // la référence en mémoire
}

if ($user === $user3) {
    // oui les deux variables pointent vers le mêle objet en mémoire
    // donc l'équivalence stricte est vraie
}




