<?php ob_start(); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table {
            border-collapse: collapse;
        }
        table td {
            border: 1px solid;
        }
    </style>
</head>
<body>
    <h1>Liste des vélos</h1>

    <table>
    <?php foreach ($bikes as $bike): ?>
        <tr>
            <td><?= $bike->getId() ?></td>
            <td><?= $bike->getName() ?></td>
            <td><?= $bike->getFrame() == "m" ? "homme" : "femme" ?></td>
            <td><?= $bike->getHasSuspension() ? "oui" : "non"?></td>
            <td><?= $bike->getCreatedAt()->format("d/m/Y H:i") ?></td>
            <td><?= $bike->getPrice() ?></td>
            <td><?= $bike->getSize() ?></td>
            <td><?= $bike->getColor()->getName() ?></td>
            <td><a href="/velo/update?id=<?= $bike->getId() ?>">Modifier</a></td>
            <td><a href="/velo/delete?id=<?= $bike->getId() ?>">Supprimer</a></td>
        </tr>
    <?php endforeach ?>
    </table>
</body>
</html>
<?php $content = ob_get_contents(); ob_clean(); ?>