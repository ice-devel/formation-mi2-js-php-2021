<?php
    /*
     * Exo 1
     * A partir d'une date de naissance (jour, mois, année) : Calculer l'âge
     */
    $currentYear = date('Y');
    $currentMonth = date('m');
    $currentDay = date('d');

    $birthYear = 2000;
    $birthMonth = 10;
    $birthDay = 15;

    // V1
    // l'anniv est passé car le mois de naissance est passé
    if ($currentMonth > $birthMonth) {
        $age = $currentYear - $birthYear;
    }

    elseif ($birthMonth == $currentMonth) {
        // l'anniv est passé car mois identitique mais jour de naissance passé
        if ($birthDay <= $currentDay) {
            $age = $currentYear - $birthYear;
        }
        // l'anniv n'est pas passé car mois identique mais jour de naissance pas encore passé
        else {
            $age = $currentYear - $birthYear - 1;
        }
    }
    // l'anniv n'est pas encore passé car le mois actuel n'est pas encore arrivé au mois de naissance
    else {
        $age = $currentYear - $birthYear - 1;
    }

    // V2
    if ($currentMonth > $birthMonth
        || $birthMonth == $currentMonth && $birthDay <= $currentDay)
    {
        $age = $currentYear - $birthYear;
    }
    else {
        $age = $currentYear - $birthYear - 1;
    }

    // V3
    $age = $currentYear - $birthYear;
    if ($currentMonth < $birthMonth
        || $currentMonth == $birthMonth && $currentDay < $birthDay) {
        //$age = $age - 1;
        //$age -= 1;
        $age--;
    }

    /*
     * Exo 2 : afficher la table de multiplication d'un nombre codé en dur
     * 1 * 5 = 5
     * 2 * 5 = 10
     * ...
     * 9 * 5 = 45
     */

    $nb = 9;
    /*
     * Bof bof :
     */
    // echo "1 * $nb = ".(1 * $nb)."<br>";
    // echo "2 * $nb = ".(2 * $nb)."<br>";
    // echo "3 * $nb = ".(3 * $nb)."<br>";

    /*
     * Bien bien :
     */
    for ($i=1; $i <=9; $i++) {
        echo "$i * $nb = ".($i * $nb)."<br>";
    }

    /*
     * Exo 3 :
     * Déclarez un tableau, insérez 5 valeurs dedans puis écrire le script
     * qui dit combien de fois se trouve la valeur "toto" dans ce tableau
     */
    $firstnames = ["gege", "toto", "toto", "jeanjacques", "rené"];
    // pourquoi pas :
    $nbTotos = 0;
    foreach ($firstnames as $fname) {
        if ($fname == "toto") {
            $nbTotos++;
        }
    }

    // ou encore avec une fonction native
    $firstnamesCount = array_count_values($firstnames);
    echo "Nb de toto : ".$firstnamesCount['toto']."<br>";
    /*
     * Exo 4 :
     * Déclarez un tableau, initialisez le avec 6 valeurs entieres
     * Puis écrivez le script qui affiche la valeur la plus grande se trouvant dans  ce tableau
     */
    $integers = [3, 45, 6, 34, 11];
    $max = max($integers);

    // ou alors :
    $max = $integers[0];
    foreach ($integers as $number) {
        if ($number > $max) {
            $max = $number;
        }
    }

    // ou en optimisé (on compare pas le premier nb avec lui-même)
    $max = $integers[0];
    for ($i=1; $i<count($integers); $i++) {
        if ($integers[$i] > $max) {
            $max = $integers[$i];
        }
    }




?>










