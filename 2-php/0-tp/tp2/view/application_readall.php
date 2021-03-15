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
        table td, table th {
            border: 1px solid;
        }
    </style>
</head>
<body>
<h1>Liste des candidatures</h1>

<table>
    <thead>
    <tr>
        <th>Date</th>
        <th>Nom</th>
        <th>Email</th>
        <th>Actions</th>
    </tr>
    </thead>

    <tbody>
    <?php foreach ($applications as $application): ?>
        <tr>
            <td><?= $application['created_at'] ?></td>
            <td><?= $application['name'] ?></td>
            <td><?= $application['email'] ?></td>
            <td>
                <a href='/admin/candidatures/voir?id=<?= $application['id'] ?>'>Afficher</a>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
</body>
</html>
<?php $content = ob_get_contents(); ob_end_clean(); ?>