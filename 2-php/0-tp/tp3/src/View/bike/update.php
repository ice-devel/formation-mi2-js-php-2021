<?php ob_start(); ?>
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
        table td {
            border: 1px solid;
        }
    </style>
</head>
<body>
    <h1>Modifier un vélo</h1>

    <form method="post">
        <input type="text" name="name" placeholder="nom" value="<?= $bike->getName() ?>"/><br>

        <input type="radio" name="frame" value="m" <?=  $bike->getFrame() == "m" ? "checked" : ""  ?>>Homme
        <input type="radio" name="frame" value="w" <?=  $bike->getFrame() == "w" ? "checked" : ""  ?>>Femme<br>

        <input type="text" name="size"  placeholder="Taille en pouce" value="<?= $bike->getSize() ?>"/><br>
        <input type="checkbox" name="has_suspension" <?=  $bike->getHasSuspension() ? "checked" : ""  ?>/> Suspension<br>
        <input type="text" name="price" placeholder="Prix" value="<?= $bike->getPrice() ?>"/><br>
        <select>
            <option></option>
            <?php foreach ($colors as $color): ?>
                <option value="<?= $color->getId() ?>"
                    <?= $bike->getColor()->getId() == $color->getId() ? "selected" : "" ?>
                >
                    <?= $color->getName() ?>
                </option>
            <?php endforeach ?>
        </select>
        <input type="submit" name="btn-form-bike"/>
    </form>
</body>
</html>
<?php $content = ob_get_contents(); ob_clean(); ?>