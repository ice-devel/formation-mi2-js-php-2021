<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GET</title>
</head>
<body>
    <h1>Transmission POST</h1>

    <?php
    /*
     * Pour passer des données depuis un client (navigateur)
     * vers un serveur, il y a plusieurs méthodes dont les deux principales :
     * GET et POST
     * - GET :
     *  - partage d'url (numéro de page, des filtres, etc.)
     *  - mettre les urls en favoris
     *  - retrouver historique
     *  - création de lien avec des paramètres
     *
     * - POST :
     *  - se protéger des personnes qui sont derrière, ou qui utilisent le même
     *  ordinateur et pourraient donc obtenir des informations confidentielles
     * comme les mots de passe
     *  - pas limité en taille (sauf config serveur, comme post_max_size de PHP)
     *
     * Attention : aucune des deux n'est plus sécurisé que l'autre. La sécurité
     * doit être mise en place côté serveur.
     */
    ?>

    <?php
    // 1- est-ce que le formulaire a été soumis ?
    if (isset($_POST['form-register'])) {
        // 2 - récupération des données en POST
        // $lastname = $_POST['lastname'];

        // 2b - en vérifiant quand même si la clé existe
        /*
        if (isset($_POST['lastname'])) {
            $lastname = $_POST['lastname'];
        }
        else {
            $lastname = null;
        }
        */

        // 2c - avec une ternaire
        // $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : null;

        // 2d - the best solution if from scratch
        $lastname = filter_input(INPUT_POST, 'lastname');
        $email = filter_input(INPUT_POST, 'email');
        $phone = filter_input(INPUT_POST, 'phone');

        // 3 - vérification
        // (nom est obligatoire, et min. 3 caractères
        // email obligatoire et format email
        // telephone facultatif, format 10 chiffres, commençant par un zéro
        $errors = [];

        //if ($lastname == "" || mb_strlen($lastname) < 3) {
        if (mb_strlen($lastname) < 3) {
            $errors['lastname'] = "Veuillez saisir votre nom correctement";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Veuillez saisir votre email correctement";
        }

        if ($phone != "" && !preg_match("/^0[0-9]{9}$/", $phone)) {
            $errors['phone'] = "Veuillez saisir votre téléphone correctement";
        }

        // 4 - si pas d'erreur : enregistrement en bdd
        if (empty($errors)) {
            // pas d'erreur : bdd
            // redirection vers page de confirmation par exemple
        }
        else {
            $message = "Désolé y'a des erreurs";
        }
    }
    ?>

    <?php
        if (isset($message)) {
            echo "<p style='color:red'>$message</p>";

            echo "<ul>";
            foreach ($errors as $error) {
                echo "<li>$error</li>";
            }
            echo "</ul>";
        }
    ?>
    <p>Envoyer des données POST depuis un formulaire</p>
    <form method="post" action="">
        <input type="text" name="lastname" />
        <input type="email" name="email" />
        <input type="tel" name="phone" />
        <input type="submit" name="form-register"/>
    </form>
</body>
</html>



