<?php
/*
 * Front controller
 */
require '../controller/application.php';

/**
 * Configuration du serveur web pour rediriger toutes les requêts vers ce controller :
 * - création du vhost dans apache (+ redémarrer serveur web)
 * - redirection du "faux" domaine vers notre poste : modification du fichier système hosts
 * - config htaccess pour la redirection
 */
// router : récupérer l'url pour exécuter le bon contrôleur
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// on execute le controller en fonction de cette url
if ($url == "/candidature") {
    $content = createApplication();
}
elseif ($url == "/admin/candidatures/liste") {
    $content = listApplication();
}
elseif ($url == "/admin/candidatures/voir" && isset($_GET['id'])) {
    $content = displayApplication($_GET['id']);
}
elseif ($url == "/admin/candidatures/cv" && isset($_GET['name'])) {
    $content = displayApplicationCV($_GET['name']);
}
else {
    http_response_code(404);
    die("Cette page n'existe pas");
}

echo $content;