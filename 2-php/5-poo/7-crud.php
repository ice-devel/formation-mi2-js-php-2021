<?php
require 'crud/User.php';
require 'crud/UserManager.php';

const DB_HOST = "localhost";
const DB_USER = "root";
const DB_PASS = "";

$pdo = new PDO("mysql:host=".DB_HOST.";dbname=formation_202103;charset=utf8", DB_USER, DB_PASS);

$userManager = new UserManager($pdo);
$users = $userManager->getAll();

if (isset($_POST['insert-user'])) {
    $user = $userManager->handleRequest();
    $errors = $userManager->validate($user);

    if (empty($errors)) {
        if ($userManager->insert($user)) {
            header('Location: 7-crud.php');
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CRUD POO</title>
</head>
<body>
    <h1>Afficher/Supprimer les users</h1>

    <table>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user->getId() ?></td>
            <td><?= $user->getUsername() ?></td>
            <td><?= $user->getPassword() ?></td>
            <td>
                <a href="?action=update&id=<?= $user->getId() ?>">Modifier</a>
                <a href="?action=delete&id=<?= $user->getId() ?>">Supprimer</a>
            </td>
        </tr>
        <?php endforeach ?>
    </table>

    <h1>Créer un user</h1>
    <?php
    ?>
    <form method="post">
        <input type="text" name="username" />
        <input type="text" name="password" />
        <input type="submit" name="insert-user"/>
    </form>

    <h1>Modifier un user</h1>

    <form method="post">
        <input type="text" name="username" />
        <input type="text" name="password" />
        <input type="submit" name="update-user"/>
    </form>
</body>
</html>
