<?php
/*
 * utiliser l'autoload de composer dans votre projet
 *
 * - se mettre en à la racine du projet en ligne de commande
 * - initialiser composer : composer init
 * - configurer le composer.json et ajouter la clé "autoload" dans laquelle vous configurez la clé "psr-4"
 * - générer le fichier d'autoload à inclure dans votre controller frontal : composer dump-autoload
 */

// on inclut uniquement l'autoload de composer
require_once("vendor/autoload.php");

// no need to include the files anymore
use Fab\Forum\Message;
use Fab\Entity\Message as EntityMessage;
use Detection\MobileDetect;

$message = new Message();
$message = new EntityMessage();
var_dump($message);

$mobilDetect = new MobileDetect();

if ($mobilDetect->isMobile()) {

}
else {
    echo "VOUS NETES PAS LE CAPITAINE";
}


