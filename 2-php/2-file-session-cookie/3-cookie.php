<?php
    /*
     * C KOI LES COOKIES
     * Les cookies sont des moyens de pouvoir passer des informations de page en page
     * lors de la navigation d'un utilisateur
     *
     * Ils sont stockées sur le navigateur
     */
    if (isset($_GET['logout'])) {
        // pour suprimer un cookie, on recrée un cookie avec le même nom, qui expire now
        setcookie("logged");
            // on peut supprimer les clés dans le tableau cookie pour le reste du script
        // unset($_COOKIE['logged']);
        // ou alors, on redirige
        header("Location: 3-cookie.php");
        exit;
    }

    if (isset($_POST['username'])) {
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');

        if ($username == "toto" && $password == "123") {
            setcookie("logged", true, time() + 3600); // le cookie expire dans 1 heure (seconde depuis 1970 + 3600)
            // On peut créer la variable à la main si on le souhaite pour que le reste du script l'utilise
            //$_COOKIE['logged'] = true;
            // ou alors on redirige vers une page de confirmation
            header('Location: 3-cookie.php');
            exit;
        }

    }

    if (isset($_COOKIE['logged'])) {
        echo "Bienvenue ! Vous êtes déjà connecté <a href='?logout'>Déconnexion</a>";
    }
?>

<form method="post">
    <input type="text" name="username" placeholder="Identifiant"/>
    <input type="text" name="password" placeholder="Mot de passe"/>
    <input type="submit" />
</form>

