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
    <h1>Transmission GET</h1>

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
        // récupération des paramètres GET
        if (isset($_GET['cle'])) {
            $cle = $_GET['cle'];
        }
        if (isset($_GET['cle2'])) {
            $cle2 = $_GET['cle2'];
        }
        if (isset($_GET['lastname'])) {
            $lastname = $_GET['lastname'];
        }
    ?>

    <p>Envoyer des données GET depuis un lien</p>
    <a href="?cle=valeur&cle2=valeur2">Lien qui passe des données</a>

    <p>Envoyer des données GET depuis un formulaire</p>
    <form method="get" action="">
        <input type="text" name="lastname" />
        <input type="submit" />
    </form>
</body>
</html>



