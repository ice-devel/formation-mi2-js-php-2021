<?php
    require 'database.php';
    $result = $pdo->query("SELECT id, name FROM language");
    $languages = $result->fetchAll(PDO::FETCH_ASSOC);

    // formulaire soumis ?
    if (isset($_POST['form_application'])) {
        // récupération des valeurs
        $name = filter_input(INPUT_POST, 'name');
        $email = filter_input(INPUT_POST, 'email');
        $available_at = filter_input(INPUT_POST, 'available_at');
        $description = filter_input(INPUT_POST, 'description');
        $langs = filter_input(INPUT_POST, 'languages',
                                FILTER_DEFAULT , FILTER_REQUIRE_ARRAY);
        $cv = isset($_FILES['cv']) ? $_FILES['cv'] : null;

        // vérification des valeurs
        $errors = [];

        if (mb_strlen($name) < 2) {
            $errors['name'] = "Nom problème";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Email problème";
        }

        if (!preg_match('@^\d{2}/\d{2}/\d{4}@', $available_at)) {
            $errors['available'] = "Dispo problème";
        }
        else {
            $tab = explode("/", $available_at);
            if (!checkdate($tab[1], $tab[0], $tab[2])) {
                $errors['available'] = "Date dispo existe pas";
            }
        }

        if ($description == "") {
            $errors['description'] = "Desc problème";
        }

        if (empty($langs)) {
            $errors['languages'] = "Au moins un langage";
        }

        if ($cv == null && $cv['name'] == "") {
            $errors['cv'] = "Envoie ton CV";
        }
        else {
            if ($cv['type'] != "application/pdf") {
                $errors['cv_type'] = "Seulement des PDF";
            }
        }

        if (empty($errors)) {
            $filenameCv = uniqid().$cv['name'];
            /*
             * Transaction si plusieurs requetes de modification des données
             * (insert, update, delete) vont être réalisées, il faut les grouper dans une transaction
             * La transaction permet d'éviter que si l'une des requête plante, les autres soient envoyées :
             * on veut que tout fonctionne ou rien du tout, sinon on aurait des incohérences dans la bdd
             */
            // insertion de la candidature
            $pdo->beginTransaction();
            $sql = "INSERT INTO application (name, email, available_at, description, cv_filename)
                    VALUES (:name, :email, :available, :desc, :cv)";
            $stmt = $pdo->prepare($sql);
            $result = $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':available' => date('Y-m-d 00:00:00', strtotime(str_replace ('/', '-', $available_at))),
                ':desc' => $description,
                ':cv' => $filenameCv,
            ]);

            if ($result) {
                $lastId = $pdo->lastInsertId();
                // insertion des languages choisis par le candidat
                $result2 = true;
                foreach ($langs as $lang) {
                    $sql = "INSERT INTO application_language (application_id, language_id) 
                            VALUES ($lastId, $lang)";
                    if (!$pdo->query($sql)) {
                        $result2 = false;
                        break;
                    }
                }

                if ($result2) {
                    // upload du CV
                    // api
                    if (move_uploaded_file($cv['tmp_name'], "upload/".$filenameCv)) {
                        // success : on valide l'ensemble des requêtes
                        $pdo->commit();
                    }
                    else {
                        // une erreur est survenue : on annule toutes les requêtes en cours
                        // dans la transaction
                        $pdo->rollBack();
                    }
                }
                else {
                    $pdo->rollBack();
                }
            }
            else {
                $pdo->rollBack();
                $errors['systeme'] = "erreur sql";
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
    <h1>Formulaire de candidature</h1>

    <?php
        if (isset($errors))
        var_dump($errors);
    ?>
    <form method="post" enctype="multipart/form-data">
        <input type="text" name="name" /><br>
        <input type="email" name="email" /><br>
        <input type="text" name="available_at" /><br>
        <textarea name="description"></textarea><br>
        <select name="languages[]" multiple><br>
            <?php foreach ($languages as $language): ?>
                <option value="<?= $language['id'] ?>"><?= $language['name'] ?></option>
            <?php endforeach ?>
        </select><br>
        <input type="file" name="cv" /><br>

        <input type="submit" name="form_application" />
    </form>
</body>
</html>
