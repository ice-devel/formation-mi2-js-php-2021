<?php
    /*
     * Structures conditionnelles
     */

    /*
     * Le IF et le SWITCH
     * Conditions multiples :
     * On peut assembler plusieurs conditions grâce aux opérateurs logiques
     * AND : &&
     * OR : ||
     * Inverser une condition : !
     */

    /*
     *  le IF
     */
    $age = 18;
    $majorite = 18;

    if ($age >= $majorite) {
        // instructions à exécuter si conditions vraie
        echo "Vous avez accès à notre contenu VIP";
    }
    // ELSE : instructions à exécuter si la conditions est fausse
    else {
        echo "Adieu, tu es trop jeune";
    }

    // conditions multiples
    if (3 == 3 && 4 > 2 || "test" == "test2") {
        // on rentre
    }

    // inverser une condition : le !
    if (!5 == 5) {
        // on rentre pas
    }

    // les priorités dans les conditions
    // par défaut : D'abord les ET, puis les OU
    // mais on peut prioriser grâce aux parenthèses
    if (3 == 4 && (2 == 2 || 4 == 5)) {

    }

    // le elseif
    if ($age > 18) {

    }
    elseif ($age > 15) {

    }
    elseif ($age > 10) {

    }
    else {

    }

    /*
     * Le SELON : pour tester une valeur
     */
    $age = 40;
    switch ($age) {
        case 10:
            // réduction pour les 10 ans
            break;
        case 18:
            // réduction pour les nouveaux majeurs
            break;
        default:
            // facultatif
            // ni 10, ni 18
    }

    // conversion de types
    $str = "Chaine";
    if ($str == 34) {
        // pas de warning
        // on rentre pas
        // 34 est converti en "34"
    }

    if ($str < 10) {
        // on rentre : $str est converti en 0
    }

    /*
     *  Opérateurs de comparaison stricte
     *  ===
     *  !==
     * Pour comparer les valeurs et les types
     *
     */

    if  (5 == "5") {
        // on rentre
    }

    if  (5 === "5") {
        // on rentre pas : les types ne sont pas les mêmes
    }

    if ("coucou" == true) {
        // on rentre
        // chaine remplie vaut le booléen vrai
        // chaine vide vaut le booléen faux

        // nombre 0 vaut le booléen faux
        // tous les autres nombres valent vrai
    }

    if (1 == true) {
        // on rentre
    }

    if (1 === true) {
        // on rentre pas
    }

    $str = "Hello";

    // strpos : permet de rechercher la position d'une chaine dans une chaine
    // si la chaine est trouvée, alors sa position est renvoyée
    // si la chaine n'est pas trouvée, alors false est renvoyé
    if (strpos($str, "H") !== false) {
        echo "Le H est trouvé dans ".$str;
    }


?>










