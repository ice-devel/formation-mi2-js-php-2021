<?php


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

    public function delete() {

    }

    public function handleRequest() {
        $username = filter_input(INPUT_POST, 'name');
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