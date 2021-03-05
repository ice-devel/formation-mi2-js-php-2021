<?php
/*
 *
Exercice 2 :

créer une fonction qui prend un paramètre obligatoire, et un autre facultatif.
Le premier paramètre sera une chaine et le deuxième un entier
la fonction doit trouver le nombre de caractères du premier paramètre
puis elle doit retourner le nombre de caractères manquant pour arriver
au nombre défini par le second paramètre.

Ce second paramètre doit avoir pour valeur par défaut 100

si le nombre de caractères du premier paramètre est égal ou supérieure à ce second paramètre,
la fonction doit renvoyer 0

utiliser cette fonction dans un script en affichant : Il manque [x] caractères pour que la chaine [chaine]
arrive à [y] caractères.

Exemple : si le paramètre 1 a pour valeur “coucou”, et que le deuxième a pour valeur 100;
la fonction doit renvoyer 94 car la longueur de coucou est 6 et qu’il manque donc 94 caractères pour arriver à 100.
 */

function nbMissingChars($string, $limit=100) {
    // V1
    /*
    $length = mb_strlen($string);
    $nbChars = $limit - $length;

    if ($nbChars >= $limit) {
        return 0;
    }
    else {
        return $nbChars;
    }
    */

    // V2
    $nbChars = $limit - mb_strlen($string);
    return $nbChars >= $limit ? 0 : $nbChars;

    // V3
    return ($limit - mb_strlen($string)) >= $limit ? 0 : $limit - mb_strlen($string);

    // V4
    return mb_strlen($string) >= $limit ? 0 : mb_strlen($string);

    // V5
    $lenght = mb_strlen($string);
    return $lenght >= $limit ? 0 : $limit - $lenght;
}

$str = "bonjour";
$missingChars = nbMissingChars($str);
echo "Il manque $missingChars caractères pour que la chaine \"$str\" arrive à 100 caractères.<br>";

$str = "coucou";
$limit = 50;
$missingChars = nbMissingChars($str, $limit);
echo "Il manque $missingChars caractères pour que la chaine \"$str\" arrive à $limit caractères.";