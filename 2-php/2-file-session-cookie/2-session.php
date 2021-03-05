<?php
    /*
     * C KOI Lé SESSION
     * Les sessions sont des moyens de pouvoir passer des informations de page en page
     * lors de la navigation d'un utilisateur
     *
     * Elles sont stockées sur le serveur
     */
    session_start();

    if (isset($_GET['logout'])) {
        session_destroy();
        // on peut supprimer les clés dans le tableau session pour le reste du script
        // unset($_SESSION['logged']);
        // ou alors, on redirige
        header("Location: 2-session.php");
        exit;
    }

    if (isset($_POST['username'])) {
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');

        if ($username == "toto" && $password == "123") {
            // stocker une valeur en session
            // la clé "logged" est arbitraire, c'est à vous de choisir
            $_SESSION['logged'] = true;
        }
    }

    if (isset($_SESSION['logged'])) {
        echo "Bienvenue ! Vous êtes déjà connecté <a href='?logout'>Déconnexion</a>";
    }


?>


<form method="post">
    <input type="text" name="username" placeholder="Identifiant"/>
    <input type="text" name="password" placeholder="Mot de passe"/>
    <input type="submit" />
</form>

