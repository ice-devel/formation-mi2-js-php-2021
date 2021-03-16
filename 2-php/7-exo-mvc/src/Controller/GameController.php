<?php
namespace App\Controller;

class GameController
{
    public function list() {
        require '../src/View/game/list.php';
        return $content;
    }
}