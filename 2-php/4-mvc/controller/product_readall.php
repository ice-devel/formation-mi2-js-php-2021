<?php
/*
 * Controller : point d'entrée de la requête
 */
session_start();

if (!isset($_SESSION['logged'])) {
    header('Location:login.php?access=denied');
    exit;
}

require 'models/product.php';

require 'view.php';
?>
