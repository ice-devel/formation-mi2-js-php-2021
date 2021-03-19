<?php
namespace App\Database;

class Connection
{
    static private $pdo;
    const DB_HOST = "localhost";
    const DB_USER = "root";
    const DB_PASS = "";
    static public function getPdo() {
        if (self::$pdo == null) {
            self::$pdo = new \PDO("mysql:host=".self::DB_HOST.";dbname=formation_202103;charset=utf8",
                self::DB_USER, self::DB_PASS);
        }

        return self::$pdo;
    }
}