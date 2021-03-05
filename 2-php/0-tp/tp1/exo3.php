<?php
/*
 *
Exercice 3 :

créer une page web avec trois liens, et un div
chaque lien doit pointer vers cette même page, mais en passant le paramètre GET "numero"
(vous pouvez passer des paramètres GET grâce à un lien : il suffit de mettre dans l’attribut href
quelque-chose comme monlien.fr?param=test).

Pour le premier lien, la valeur du paramètre “numero” doit être "page1",
pour le deuxième lien : "page2", pour le troisième “page3”

lors du clic sur un des liens, le paramètre GET  doit être récupérée en PHP lors du rechargement
de la page, et sa valeur affichée dans le div
voici un array contenant des articles : vous pouvez le copier dans votre code :
il faut ensuite afficher les articles dans la page.
Mais il ne faut afficher que 2 articles par page :
les deux premiers si le parametre GET vaut “page1”,
les deux suivants s’il vaut “page2”, et les deux derniers s’il vaut “page3”

si le paramètre GET “numero” n’existe pas, il faut considérer qu’on est sur la page 1

 */

$articles = [
    ['nom' => 'Titre 1', 'description' => 'Description de article 1'],
    ['nom' => 'Titre 2', 'description' => 'Description de article 2'],
    ['nom' => 'Titre 3', 'description' => 'Description de article 3'],
    ['nom' => 'Titre 4', 'description' => 'Description de article 4'],
    ['nom' => 'Titre 5', 'description' => 'Description de article 5'],
    ['nom' => 'Titre 6', 'description' => 'Description de article 6'],
];

// récupérer la page actuelle, page1 par défaut
$numero = filter_input(INPUT_GET, 'numero');

if ($numero == null) {
    $numero = "page1";
}


// quels articles sur cette page ?
/*
if ($numero == "page1") {
    $start = 0;
}
else if ($numero == "page2") {
    $start = 2;
}
else {
    $start = 4;
}
*/

// récupération dynamique de l'indice de départ
$numeroPage = str_replace('page', '', $numero);
$nbArticlePerPage = 2;
$start = ($numeroPage - 1) * $nbArticlePerPage;

// verifier si la page existe ? si non : rediriger vers page 1 ou 404

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
    <a href="?numero=page1">Page1</a>
    <a href="?numero=page2">Page2</a>
    <a href="?numero=page3">Page3</a>

    <div><?= $numero ?></div>

    <?php
        /*
        foreach ($articles as $article) {
            echo "<h2>".$article['nom']."</h2>
                  <p>
                    {$article['description']}
                  </p>
            ";
        }
        */
    /*
    echo "<h2>".$article1['nom']."</h2>
          <p>
            {$article1['description']}
          </p>
          
          <h2>".$article2['nom']."</h2>
          <p>
            {$article2['description']}
          </p>
            ";
    */
    for ($i=$start; $i < $start + 2; $i++) {
        echo "<h2>".$articles[$i]['nom']."</h2>
              <p>
                {$articles[$i]['description']}
              </p>
            ";
    }
    ?>
</body>
</html>

