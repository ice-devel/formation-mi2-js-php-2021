<?php

namespace App\Model;

use PDO;

class ColorManager
{
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function findAll() {
        $sql = "SELECT * FROM color";
        $statement = $this->pdo->query($sql);

        $colors = [];
        while ($b = $statement->fetch(PDO::FETCH_ASSOC)) {
            $color = new Color();
            $color->setId($b['id']);
            $color->setName($b['name']);

            $colors[] = $color;
        }

        return $colors;
    }
}