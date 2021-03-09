<?php
    // supprimer l'utilisateur dont l'id a été passé dans l'url
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

    // est-ce que le joueur exite en bdd ?
    $pdo = new PDO("mysql:host=localhost;dbname=formation_202103;charset=utf8", "root", "");
    $sql = "SELECT * FROM player WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);

    $player = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$player) {
        // on peut par exemple rediriger vers la page liste, avec un message
        // mais on peut aussi pourquoi pas à nouveau renvoyer une 404
        header('Location:2-select.php?update-missing');
        exit;
    }

    $name = $player['name'];
    $email = $player['email'];
    $zipcode = $player['zipcode'];
    $team = $player['team_id'];
    // est-ce que le formulaire est soumis ?
    if (isset($_POST['btn_submit'])) {
        $name = filter_input(INPUT_POST, 'name');
        $email = filter_input(INPUT_POST, 'email');
        $zipcode = filter_input(INPUT_POST, 'zipcode');
        $team = filter_input(INPUT_POST, 'team');

        $errors = [];
        if ($name == "") {
            $errors['name'] = "Coucou le nom est mauvais";
        }
        if ($email == "") {
            $errors['name'] = "Coucou l'email est mauvais";
        }
        if ($zipcode == "") {
            $errors['name'] = "Coucou le code postal est mauvais";
        }
        if ($team == "") {
            $errors['name'] = "Coucou l'équipe est mauvais";
        }

        if (empty($errors)) {
            $pdo = new PDO("mysql:host=localhost;dbname=formation_202103;charset=utf8", "root", "");
            $sql = "UPDATE player SET name=:nameParam, email=:emailParam,
                    zipcode=:zipcodeParam, team_id=:teamParam WHERE id=:idParam";
            $stmt = $pdo->prepare($sql);
            $result = $stmt->execute([
                ':nameParam' => $name,
                ':emailParam' => $email,
                ':zipcodeParam' => $zipcode,
                ':teamParam' => $team,
                ':idParam' => $id,
            ]);

            if ($result) {
                // message de succes ou redirection
                header("Location:7-update.php?id=$id&success");
                exit;
            }
            else {
                $message = "Une erreur est survenue";
            }
        }
        else {
            $message = "Une erreur est survenue";
        }
    }

?>

<h1>Modifier un joueur</h1>

<?php
if (isset($message)) {
    echo $message."<br>";
    var_dump($errors);
}
?>
<form method="POST">
    <input type="text" name="name" value="<?= $name ?>"/><br>
    <input type="email" name="email" value="<?= $email ?>"/><br>
    <input type="text" name="zipcode" value="<?= $zipcode ?>"/><br>
    <input type="number" name="team" value="<?= $team ?>"/><br>
    <input type="submit" name="btn_submit"/>
</form>
