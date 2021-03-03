<?php
// est-ce que c'est une requête qui appelle ce fichier ?

// formulaire soumis ?
if (isset($_POST['pseudo'])) {
    // récupération des valeurs
    $pseudo = filter_input(INPUT_POST, 'pseudo');
    $zipcode = filter_input(INPUT_POST, 'zipcode');
    $country = filter_input(INPUT_POST, 'country');

    // vérification
    $errors = [];
    if (mb_strlen($pseudo) < 5) {
        $errors[] = "Le pseudo est incorrect.";
    }

    if (!preg_match("/^(2[0-9AB]|[0-9]{2})[0-9]{3}$/", $zipcode)) {
        $errors[] = "Le code postal est incorrect.";
    }

    $countries = ["France", "Norvège", "Japon", "Maroc", "Pays-Bas"];
    if (!in_array($country, $countries)) {
        $errors[] = "Le pays est incorrect.";
    }

    // envoi en bdd..
    if (empty($errors)) {
        // redirection, mail, etc.
        echo 0;
    }
    else {
        $result['code'] = -1;
        $result['errors'] = $errors;
        echo json_encode($result);
    }
}