<?php
    $pdo = new PDO("mysql:host=localhost;dbname=formation_202103;charset=utf8", "root", "");
    $sql = "SELECT SUM(score) AS points, team_id, T.name
            FROM player P INNER JOIN team T ON P.team_id = T.id
            GROUP BY team_id HAVING points >= 50
            ORDER BY points DESC LIMIT 3";
    $stmt = $pdo->query($sql);
    $teamsScores = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $players = [];
    foreach ($teamsScores as $teamScore) {
        $sql = "SELECT * FROM player WHERE team_id = {$teamScore['team_id']} ORDER BY score DESC";
        $players[] = [];// mettre les joueurs des équipes dans un tableau général
    }

    $sql = "SELECT * FROM player
            WHERE team_id = (SELECT team_id
                            FROM player P INNER JOIN team T ON P.team_id = T.id
                            GROUP BY team_id ORDER BY SUM(score) DESC LIMIT 1)
            ORDER BY score DESC LIMIT 5";
    $stmt = $pdo->query($sql);
    $team1Players = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql = "SELECT * FROM player
                WHERE team_id = (SELECT team_id
                                FROM player P INNER JOIN team T ON P.team_id = T.id
                                GROUP BY team_id ORDER BY SUM(score) DESC LIMIT 2,1)
                AND is_enabled = 1    
                ORDER BY score DESC LIMIT 5";
    $stmt = $pdo->query($sql);
    $team2Players = $stmt->fetchAll(PDO::FETCH_ASSOC);
  ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
    <style>
        .container > div {
            border:1px solid;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-4 offset-4">
                <h2>Top 3 équipes</h2>
                <ul>
                    <?php
                     foreach ($teamsScores as $teamScore) {
                        echo "<li>{$teamScore['name']} : {$teamScore['points']}</li>";
                     }
                    ?>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-4">
                équipe 1<br>
                <?php
                foreach ($team1Players as $player) {
                    echo "<li>{$player['name']} : {$player['score']}</li>";
                }
                ?>
            </div>
            <div class="col-4">
                équipe 2
                <?php
                foreach ($team2Players as $player) {
                    echo "<li>{$player['name']} : {$player['score']}</li>";
                }
                ?>
            </div>
            <div class="col-4">
                équipe 3
            </div>
        </div>
    </div>
</body>
</html>

