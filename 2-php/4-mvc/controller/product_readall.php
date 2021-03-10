<?php
/*
 * Controller : point d'entrée de la requête
 */
session_start();

if (!isset($_SESSION['logged'])) {
    header('Location:login.php?access=denied');
    exit;
}

require '../database.php';
require '../model/product.php';
$products = getAllProducts($pdo);

require '../view/product_all.php';
?>
