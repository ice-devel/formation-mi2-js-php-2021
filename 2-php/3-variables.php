<?php
    // Les variables

    /*
     * Une variable est une référence à un emplacement en mémoire,
     * où l'on peut stocker une valeur
     */

    /*
     * PHP langage interprété et typé faiblement
     * Une variable en PHP commence par un $
     */

    /*
     * Types primitifs
     */
    $name = "Chaine de caractère";
    $integer = 30;
    $decimal = 45.4;
    $boolean = true;

    echo $name."<br>";
    echo $integer."<br>";
    echo $decimal."<br>";
    echo $boolean."<br>";

    var_dump($name);
    var_dump($integer);
    var_dump($decimal);
    var_dump($boolean);

    // les constantes : on déclare une constante avec la fonction define
    define('CONSTANT_NAME', 'Valeur de la constante');
    var_dump(CONSTANT_NAME);

    // ou avec le mot-clé const (depuis php 5.3)
    const CONSTANT_NAME2 = 55;
    var_dump(CONSTANT_NAME2);

    $varWithoutTypeOrValue = null;
    var_dump($varWithoutTypeOrValue);

    /*
     * Opérateur de concaténation : le point
     */
    $str1 = "Hello";
    $str2 = "everybody";

    echo $str1." ".$str2;

    /*
     * Opérateurs arithmétiques
     */
    $somme = 45 + 56.45 + "123";
    $difference = 45 - 32;
    $produit = 45 * 43;
    $quotient = 45 / 5;

    var_dump($somme);
    var_dump($difference);
    var_dump($produit);
    var_dump($quotient);

    // conversion automatique des types
    $result = 13 + "34"; // ok : 47
    // $result = "test" - 34; // warning : test vaudra 0
    var_dump($result);

    // $result = "test34" + 3; // warning : test34 vaut 0
    // $result = "34test" + 3; // warning : 34test vaut 34

    // le modulo : le reste
    $modulo = 50 % 3; // 50 - (3 * 16)
    var_dump($modulo);

    // les priorités : les parenthèses
    $ope = 5 * 2 + 6 * 4;
    $ope =  5 * (2 + 6) * 4;











