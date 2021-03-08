<?php
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
            $sql = "INSERT INTO player (name, email, zipcode, team_id, is_enabled)
                    VALUES (:nameParam, :emailParam, :zipcodeParam, :teamParam, 1)";
            $stmt = $pdo->prepare($sql);
            $result = $stmt->execute([
                ':nameParam' => $name,
                ':emailParam' => $email,
                ':zipcodeParam' => $zipcode,
                ':teamParam' => $team,
            ]);

            if ($result) {
                // message de succes ou redirection
                $message = "Succès";
            }
            else {
                $message = "Une erreur est survenue";
            }
        }
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
    <?php
    if (isset($message)) {
        echo $message."<br>";
    }
    ?>
    <form method="POST">
        <input type="text" name="name" /><br>
        <input type="email" name="email" /><br>
        <input type="text" name="zipcode" /><br>
        <input type="number" name="team" /><br>
        <input type="submit" name="btn_submit" />
    </form>

</body>
</html>
