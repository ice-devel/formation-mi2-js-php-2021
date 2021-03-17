<?php
    set_error_handler(function($errno, $errstr) {
        echo "Page jolie d'erreur";
        exit;
    });


    $result = 8 / 0;

    echo "coucou";