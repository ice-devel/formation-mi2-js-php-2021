<?php
    require 'database.php';
    require 'model/language.php';
    require 'model/application.php';

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

    require 'view/application_new.php';
?>

