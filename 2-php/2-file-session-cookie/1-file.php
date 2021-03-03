<?php
    // ouvrir un fichier en mode écriture
    // on supprime le contenu pour le remplacer par autre chose
    $file = fopen("file/monfichier.txt", "w");
    fwrite($file, "hello".PHP_EOL);
    fclose($file);

    // ouvrir un fichier en mode écriture mais sans écraser ce qui s'y trouve
    // le curseur est placé à la fin du contenu
    $file = fopen("file/monfichier.txt", "a");
    fwrite($file, "coucou".PHP_EOL);
    fclose($file);

    // ouvrir un fichier en mode lecture
    $file = fopen("file/monfichier.txt", "r");
    $content = fgets($file);
    while ($content != false) {
        var_dump($content);
        $content = fgets($file);
    }
    fclose($file);

    // la même chose mais avec une seule fonction
    // mode écriture en écrasant le contenu
    file_put_contents('file/myfile2.txt', "mon texte".PHP_EOL);
    // mode écriture en gardant le contenu actuel
    file_put_contents('file/myfile2.txt', "mon texte 2", FILE_APPEND);

    // lire
    $content = file_get_contents('file/myfile2.txt');
    var_dump($content);

    // nom;prenom;age;ville
    // nom2;prenom2:age2;ville2



