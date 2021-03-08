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

    /*
     * CRUD : requête de données en SQL
     */

    /*
     * Sélectionner des données : SELECT
     *
     * SELECT *
     * (SELECT id, name, email)
     * FROM table_name
     * WHERE conditions
     * GROUP BY (HAVING)
     * LIMIT 2
     *
     */

    /*
     * Fonctions scalaires / agrégation
     *
     * Scalaires : traitement sur une colonne
     * UPPER LOWER LENGTH CEIL FLOOR ROUND(d, n) YEAR MONTH DAY HOUR MINUTE SECOND
     * SELECT UPPER(name) FROM player;
     *
     * Agrégation : pour obtenir un seul enregistrement à partir de plusieurs
     * COUNT, SUM, AVG, MIN, MAX
     *
     * SELECT MAX(points) FROM player
     */

    /*
     * UPDATE table_name
     * SET points = 50, zipcode = 59000
     * WHERE name LIKE 't%'
     */

    /*
     * INSERT INTO table VALUES (value1, value2, value3)
     * INSERT INTO table (column1, column2) VALUES (value1, value2)
     */

    /*
     * DELETE FROM table_name
     * WHERE conditions
     */

    /*
     * Opération logiques et comparaison
     * AND / OR
     *
     * =, >, <, !=
     * BETWEEN value1 AND value 2
     * LIKE 'chaine%_'
     * IN / NOT IN (value1, value2, etc.)
     *
     */

