<?php
    function createApplication() {
        require '../database.php';
        require '../model/language.php';
        require '../model/application.php';

        $pdo = getPdo();
        $languages = getAllLanguages($pdo);

        // formulaire soumis ?
        if (isset($_POST['form_application'])) {
            // récupération des valeurs
            $application = handleRequest();

            // vérification
            $errors = validateApplication($application);

            if (empty($errors)) {
                // insertion
                insertApplication($pdo, $application);
            }
        }

        require '../view/application_new.php';
    }

    function listApplication() {
        require '../database.php';
        require '../model/application.php';

        $pdo = getPdo();
        $applications = getAllApplications($pdo);

        require '../view/application_readall.php';
    }

    function displayApplication($id) {
        require '../database.php';
        require '../model/application.php';

        $pdo = getPdo();
        $application = getOneApplication($pdo, $id);

        if (!$application) {
            header('Location:/admin/candidatures/liste');
            exit;
        }

        require '../view/application_read.php';
    }

    function displayApplicationCV($name) {
        // ce controller permet d'afficher un cv
        // on passe par un controller car les fichiers sont privés et ne peuvent donc être appelés
        // directement par un navigateur
        $filename = "../upload/".$name;
        header("Content-Disposition: inline; filename=$filename");
        header("Content-type: application/pdf");
        readfile($filename);
    }