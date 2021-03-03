<?php
    // Commentaire de ligne

    /*
     * Commentaire de bloc
     */

    /*
     * Echange client / serveur
     * - un client (navigateur) appelle une page (url : www.monsite.fr/index.php)
     * - Résolution DNS : URL vers IP
     * - Serveur reçoit la demande
     * - PHP est exécuté, et il retourne une réponse
     * - Serveur web renvoie cette réponse au navigateur
     * https://openclassrooms.com/fr/courses/4525361-realisez-un-dashboard-avec-vos-donnees/5774786-apprehendez-le-fonctionnement-dun-serveur-web
     */

    /*
     * PHP est un langage interprété : il n'est pas compilé mais PHP
     * relis les fichiers sources à chaque demande
     *
     * Technologies équivalentes / concurrentes
     * - Java (oracle)
     * - ASP .NET (Microsoft)
     * - NodeJS (javascript)
     */

    /*
     * Les langages serveur ne sont pas accessibles au public
     *
     */

    /*
     * Environnement nécessaire pour développer un site web :
     * - un ordinateur
     * - un IDE (PHPStorm, VScode, SublimeText, Notepadd++, on the Cloud : codeanywhere)
     * - un serveur web (apache/nginx/serveur interne php)
     * - PHP
     * - Base de données (MySQL, MariaDB, PostgreSQL, Oracle, SQL Server, MongoDB)
     * - xampp (wamp, mamp, lamp)
     *
     * +
     *
     * - git : système de versionning
     * - terminal : git bash, powershell, etc.
     */

    /*
     * Lancer le serveur web : il écoute sur le port 80 (HTTP), ou 443 (HTTPS)
     */

    /*
     * En HTML, on crée des sites statiques :
     * c'est la même chose affichée pour tout le monde, tout le temps.
     *
     * Avec PHP, on va créer des sites dynamiques : qui change en fonction de la date,
     * en fonction de l'utilisateur, d'une condition quelconque
     *
     */

    // afficher quelquechose
    echo "Bonjour";
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
    <h1>Bonjour</h1>
    <p>
        Nous sommes le
        <?php
            echo "<b>".date("d/m/Y H:i:s")."</b>";
        ?>
    </p>
</body>
</html>


