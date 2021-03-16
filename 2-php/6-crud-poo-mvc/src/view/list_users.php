<?php ob_start(); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
</body>
</html>
<?php $content = ob_get_contents(); ob_end_clean(); ?>