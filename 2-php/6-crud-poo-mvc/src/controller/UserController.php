<?php

namespace App\controller;

use App\database\Connection;
use App\model\UserManager;

class UserController
{
    public function list() {
        $pdo = Connection::getPdo();
        $userManager = new UserManager($pdo);
        $users = $userManager->getAll();

        require '../src/view/list_users.php';
        return $content;
    }

    public function create() {
        return "page de création";
    }
}