<?php

namespace App\Model;

use DateTime;
use PDO;

class BikeManager
{
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function findAll() {
        $sql = "SELECT b.id AS bike_id, b.name AS bike_name, frame, price, created_at, has_suspension, size,
                        c.id AS color_id, c.name AS color_name
                FROM bike B INNER JOIN color C ON b.color_id = c.id";
        $statement = $this->pdo->query($sql);

        $bikes = [];
        while ($b = $statement->fetch(PDO::FETCH_ASSOC)) {
            $bike = new Bike();
            $bike->setId($b['bike_id']);
            $bike->setFrame($b['frame']);
            $bike->setHasSuspension(boolval($b['has_suspension']));
            //$bike->setHasSuspension($b['has_suspension'] == 1);
            $bike->setName($b['bike_name']);
            $bike->setSize($b['size']);
            $bike->setPrice($b['price']);
            $bike->setCreatedAt(new DateTime($b['created_at']));

            $color = new Color();
            $color->setId($b['color_id']);
            $color->setName($b['color_name']);
            $bike->setColor($color);

            $bikes[] = $bike;
        }

        return $bikes;
    }

    public function delete(Bike $bike) {
        $sql = "DELETE FROM bike WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $bike->getId()]);
    }

    public function find($id) {
        $query = "SELECT b.id AS bike_id, b.name AS bike_name, frame, price, created_at, has_suspension, size,
                        c.id AS color_id, c.name AS color_name
                FROM bike B INNER JOIN color C ON b.color_id = c.id WHERE b.id = :id";
        $statement = $this->pdo->prepare($query);
        $statement->execute([':id' => $id]);
        $b = $statement->fetch(PDO::FETCH_ASSOC);

        $bike = null;
        if ($b != false) {
            $bike = new Bike();
            $bike->setId($b['bike_id']);
            $bike->setFrame($b['frame']);
            $bike->setHasSuspension(boolval($b['has_suspension']));
            $bike->setName($b['bike_name']);
            $bike->setSize($b['size']);
            $bike->setPrice($b['price']);
            $bike->setCreatedAt(new DateTime($b['created_at']));

            $color = new Color();
            $color->setId($b['color_id']);
            $color->setName($b['color_name']);
            $bike->setColor($color);
        }

        return $bike;
    }

    public function update(Bike $bike) {
        $sql = "UPDATE bike 
                SET name = :name, price = :price
                WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':name' => $bike->getName(),
            ':price' => $bike->getPrice(),
            ':id' => $bike->getId(),
        ]);

    }
    
    public function handleRequest(Bike $bike) {
        $bike->setName(filter_input(INPUT_POST, 'name'));
    }
    
    public function validate(Bike $bike) {
        return [];
    }
}