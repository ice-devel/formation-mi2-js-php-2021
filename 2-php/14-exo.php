<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exo formulaire POST</title>
</head>
<body>
<?php
    /*
     * Créer un formulaire en POST
     * - un champ pour un pseudo : obligatoire - min 5 caractères
     * - un code postal : obligatoire - format code postal : 5 chiffres
     * ou un A/B en deuxième position seulement si le premier caractère est 2
     * - un pays dans une liste déroulante (select) - obligatoire -
     * la valeur doit forcément être une valeur de la liste
     *
     * - Récupération données
     * - Vérification
     * - Le formulaire est bon :
     *  - afficher un message perso "Bienvenue #pseudo#"
     * - Le formulaire est pas bon :
     *  - vous affichez toutes les erreurs du form
     *  - remettre les valeurs saisies précédemment dans le formulaire
     */

    $countries = ["France", "Norvège", "Japon", "Maroc", "Pays-Bas"];

    // formulaire soumis ?
    $pseudo = "";
    $zipcode = "";
    $country = "";
    if (isset($_POST['btn-register'])) {
        // récupération des valeurs
        $pseudo = filter_input(INPUT_POST, 'pseudo');
        $zipcode = filter_input(INPUT_POST, 'zipcode');
        $country = filter_input(INPUT_POST, 'country');

        // vérification
        $errors = [];
        if (mb_strlen($pseudo) < 5) {
            $errors['pseudo'] = "Le pseudo est incorrect.";
        }

        if (!preg_match("/^(2[0-9AB]|[0-9]{2})[0-9]{3}$/", $zipcode)) {
            $errors['zipcode'] = "Le code postal est incorrect.";
        }

        if (!in_array($country, $countries)) {
            $errors['country'] = "Le pays est incorrect.";
        }

        // envoi en bdd..
        if (empty($errors)) {
            $success = true;
            // redirection, mail, etc.
        }
        else {
            $message = "Erreurs";
        }
    }
?>

    <?php
        if (isset($message)) {
            echo "<p>ERREURS</p>";

            foreach ($errors as $error) {
                echo "<p>$error</p>";
            }
        }
        elseif (isset($success)) {
            echo "<p>Bienvenue $pseudo</p>";
        }
    ?>
    <form action="" method="post">
        <input type="text" placeholder="Pseudo" name="pseudo" value="<?php echo $pseudo; ?>"/>
        <input type="text" placeholder="Code postal" name="zipcode" value="<?php echo $zipcode; ?>"/>
        <select name="country">
            <option></option>
            <?php
                foreach ($countries as $c) {
                    $selected = $c == $country ? "selected" : "";
                    echo "<option $selected>$c</option>";
                }
            ?>
        </select>
        <input type="submit" name="btn-register" />
    </form>

</body>
</html>



