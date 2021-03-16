<?php

namespace App\database;

use PDO;

class Connection
{
    const DB_HOST = "localhost";
    const DB_USER = "root";
    const DB_PASS = "";

    static public function getPdo() {
        $pdo = new PDO("mysql:host=".self::DB_HOST.";dbname=formation_202103;charset=utf8", self::DB_USER, self::DB_PASS);
        return $pdo;
    }
}