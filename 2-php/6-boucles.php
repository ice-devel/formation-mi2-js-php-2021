<?php
/*
 * Les boucles : structures itératives
 * for, while, do while
 * Répéter une ou plusieurs instructions un certain nombre de fois
 */

echo "Tour 1";
echo "Tour 2";
echo "Tour 3";
echo "Tour 4";
echo "Tour 5";
echo "Tour 6";

// boucle for : 3 paramètres (initialisation, condition d'arret, incrementation)
for ($i=0; $i<=5; $i++) {
    echo "Tour ".($i + 1);
}

// boucle while : nb itération inconnu, possibilité d'avoir 0 itération
$sum = rand(0, 100);

while ($sum < 100) {
    $result = rand(0, 100);
    $sum += $result;
}

//boucle do while : nb itération inconnu, au moins une itération
$sum = 0;
do {
    $result = rand(0, 20);
    $sum += $result;
} while ($sum < 100);


?>










