<?php
namespace App\Controller;

class TestController
{
    public function pageTest() {
        require '../src/View/test.php';
        return $content;
    }
}