<?php ob_start(); ?>
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
<h1>Formulaire de candidature</h1>

<?php
if (isset($errors))
    var_dump($errors);
?>
<form method="post" enctype="multipart/form-data">
    <input type="text" name="name" /><br>
    <input type="email" name="email" /><br>
    <input type="text" name="available_at" /><br>
    <textarea name="description"></textarea><br>
    <select name="languages[]" multiple><br>
        <?php foreach ($languages as $language): ?>
            <option value="<?= $language['id'] ?>"><?= $language['name'] ?></option>
        <?php endforeach ?>
    </select><br>
    <input type="file" name="cv" /><br>

    <input type="submit" name="form_application" />
</form>
</body>
</html>

<?php $content = ob_get_contents(); ob_end_clean(); ?>