<?php
/*
 * Controller : point d'entrée de la requête
 */
$id = filter_input(INPUT_GET, 'id');

// est-ce que l'id a été passé dans l'url
if ($id == null) {
    echo "Page non trouvée";
    http_response_code(404);
    exit;
}

// $id est un entier
if (!preg_match("/^[1-9][0-9]*$/", $id)) {
    echo "Page non trouvée";
    http_response_code(404);
    exit;
}

require '../database.php';
require '../model/product.php';
$product = getProduct($id, $pdo);

if (!$product) {
    header('Location:readall.php?update-missing');
    exit;
}

require '../view/product_one.php'
?>