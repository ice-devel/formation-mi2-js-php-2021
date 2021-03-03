<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Upload d'un fichier</title>
</head>
<body>
    <h1>Upload</h1>

    <?php
        // on récupère les uploads dans le tableau global $_FILES
        if (isset($_FILES['picture'])) {
            $picture = $_FILES['picture'];

            // un champ type file = 5 informations récupérées par PHP
            // https://www.php.net/manual/fr/features.file-upload.post-method.php
            $filename = $picture['name'];
            $type = $picture['type'];
            $tmpName = $picture['tmp_name'];
            $error = $picture['error'];
            $size = $picture['size'];

            $errors = [];
            // vérification
            // TYPE MIME
            if ($type != "application/pdf" && $type != "application/vnd.openxmlformats-officedocument.wordprocessingml.document") {
                $errors['type'] = "Ce type de fichier n'est pas autorisé.";
            }

            // Taile
            if ($size > 1000000) {
                $errors['size'] = "Le fichier est limité à 1mo.";
            }

            // https://www.php.net/manual/fr/features.file-upload.errors.php
            if ($error != 0) {
                $errors['error'] = "Une erreur est survenue.";
            }

            if (empty($errors)) {
                $fname = uniqid("_monsite", true).$filename;
                // déplacer le fichier qui se trouve dans le dossier tmp du serveur web
                // vers le dossier souhaité de notre site
                move_uploaded_file($tmpName, "uploads/".$fname);
            }
            else {
                foreach ($errors as $error) {
                    echo "<p>$error</p>";
                }
            }
        }
    ?>

    <p>
        Configuration PHP dans le fichier php.ini, s'applique au niveau global, au dessus des vérifications du code :
        - upload_max_filesize : taille maximum autorisée pour chaque fichier uploadé
        - post_max_size : taille totale de la requête POST
    </p>

    <form enctype="multipart/form-data" method="post">
        <!-- on peut utiliser un champ caché pour limiter la taille du fichier,
        mais ça sert à grand chose car le formulaire ne sera pas bloqué, on aura juste une
        erreur côté serveur : donc rechargement de page quoi qu'il arrive -->
        <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
        <input type="file" name="picture" required accept=".pdf,.docx"/>
        <button>Envoyer ma photo de déglingo !</button>
    </form>
</body>
</html>



