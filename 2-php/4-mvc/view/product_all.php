<?php
    /*
     * View : interface graphique
     */
?>

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
        table td, table th {
            border: 1px solid;
        }
    </style>
</head>
<body>
<h1>Liste des produits</h1>

<table>
    <thead>
    <tr>
        <th>Code</th>
        <th>Nom</th>
        <th>Prix</th>
        <th>Catégorie</th>
        <th>Actions</th>
    </tr>
    </thead>

    <tbody>
    <?php foreach ($products as $product): ?>
        <tr>
            <td><?= $product['code'] ?></td>
            <td><?= $product['product_name'] ?></td>
            <td><?= str_replace('.', ',', $product['price']) ?>€</td>
            <td><?= $product['category_name'] ?></td>
            <td>
                <a href='update.php?id=<?= $product['id'] ?>'>Modifier</a>
                <a href='delete.php?id=<?= $product['id'] ?>'>Supprimer</a>
                <a href='read.php?id=<?= $product['id'] ?>'>Afficher</a>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
</body>
</html>
