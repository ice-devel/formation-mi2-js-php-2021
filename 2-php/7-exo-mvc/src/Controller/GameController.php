<?php
namespace App\Controller;

use App\Database\Connection;
use App\Model\GameManager;

class GameController
{
    public function list() {
        $pdo = Connection::getPdo();
        $gameManager = new GameManager($pdo);
        $games = $gameManager->getAll();
        require '../src/View/game/list.php';
        return $content;
    }

    public function delete($id) {
        $pdo = Connection::getPdo();
        $gameManager = new GameManager($pdo);

        // le game à supprimer
        $game = $gameManager->getOne($id);

        if ($game != null) {
            $gameManager->delete($game);
        }

        header("Location: /");
        exit;
    }
}