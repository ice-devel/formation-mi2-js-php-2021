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
    <form method="POST">
        <input type="text" name="username"/>
        <input type="password" name="password"/>
        <input type="submit" name="btn-login"/>
    </form>
</body>
</html>
<?php $content = ob_get_contents(); ob_clean(); ?>