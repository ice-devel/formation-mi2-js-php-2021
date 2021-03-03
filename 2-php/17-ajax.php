<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exo formulaire POST en ajax</title>
</head>
<body>
    <h1>Formulaire ajax</h1>
<?php
    $countries = ["France", "Norvège", "Japon", "Maroc", "Pays-Bas"];
?>
    <form action="" method="post">
        <input type="text" placeholder="Pseudo" name="pseudo" />
        <input type="text" placeholder="Code postal" name="zipcode"/>
        <select name="country">
            <option></option>
            <?php
                foreach ($countries as $c) {
                    echo "<option>$c</option>";
                }
            ?>
        </select>
        <input type="submit" name="btn-register" value="test" />
    </form>

    <script>
        let form = document.querySelector("form");
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            let url = "18-reception-ajax.php";
            let data = new FormData(form);

            fetch(url, {'method': 'POST', 'body': data})
                .then(function(response) {
                    return response.json();
                })
                .then(function(json) {
                    console.log(json);
                    if (json.code === 0) {
                        alert('success');
                        // redirection...
                    }
                    else {
                        for (const error of json.errors) {
                            alert(error);
                        }
                    }
                })
        });
    </script>

</body>
</html>



