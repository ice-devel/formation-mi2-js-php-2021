<?php
    /*
     * Exercice :
     * - Créer un formulaire HTML avec 2 champs :
     *  - un champ pour le nom du joueur
     *  - un champ pour l'équipe du joueur
     *
     * Cette page doit afficher les joueurs quand on valide le formulaire,
     * en allant chercher en bdd les joueurs correspondant aux filtres
     *
     * Exemple :
     * - le champ "nom" est rempli avec "toto", il faut afficher les joueurs
     * qui s'appellent toto
     * - le champ "équipe" est rempli, il faut afficher les joueurs
     * qui sont dans cette équipe
     * - le champ "nom" est rempli avec "toto" et le champ "équipe est rempli avec 2
     *il faut afficher les joueurs qui s'appellent "toto" et qui sont dans l'équipe 2
     * - aucun des champs n'est rempli : on affiche tous les joueurs
     *
     */
    $pdo = new PDO("mysql:host=localhost;dbname=formation_202103;charset=utf8", "root", "");

    $name = "";
    $team = "";
    $where = "";
    $params = [];

    // formulaire soumis ?
    if (isset($_GET['submit'])) {
        $name = filter_input(INPUT_GET, 'name');
        $team = filter_input(INPUT_GET, 'team');

        if ($name != "" && $team != "") {
            $where = "WHERE name = :name AND team_id = :team";
            $params = [':name' => $name, ':team' => $team];
            //$stmt->bindParam(':name', $name);
            //$stmt->bindParam(':team', $team);
        }
        elseif ($name != "") {
            $where = "WHERE name = :name";
            $params = [':name' => $name];
            //$stmt->bindParam(':name', $name);
        }
        elseif ($team != "") {
            $where = "WHERE team_id = :team";
            $params = [':team' => $team];
            //$stmt->bindParam(':team', $team);
        }
    }

    $sql = "SELECT * FROM player $where";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $players = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <form>
        <input type="text" name="name" placeholder="nom" value="<?= $name ?>"/>
        <input type="number" name="team" placeholder="équipe" value="<?= $team ?>"/>
        <input type="submit" name="submit" />
    </form>

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
