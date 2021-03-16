<?php

namespace App\Model;
use PDO;

class GameManager
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // hydrater l'entité avec des données de bdd
    public function getAll() {
        $query = "SELECT * FROM game";
        $statement = $this->pdo->query($query);

        $games = [];
        while ($game = $statement->fetch(PDO::FETCH_ASSOC)) {
            $game = new Game($game['id'], $game['name'], $game['price']);
            $games[] = $game;
        }

        return $games;
    }


    public function getOne($id) {
        $query = "SELECT * FROM game WHERE id = :id";
        $statement = $this->pdo->prepare($query);
        $statement->execute([':id' => $id]);
        $gameTab = $statement->fetch(PDO::FETCH_ASSOC);

        $game = null;
        if ($gameTab != false) {
            $game = new Game($gameTab['id'], $gameTab['name'], $gameTab['price']);
        }

        return $game;
    }

    public function delete(Game $game) {
        $sql = "DELETE FROM game WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $game->getId()]);
    }
}