<?php
    function handleRequest() {
        $name = filter_input(INPUT_POST, 'name');
        $email = filter_input(INPUT_POST, 'email');
        $available_at = filter_input(INPUT_POST, 'available_at');
        $description = filter_input(INPUT_POST, 'description');
        $langs = filter_input(INPUT_POST, 'languages',
            FILTER_DEFAULT , FILTER_REQUIRE_ARRAY);
        $cv = isset($_FILES['cv']) ? $_FILES['cv'] : null;

        return [
            'name' => $name,
            'email' => $email,
            'available_at' => $available_at,
            'description' => $description,
            'langs' => $langs,
            'cv' => $cv,
        ];
    }

    function validateApplication($application) {
        // vérification des valeurs
        $errors = [];

        if (mb_strlen($application['name']) < 2) {
            $errors['name'] = "Nom problème";
        }

        if (!filter_var($application['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Email problème";
        }

        if (!preg_match('@^\d{2}/\d{2}/\d{4}@', $application['available_at'])) {
            $errors['available'] = "Dispo problème";
        }
        else {
            $tab = explode("/", $application['available_at']);
            if (!checkdate($tab[1], $tab[0], $tab[2])) {
                $errors['available'] = "Date dispo existe pas";
            }
        }

        if ($application['description'] == "") {
            $errors['description'] = "Desc problème";
        }

        if (empty($application['langs'])) {
            $errors['languages'] = "Au moins un langage";
        }

        if ($application['cv'] == null && $application['cv']['name'] == "") {
            $errors['cv'] = "Envoie ton CV";
        }
        else {
            if ($application['cv']['type'] != "application/pdf") {
                $errors['cv_type'] = "Seulement des PDF";
            }
        }

        return $errors;
    }

    function insertApplication($pdo, $application) {
        $filenameCv = uniqid().$application['cv']['name'];
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
            ':name' => $application['name'],
            ':email' => $application['email'],
            ':available' => date('Y-m-d 00:00:00', strtotime(str_replace ('/', '-', $application['available_at']))),
            ':desc' => $application['description'],
            ':cv' => $filenameCv,
        ]);

        if ($result) {
            $lastId = $pdo->lastInsertId();
            // insertion des languages choisis par le candidat
            $result2 = true;
            foreach ($application['langs'] as $lang) {
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
                if (move_uploaded_file($application['cv']['tmp_name'], "../upload/".$filenameCv)) {
                    // success : on valide l'ensemble des requêtes
                    $pdo->commit();
                    return true;
                }
                else {
                    // une erreur est survenue : on annule toutes les requêtes en cours
                    // dans la transaction
                    //$pdo->rollBack();
                }
            }
            else {
                //$pdo->rollBack();
            }
        }
        else {
            //$pdo->rollBack();
        }

        $pdo->rollBack();
        return false;
    }

    function getAllApplications($pdo) {
        $query = "SELECT * FROM application ORDER BY id DESC";
        $statement = $pdo->query($query);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function getOneApplication($pdo, $id) {
        $query = "SELECT * FROM application WHERE id = :id";
        $statement = $pdo->prepare($query);
        $statement->execute([':id' => $id]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }


