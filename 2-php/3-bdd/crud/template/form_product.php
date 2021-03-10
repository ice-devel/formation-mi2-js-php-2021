<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>tinymce.init({selector:'textarea'});</script>
</head>
</head>
<body>
<?php
if (isset($message)) {
    echo $message."<br>";
    var_dump($errors);
}
?>
<form method="POST">
    <input type="text" name="code" placeholder="Code produit" value="<?= $code ?>"/><br>
    <input type="text" name="name" placeholder="Nom" value="<?= $name ?>"/><br>
    <input type="number" name="price" placeholder="Prix" value="<?= $price ?>" step=".01"/><br>
    <textarea placeholder="Description" name="description"><?= $description ?></textarea><br>

    <select name="category">
        <?php foreach ($categories as $cat): ?>
            <option value="<?= $cat['id'] ?>" <?= $cat['id'] == $category ? "selected" : "" ?>><?= $cat['name'] ?></option>
        <?php endforeach ?>
    </select><br>
    <input type="submit" name="btn_submit" />
</form>

</body>
</html>
