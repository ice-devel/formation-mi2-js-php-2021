<?php
/*
 * Les tableaux
 * Un type de variable contenant plusieurs valeurs
 * Ces valeurs sont accessibles grâce à un indice
 * - numérique (indice commence à 0)
 * - associatif (une clé : chaine de caractères)
 */

/*
 * déclarer un tableau
 */
$numericTab = array();
$numericTab = [];

/*
 * déclarer un tableau et l'initialiser en même avec des valeurs
 */
$numericTab = [13, 15, "tableau", true, 34];
var_dump($numericTab);

for ($i=0; $i < count($numericTab); $i++) {
    $value = $numericTab[$i];
    var_dump($value);
}

/*
 * foreach : pratique pour parcourir des tableaux (de manière générale, des éléments dits "iterable"
 */
foreach ($numericTab as $value) {
    var_dump($value);
}

/*
 * ajouter un élément dans un tableau
 */
// PUSH : ajouter un élément en dernière position
// notation courte
$numericTab[] = "nouvelle valeur";

// alors
array_push($numericTab, "autre nouvelle valeur");

/*
 * accéder / modifier une valeur
 */
// afficher le deuxième élément
echo $numericTab[1];
$numericTab[2] = "tableau modifié";

// warning : les indices peuvent se pas se suivre
$numericTab[100] = "element à la position 100";

/*
 * Supprimer un élément
 */
unset($numericTab[100]);
var_dump($numericTab);


unset($numericTab[1]);
// on ne reclasse pas les indices, ici l'élément à l'indice 2 reste à l'indice 2

/*
 * Tableaux associatifs
 */

$person = [];
$person['fname'] = "Toto";
$person['age'] = 25;
$person['city'] = "Lille";
$person['enabled'] = true;

echo $person['fname'];

foreach ($person as $key => $property) {
    var_dump($key);
    var_dump($property);
}

$person['enabled'] = false;

/*
 * exemple de fonctions courantes
 */

// chercher si une valeur existe dans un tableau
$cities = ['lille', 'marseille', 'lyon', 'cambrai'];

if (in_array("bordeaux", $cities)) {
    // bordeaux est dans le tableau
    // on rentre pas
}

// chercher si une clé existe
if (array_key_exists('lname', $person)) {
    // on rentre pas lname n'existe pas en tant que clé dans ce tableau
}

// chercher si une valeur existe et si c'est le cas, obtenir sa clé/son indice
$books = ['book1', 'book2', 'book3'];
$indice = array_search('book3', $books);
if ($indice !== false) {
    echo "book3 se trouve à la position ".$indice;
}

// compter le nb d'occurences d'une valeur dans un tableau
$cities = ['lille', 'paris', 'lille', 'valenciennes', 'lille'];
$citiesCount = array_count_values($cities);
var_dump($citiesCount);
?>










