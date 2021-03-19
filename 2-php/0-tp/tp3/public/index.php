<?php

use App\Controller\BikeController;

require '../vendor/autoload.php';

// router : récupérer l'url pour exécuter le bon contrôleur
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// on définit une liste de routes qui font matcher une url avec un controller
$routes = [
    "/" => [BikeController::class, "list"],
    "/velo/delete" => [BikeController::class, "delete", 'id'],
    "/velo/update" => [BikeController::class, "update", 'id'],
];

$controllerTab = $routes[$url];
$controller = new $controllerTab[0]();
$method = $controllerTab[1];

// on appelle dynamiquement le controller en allant le chercher dans le tableau
// des routes
if (isset($controllerTab[2])) {
    if ($_GET[$controllerTab[2]]) {
        $param = $_GET[$controllerTab[2]];
        $content = $controller->$method($param);
    }
}
else {
    $content = $controller->$method();
}

/*
if ($url == "/") {
    $bikeController = new BikeController();
    $content = $bikeController->list();
}
elseif ($url == "/velo/delete" && isset($_GET['id'])) {
    $bikeController = new BikeController();
    $content = $bikeController->delete($_GET['id']);
}
elseif ($url == "/velo/update" && isset($_GET['id'])) {
    $bikeController = new BikeController();
    $content = $bikeController->update($_GET['id']);
}
*/

echo $content;