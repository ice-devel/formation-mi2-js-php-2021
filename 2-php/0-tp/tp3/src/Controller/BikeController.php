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

        if (isset($_GET['btn-form-filter'])) {
            $name = filter_input(INPUT_GET, 'name');
            $size = filter_input(INPUT_GET, 'size');
            $bikes = $bikeManager->findByFilters($name, $size);
        }
        else {
            $bikes = $bikeManager->findAll();
        }

        require __DIR__.'/../View/bike/index.php';
        return $content;
    }

    public function delete($params) {
        extract($params);
        if (!isset($id)) {
            throw new \Exception();
        }

        $pdo = Connection::getPdo();
        $bikeManager = new BikeManager($pdo);

        // le velo à supprimer
        $bike = $bikeManager->find($id);

        if ($bike != null) {
            $bikeManager->delete($bike);
        }

        header("Location: /admin");
        exit;
    }

    public function update($params) {
        extract($params);
        if (!isset($id)) {
            throw new \Exception();
        }

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
                    header('Location: /admin');
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