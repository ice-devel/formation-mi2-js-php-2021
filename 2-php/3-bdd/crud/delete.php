<?php
    session_start();

    if (!isset($_SESSION['logged'])) {
        header('Location:login.php?access=denied');
        exit;
    }

    // supprimer l'utilisateur dont l'id a été passé dans l'url
    $id = filter_input(INPUT_GET, 'id');

    if ($id != null) {
        $id = intval($id);
        // vérifier si le produit existe en bdd, vérifier que l'id est un entier et que != 0
        $sql = "DELETE FROM product WHERE id = :id";
        $pdo = new PDO("mysql:host=localhost;dbname=formation_202103;charset=utf8", "root", "");
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute([':id' => $id]);

        if (!$result ) {
            // pour debugger
            // attention, ne sutout laisser ce genre de choses en production
            // trop d'informations techniques et confidentielles à ne pas communiquer au public
            $stmt->debugDumpParams();
            var_dump($stmt->errorInfo());
            var_dump($pdo->errorInfo());

            $code = 0;
        }
        else {
            $code = $id;
        }
    }
    else {
        $code = -1;
    }

    header("Location:readall.php?delete=$code");

