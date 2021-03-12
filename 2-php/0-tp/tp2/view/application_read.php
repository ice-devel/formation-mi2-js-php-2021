
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
<h1>Affichage d'une candidature</h1>

<h2><?= $application['name'] ?> - <?= $application['email'] ?></h2>

<p>
    Le <?= $application['created_at'] ?><br>
    <?= $application['description'] ?>
</p>

<p>
    <a href="/admin/candidatures/cv?name=<?= $application['cv_filename'] ?>">Voir le CV</a>
</p>

</body>
</html>