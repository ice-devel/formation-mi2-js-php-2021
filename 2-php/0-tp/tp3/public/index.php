<?php
session_start();

use App\Controller\BikeController;
use App\Controller\SecurityController;
use App\Routing\Router;

require '../vendor/autoload.php';

// router : récupérer l'url pour exécuter le bon contrôleur
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// on définit une liste de routes qui font matcher une url avec un controller
$router = new Router();
$router->addRoute("/admin", BikeController::class, "list");
$router->addRoute("/admin/velo/delete", BikeController::class, "delete", ['id']);
$router->addRoute("/admin/velo/update", BikeController::class, "update", ['id']);
$router->addRoute("/login", SecurityController::class, "login");

if ($router->match($url)) {
    // on protège les pages avec une expression régulière : ici tout ce qui commence par /admin
    $protectedPages = "@^/admin@";
    if (preg_match($protectedPages, $url) && !isset($_SESSION['connected'])) {
        // page protégé mais on est pas connecté
        header('Location: /login');
        exit;
    }

    $controllerName = $router->getController($url);
    $controller = new $controllerName();
    $method = $router->getMethod($url);

    // on appelle dynamiquement le controller en allant le chercher dans le tableau
    // des routes
    $content = $controller->$method($_GET);
}
else {
    http_response_code(404);
    $content =  "PAGE INCONNUE";
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