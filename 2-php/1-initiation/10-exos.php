<?php
/*
 * Les fonctions : exos
 */

/*
 * Exo 1 :
 * Ecrire une procédure qui dit Hello
 * suivi d'un prénom passé en paramètre
 */
function sayHelloTo($name) {
    echo "Hello ".$name;
}

sayHelloTo("Toto");
sayHelloTo("Toto2");

/*
 * Exo 2 :
 * Créer une fonction en reprendrant le code qui calcule un âge,
 * en prenant en paramètre
 * le jour de naissance, le mois de nais., l'année de nais.
 * puis retourne l'âge correspondant
 */


function getAge($birthDay, $birthMonth, $birthYear) {
    $currentYear = date('Y');
    $currentMonth = date('m');
    $currentDay = date('d');
    $age = $currentYear - $birthYear;
    if ($currentMonth < $birthMonth
        || $currentMonth == $birthMonth && $currentDay < $birthDay) {
        //$age = $age - 1;
        //$age -= 1;
        $age--;
    }

    return $age;
}

$monAge = getAge(10, 4, 2000);
echo $monAge;

/*
 * Exo 3:
 * Reprendre le code qui trouve la valeur max dans un tableau
 * et créer une fonction avec, le tableau passé en paramètre et
 * qui retourne cette valeur max
 */
function getMax($integers) {
    $max = $integers[0];
    foreach ($integers as $number) {
        if ($number > $max) {
            $max = $number;
        }
    }

    return $max;
}

$tab = [10, 14, 15, 13];
if (getMax($tab) > 20) {
    // on rentre pas
}

/*
 * Exo 4 :
 * Créer une fonction qui prend en paramètre une chaine,
 * et qui retourne si oui ou non, cette chaine est un palindrome
 */
function isPalin($string) {
    return strrev($string) == $string;
}

$name = "Toto";

if (isPalin($name)) {
    // on rentre pas
}




