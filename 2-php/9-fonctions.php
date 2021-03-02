<?php
/*
 * Les fonctions
 * Une fonction est une suite d'instructions qu'on centralise afin
 * de pouvoir la réutiliser, sans avoir à la réécrire : pour cela
 * on va lui donner un nom.
 * Une fonction est composée de :
 * - une signature (function, nom de fonction, paramètres d'entrée pas obligatoire)
 * - un corps (instructions, valeur de retour pas obligatoire)
 */

$toto = 5;

function addition($a, $b)
{
    $result = $a + $b;
    return $result;
}

// sans la fonction
$result = 4 + 5;
$result2 = 45 + 54;

// avec la fonction
$result = addition(4, 5);
$result2 = addition(45, 54);

/*
 *   Utiliser une fonction qui retourne quelquechose
 */
// affectation
$valeurDeRetour = addition(4, 5);
// affichage
echo addition(13, 15);
// test
if (addition(34, 45) > 50) {
    // on rentre
}

/*
 * Procédure : fonction qui ne retourne rien
 */
function sayHello()
{
    echo "Hello!";
}

sayHello();
sayHello();

/*
 * Paramètres facultatifs :
 * Un paramètre facultatif, c'est un paramètre qu'on n'est pas obligé
 * de passer, car il a une valeur par défaut.
 * Il faut placer les paramètres facultatifs après les paramètres obligatoires
 */

function array_keys_custom($array, $upper = false)
{
    $keys = [];
    foreach ($array as $key => $value) {
        // v1
        /*
        if ($upper) {
            $keys[] = strtoupper($key);
        }
        else {
            $keys[] = $key;
        }
        */
        // v2
        $keys[] = $upper ? strtoupper($key) : $key;
    }

    return $keys;
}

$tab = ['name' => 'toto', 'city' => 'Lille'];
$newTab = array_keys_custom($tab);
$newTab = array_keys_custom($tab);
$newTab = array_keys_custom(true, $tab);

?>









