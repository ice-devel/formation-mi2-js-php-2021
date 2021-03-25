<?php
/*
 * Les exceptions arrête le script
 * sauf si elles sont attrapées soit par un bloc try catch
 * soit par un gestionnaire global
 * On peut utiliser les deux, ou l'un ou l'autre, ou rien :)
 */
    $exception = new Exception();
    //throw $exception;

    // gestionnaire global d'exception : attraper toutes les exceptions
    // qui ne sont pas attrapées par un catch
    set_exception_handler(function(Exception $exception) {
        echo "Gestionnaire global dit :";
        echo $exception->getMessage();
    });

    // try catch : attraper les potentielles exceptions
    try {
        $pdo = new PDO("mysql:jfheje");
    }
    catch(Exception $e) {
        echo $e->getMessage();
        echo "Message joli pour dire que la bdd elle est pas accessible";
    }

    $pdo = new PDO("mysql:jfheje");

