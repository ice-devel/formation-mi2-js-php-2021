<?php
    /*
     * Précisions sur les booléans
     */
    $bool = false;

    // if ($bool == true) {
    if ($bool) {

    }

    // if ($bool == false) {
    if (!$bool) {

    }

    $isAllowed = true;

    if ($isAllowed) {
        // oui autorisé
    }

    $age = 34;

    // V1
    if ($age >= 18) {
        $message = "majeur";
    } else {
        $message = "mineur";
    }
    echo "Vous êtes " . $message;


    // V2 : ternaire : possible quand la seule instruction dans le if ainsi que dans le else
    // est une affection
    $message = $age > 18 ? "majeur" : "mineur";
    echo "Vous êtes " . $message;

    // Autre exemple V1
    $age = 17;

    if ($age >= 18) {
        $isAllowed = true;
    } else {
        $isAllowed = false;
    }

    // V2
    $isAllowed = $age >= 18 ? true : false;

    // V3
    $isAllowed = $age >= 18;
?>










