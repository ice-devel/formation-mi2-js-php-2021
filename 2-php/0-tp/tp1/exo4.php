<?php
/*
 *

Exercice 4:

a) Créer un formulaire html, soumis en POST, avec ces champs:

- champ text : nom - obligatoire - trois caractères minimum

- champ text : date de naissance - obligatoire - format date français

- champ email : email - obligatoire - format email

- champ text : code postal - non obligatoire - format 5 chiffres

- champ text : telephone - non obligatoire - format 10 chiffres


b) forcer la validation html5 côté client avec les attributs adéquats (à vous de trouver comment faire
pour 3 caractères minimum et format 5 chiffres par exemple, indice : les attributs à utiliser sont “required” et “pattern”)


c) à la soumission du formulaire, vous devez :

- récupérer les différentes valeurs :  il faut avoir défini l’attribut html “name” pour chacun des champs.
On peut donc les récupérer côté serveur en PHP avec la variable globale POST.

- vérifier si les valeurs sont valides en faisant les mêmes vérifications qui ont été faites avec les attributs
HTML5 (obligatoire, pattern), mais côté serveur en PHP.

- s’il y a des erreurs, il faut demander à l’utilisateur de saisir à nouveau en reprenant les valeurs saisies
précédemment, sinon afficher le message “Merci [Nom], vous êtes bien inscrit”.


 */

// formulaire soumis ?
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // récupération des valeurs
    $name = filter_input(INPUT_POST, 'name');
    $birthday = filter_input(INPUT_POST, 'birthday');
    $email = filter_input(INPUT_POST, 'email');
    $zipcode = filter_input(INPUT_POST, 'zipcode');
    $phone = filter_input(INPUT_POST, 'phone');

    // vérification des formats
    $errors = [];
    if (mb_strlen($name) < 3) {
        $errors['name'] = "Ben tape ton nom avec 3 caractères";
    }

    if (!preg_match("#^[0-9]{2}/[0-9]{2}/[0-9]{4}$#", $birthday)) {
        $errors['birthday'] = "Erreur date de naissance";
    }

    if (!preg_match("#^[a-zA-Z0-9\-_]+@[a-zA-Z0-9\-_]+\.[a-z]{2,}$#", $email)) {
        $errors['email'] = "Erreur email";
    }

    if ($zipcode != "" && !preg_match("#^(2[AB0-9]|[0-9]{2})[0-9]{3}$#", $zipcode)) {
        $errors['zipcode'] = "Erreur zipcode";
    }

    if ($phone != "" && !preg_match("#^0(6|7)[0-9]{8}$#", $phone)) {
        $errors['phone'] = "Erreur phone";
    }

    if (empty($errors)) {
        $message = "Merci $name, vous êtes bien inscrit";
    }
    else {
        $message = "Erreur";
    }
}

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
<?php
 if (isset($message)) {
     echo "<p>$message</p>";
     if (!empty($errors)) {
         echo "<ul>";
         foreach($errors as $error) {
           echo "<li>$error</li>";
         }
         echo "</ul>";
     }
 }
?>
    <form method="POST" action="">
        <input name="name" required minlength="3" placeholder="Votre nom"/><br>
        <input type="text" name="birthday" required placeholder="Votre date de naissance"
               pattern="[0-9]{2}/[0-9]{2}/[0-9]{4}"
               /><br>
        <input type="email" name="email" required placeholder="Votre email" pattern="[a-zA-Z0-9\-_]+@[a-zA-Z0-9\-_]+\.[a-z]{2,}"/><br>
        <input type="text" name="zipcode" placeholder="Votre code postal" pattern="(2[AB0-9]|[0-9]{2})[0-9]{3}"/><br>
        <input type="tel" name="phone" placeholder="Votre téléphone portable" pattern="0(6|7)[0-9]{8}"/><br>

        <input type="submit" name="submit"/>
    </form>
</body>
</html>


