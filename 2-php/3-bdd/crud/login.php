<?php
    session_start();

    if (isset($_POST['submit'])) {
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');

        if ($username == "admin" && $password == "123") {
            $_SESSION['logged'] = true;
            header('Location:readall.php?login=success');
            exit;
        }
        else {
            $message = "Mauvais identifiants";
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
    if (isset($message)) echo $message;
?>
    <form method="POST">
        <input type="text" name="username" />
        <input type="password" name="password" />
        <input type="submit" name="submit" />
    </form>
</body>
</html>
