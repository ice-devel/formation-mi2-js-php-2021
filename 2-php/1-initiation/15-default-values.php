<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Valeur par défaut dans un formulaire</title>
</head>
<body>
    <h1>Valeur par défaut - Formulaire</h1>

    <form>
        <input type="text" name="lastname" value="Valeur par défaut" />
        <br>
        <select>
            <option></option>
            <option value="1" selected>Option 1</option>
            <option value="2">Option 2</option>
        </select>
        <br>
        <input type="radio" name="civility" value="1" checked/><label>Mme</label>
        <input type="radio" name="civility" value="2"/>M.
        <br>
        <textarea placeholder="Descrivez-vous">Valeur par défaut</textarea>
        <br>
        <input type="checkbox" name="reglement" checked/>J'accepte le réglement
        <br>
        <p>
            Champ file : impossible de mettre une valeur par défaut, cela serait un gros problème
            de sécurité, car ça consisterait à être autorisé à aller chercher un fichier
            sur l'ordinateur client sans en être autorisé.
        </p>
        <input type="file" name="cv" /> Votre CV
    </form>
</body>
</html>



