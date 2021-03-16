<?php

namespace App\model;
use PDO;

class UserManager
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // hydrater l'entité avec des données de bdd
    public function getAll() {
        $query = "SELECT * FROM user";
        $statement = $this->pdo->query($query);

        $users = [];
        while ($user = $statement->fetch(PDO::FETCH_ASSOC)) {
            $user = new User($user['id'], $user['username'], $user['password']);
            $users[] = $user;
        }

        return $users;
    }

    public function insert(User $user) {
        $sql = "INSERT INTO user (username, password)
                    VALUES (:username, :password)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':username' => $user->getUsername(),
            ':password' => $user->getPassword(),
        ]);
    }

    public function update() {

    }

    public function getOne($id) {
        $query = "SELECT * FROM user WHERE id = :id";
        $statement = $this->pdo->prepare($query);
        $statement->execute([':id' => $id]);
        $userTab = $statement->fetch(PDO::FETCH_ASSOC);

        $user = null;
        if ($userTab != false) {
            $user = new User($userTab['id'], $userTab['username'], $userTab['password']);
        }

        return $user;
    }

    public function delete(User $user) {
        $sql = "DELETE FROM user WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $user->getId()]);
    }

    public function handleRequest() {
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');

        return new User(null, $username, $password);
    }

    public function validate(User $user) {
        $errors = [];
        if ($user->getUsername() == "") {
            $errors['name'] = "Nom pas bon";
        }

        if ($user->getPassword() == "") {
            $errors['password'] = "Password pas bon";
        }

        return $errors;
    }
}