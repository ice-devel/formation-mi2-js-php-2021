<?php
    // supprimer l'utilisateur dont l'id a été passé dans l'url
    $id = filter_input(INPUT_GET, 'id');

    if ($id != null) {
        $id = intval($id);
        // vérifier si le joueur existe en bdd, vérifier que l'id est un entier et que != 0
        $sql = "DELETE FROM player WHERE id = ?";
        $pdo = new PDO("mysql:host=localhost;dbname=formation_202103;charset=utf8", "root", "");
        $stmt = $pdo->prepare($sql);
        //$stmt->bindValue(1, $id);
        $result = $stmt->execute([$id]);

        if (!$result ) {
            // pour debugger
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

    header("Location:2-select.php?delete=$code");

