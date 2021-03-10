<?php
/*
 * Contrôleur frontal / Front controller
 * Point d'entrée de l'application, toutes les requêtes passent par ce fichier
 */

// router : récupérer l'url pour exécuter le bon contrôleur
$url = $_SERVER['REQUEST_URI'];
$url = parse_url($url, PHP_URL_PATH);

// on execute le controller en fonction de cette url
if ($url == "/index.php/produits/") {
    require '../controller/product_readall.php';
}
elseif ($url == "/index.php/produit/" && isset($_GET['id'])) {
    require '../controller/product_read.php';
}
else {
    http_response_code(404);
    echo "Cette page n'existe pas";
}