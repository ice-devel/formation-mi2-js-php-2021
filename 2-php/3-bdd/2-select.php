<?php
// 1ére étape : connexion à la bdd
$pdo = new PDO("mysql:host=localhost;dbname=formation_202103;charset=utf8", "root", "");

// 2eme étape : requête
$query = "SELECT name, score, zipcode, team_id FROM player";
$statement = $pdo->query($query);

// transforme la ressource en array
$players = $statement->fetchAll(PDO::FETCH_ASSOC);

/*
 * Requête protégée
 */
$name = "valeur provenant d'un client";
$query = "SELECT * FROM player WHERE name = :name";
// on prépare la requête pour éviter les injections SQL
$statement = $pdo->prepare($query);
$statement->bindParam(":name", $name);
// $result : true or false - la requête a merdé ou a fonctionné
$result = $statement->execute();
// le jeu de résultat
$dynamicPlayers = $statement->fetchAll(PDO::FETCH_ASSOC);


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table {
            border-collapse: collapse;
        }
        table td, table th {
            border: 1px solid;
        }
    </style>
</head>
<body>
    <h1>Liste des joueurs</h1>

    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Points</th>
                <th>Team</th>
                <th>Code postal</th>
            </tr>
        </thead>

        <tbody>
            <?php
            foreach ($players as $player) {
                echo  "<tr>
                        <td>".$player['name']."</td>
                        <td>{$player['score']}</td>
                        <td>{$player['team_id']}</td>
                        <td>{$player['zipcode']}</td>
                    </tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>