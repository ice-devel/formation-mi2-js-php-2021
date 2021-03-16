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
    <h1>Liste des jeux</h1>
    <table>
        <?php foreach ($games as $game): ?>
            <tr>
                <td><?= $game->getId() ?></td>
                <td><?= $game->getName() ?></td>
                <td><?= $game->getPrice() ?>€</td>
                <td><a href="/game/delete?id=<?= $game->getId() ?>">Supprimer</a></td>
            </tr>
        <?php endforeach ?>
    </table>
</body>
</html>
<?php $content = ob_get_contents(); ob_end_clean(); ?>