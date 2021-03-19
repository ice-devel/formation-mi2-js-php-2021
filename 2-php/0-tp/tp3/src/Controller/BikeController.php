<?php

namespace App\Controller;

use App\Database\Connection;
use App\Model\BikeManager;
use App\Model\ColorManager;
use App\Model\GameManager;

class BikeController
{
    public function list() {
        $pdo = Connection::getPdo();
        $bikeManager = new BikeManager($pdo);

        $bikes = $bikeManager->findAll();
        require __DIR__.'/../View/bike/index.php';
        return $content;
    }

    public function delete($id) {
        $pdo = Connection::getPdo();
        $bikeManager = new BikeManager($pdo);

        // le velo à supprimer
        $bike = $bikeManager->find($id);

        if ($bike != null) {
            $bikeManager->delete($bike);
        }

        header("Location: /");
        exit;
    }

    public function update($id) {
        $pdo = Connection::getPdo();
        $bikeManager = new BikeManager($pdo);

        // le velo à modifier
        $bike = $bikeManager->find($id);

        if ($bike == null) {
            throw new \Exception("Ce vélo n'existe pas");
        }

        if (isset($_POST['btn-form-bike'])) {
            $bikeManager->handleRequest($bike);

            $errors = $bikeManager->validate($bike);

            if (empty($errors)) {
                if ($bikeManager->update($bike)) {
                    header('Location: /');
                    exit;
                }
            }
        }

        $colorManager = new ColorManager($pdo);
        $colors = $colorManager->findAll();


        require __DIR__.'/../View/bike/update.php';
        return $content;
    }
}