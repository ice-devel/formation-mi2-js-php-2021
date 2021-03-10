<?php
/*
 * Controller : point d'entrée de la requête
 */
session_start();

if (!isset($_SESSION['logged'])) {
    header('Location:login.php?access=denied');
    exit;
}

require '../model/product.php';
$products = getAllProducts();

require '../view.php';
?>
