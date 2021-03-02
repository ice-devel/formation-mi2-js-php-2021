<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP : intégrer du PHP dans une page web</title>
</head>
<body>
    <h1>PHP : intégrer du PHP dans une page web</h1>

    <h2>Liste des villes participantes</h2>

    <?php
        $cities = ['Paris', 'Valenciennes', 'Dunkerque', 'Lens', 'Arras'];
    ?>

    <ul>
        <?php
            foreach ($cities as $city) {
                echo "<li>$city</li>";
            }
        ?>
    </ul>

    <h2>Liste des utilisateurs</h2>

    <?php
        // requête en bdd pour récup les users
        $users = [
            ['name' => 'Toto', 'email' => 'toto@gmail.com', 'birthdate' => 1982],
            ['name' => 'Gérard', 'email' => 'gege@gmail.com', 'birthdate' => 1973],
            ['name' => 'Captain', 'email' => 'captain@gmail.com', 'birthdate' => 1914],
        ];

        function getAge($birthYear) {
            return date('Y') - $birthYear;
        }
    ?>

    <table>
        <?php
            foreach ($users as $user) {
                echo "
                <tr>
                    <td>".$user['name']."</td>
                    <td>".$user['email']."</td>
                    <td>".getAge($user['birthdate'])."</td>
                </tr>";
            }
        ?>
    </table>
</body>
</html>



