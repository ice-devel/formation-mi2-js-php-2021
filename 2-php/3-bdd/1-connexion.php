<?php
    /*
     * Vieille version
     1ère étape : connexion au serveur bdd
    mysql_connect("localhost", "root", "");
     2ème étape : choix de la bdd
    mysql_select_db("nomdelabase");
     3eme : requêter la base
    $query = "SELECT * FROM user";
    $result = mysql_query($query);
    */

    /*
     * Mysqli : version intermédiaire
     */
    /*
    $db = mysqli_connect("localhost", "root", "", "nomdelabase");
    mysqli_set_charset($db, "utf8");
    $query = "SELECT * FROM user";
    $result = mysqli_query($db, $query);

    on transforme la ressource en tableau associatif
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);

    foreach ($users as $user) {
        $user['name'];
    }
     *
     */

    /*
     * Version cool : PDO - PHP Data Object
     */
    // 1ére étape : connexion à la bdd
    $pdo = new PDO("mysql:host=localhost;dbname=nomdelabase;charset=utf8", "root", "");
    // 2eme étape : requête
    $query = "SELECT * FROM user";
    $statement = $pdo->query($query);
    // transforme la ressource en array
    $users = $statement->fetchAll(PDO::FETCH_ASSOC);

    foreach ($users as $user) {
        $user['name'];
    }

