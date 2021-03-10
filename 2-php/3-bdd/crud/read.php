<?php
    $id = filter_input(INPUT_GET, 'id');

    // est-ce que l'id a été passé dans l'url
    if ($id == null) {
        echo "Page non trouvée";
        http_response_code(404);
        exit;
    }

    // $id est un entier
    if (!preg_match("/^[1-9][0-9]*$/", $id)) {
        echo "Page non trouvée";
        http_response_code(404);
        exit;
    }

    // est-ce que le produit exite en bdd ?
    $pdo = new PDO("mysql:host=localhost;dbname=formation_202103;charset=utf8", "root", "");
    $sql = "SELECT * FROM product WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);

    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$product) {
        // on peut par exemple rediriger vers la page liste, avec un message
        // mais on peut aussi pourquoi pas à nouveau renvoyer une 404
        header('Location:readall.php?update-missing');
        exit;
    }
?>

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
    <h1><?= $product['name'] ?></h1>
    <div>
        <?=$product['description'] ?>
    </div>
</body>
</html>
