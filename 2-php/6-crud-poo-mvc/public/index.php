<?php
/*
 * Contrôleur frontal / Front controller
 * Point d'entrée de l'application, toutes les requêtes passent par ce fichier
 */
require '../vendor/autoload.php';

use App\controller\UserController;

// router : récupérer l'url pour exécuter le bon contrôleur
$url = $_SERVER['REQUEST_URI'];
$url = parse_url($url, PHP_URL_PATH);

// on execute le controller en fonction de cette url
if ($url == "/") {
    $userController = new UserController();
    $content = $userController->list();
}
elseif ($url == "/insert-user") {
    $userController = new UserController();
    $content = $userController->create();
}
else {
    http_response_code(404);
    echo "Cette page n'existe pas";
}

echo $content;