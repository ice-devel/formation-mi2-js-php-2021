<?php
const DB_HOST = "localhost";
const DB_USER = "root";
const DB_PASS = "";

function getPdo() {
    $pdo = new PDO("mysql:host=".DB_HOST.";dbname=formation_202103;charset=utf8", DB_USER, DB_PASS);
    return $pdo;
}

