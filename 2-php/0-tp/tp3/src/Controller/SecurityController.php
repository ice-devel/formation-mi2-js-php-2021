<?php

namespace App\Controller;

class SecurityController
{
    public function login() {
        if (isset($_POST['btn-login'])) {
            $username = filter_input(INPUT_POST, 'username');
            $password = filter_input(INPUT_POST, 'password');
            if ($username == "admin" && $password == "123") {
                $_SESSION['connected'] = 1;
                header('Location: /admin');
            }
        }
        require __DIR__.'/../View/security/login.php';
        return $content;
    }
}