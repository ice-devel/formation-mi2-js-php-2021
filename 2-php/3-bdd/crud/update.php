<?php
    session_start();

    if (!isset($_SESSION['logged'])) {
        header('Location:login.php?access=denied');
        exit;
    }


    $id = filter_input(INPUT_GET, 'id');

    // est-ce que l'id a été passé dans l'url
    if ($id == null) {
        echo "Page non trouvée";
        http_response_code(404);
        exit;
    }

    // $id est un entier
    if (!preg_match("/^[1-9][0-9]*$/", $id)) {
        echo "Page non trouvée";
        http_response_code(404);
        exit;
    }

    // est-ce que le produit exite en bdd ?
    $pdo = new PDO("mysql:host=localhost;dbname=formation_202103;charset=utf8", "root", "");
    $sql = "SELECT * FROM product WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);

    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$product) {
        // on peut par exemple rediriger vers la page liste, avec un message
        // mais on peut aussi pourquoi pas à nouveau renvoyer une 404
        header('Location:readall.php?update-missing');
        exit;
    }

    $pdo = new PDO("mysql:host=localhost;dbname=formation_202103;charset=utf8", "root", "");
    $sql = "SELECT * FROM category";
    $stmt = $pdo->query($sql);
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $code = $product['code'];
    $name = $product['name'];
    $price = $product['price'];
    $description =$product['description'];
    $category = $product['category_id'];

    if (isset($_POST['btn_submit'])) {
        $code = filter_input(INPUT_POST, 'code');
        $name = filter_input(INPUT_POST, 'name');
        $price = filter_input(INPUT_POST, 'price');
        $description = filter_input(INPUT_POST, 'description');
        $category = filter_input(INPUT_POST, 'category');

        $errors = [];
        if (!preg_match("/^[A-Z]{3}[0-9]{3}$/", $code)) {
            $errors['code'] = "Coucou le code est mauvais";
        }
        if (mb_strlen($name) < 5) {
            $errors['name'] = "Coucou le nom est mauvais";
        }
        if (!preg_match("/^[1-9][0-9]{0,3}(\.[0-9]{1,2})?$/", $price)) {
            $errors['price'] = "Coucou le prix est mauvais";
        }
        if ($description == "") {
            $errors['description'] = "Coucou la description est mauvaise";
        }

        $categoriesIds = array_column($categories, "id");
        if (!in_array($category, $categoriesIds)) {
            $errors['name'] = "Coucou la category est mauvaise";
        }

        if (empty($errors)) {
            $sql = "UPDATE product SET code=:code, name=:name,price=:price, description=:description, category_id=:category
                    WHERE id=:id";
            $stmt = $pdo->prepare($sql);
            $result = $stmt->execute([
                ':code' => $code,
                ':name' => $name,
                ':price' => str_replace(",", ".", $price),
                ':description' => $description,
                ':category' => $category,
                ':id' => $id,
            ]);

            if ($result) {
                // message de succes ou redirection
                $message = "Succès";
                header('Location:readall.php?insert=success');
            }
            else {
                $message = "Une erreur est survenue";
            }
        }
        else {
            $message = "Des erreurs dans formulaire";
        }
    }

    require 'template/form_product.php'
?>