<?php
require '../vendor/autoload.php';

use App\Controller\TestController;
use App\Controller\GameController;

// router : récupérer l'url pour exécuter le bon contrôleur
$url = $_SERVER['REQUEST_URI'];
$url = parse_url($url, PHP_URL_PATH);

// on execute le controller en fonction de cette url
if ($url == "/test") {
    $testController = new TestController();
    $content = $testController->pageTest();
}
elseif ($url == "/") {
    $gameController = new GameController();
    $content = $gameController->list();
}
elseif ($url == "/game/delete" && isset($_GET['id'])) {
    $gameController = new GameController();
    $content = $gameController->delete($_GET['id']);
}
else {
    http_response_code(404);
    echo "Cette page n'existe pas";
}

echo $content;