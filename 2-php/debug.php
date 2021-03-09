<?php
    $name = "coucou";

    $number1 = 5;
    $number2 = 10;
    $result = $number1 + $number2;

    for ($i=0;$i<5;$i++) {
        $result += $i;
        $rand = random();
        echo $rand."\n";
    }

    function random() {
        $rand = rand(1, 30);
        return $rand;
    }

    /*
     * - installer une extension php de debug : xdebug
     * - configurer xdebug dans le php.ini
     * - configurer phpstorm pour utiliser l'interpreteur php
     * - ecouter les connexions dans phpstorm
     * - indiquer au navigateur qu'il peut contacter le serveur de debug (extension navigateur pour plus de facilité)
     */
