<?php
    session_start();

    if (!isset($_SESSION['logged'])) {
        header('Location:login.php?access=denied');
        exit;
    }

    $pdo = new PDO("mysql:host=localhost;dbname=formation_202103;charset=utf8", "root", "");
    $sql = "SELECT * FROM category";
    $stmt = $pdo->query($sql);
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $code = "";
    $name = "";
    $price = "";
    $description = "";
    $category =  "";

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
            $pdo = new PDO("mysql:host=localhost;dbname=formation_202103;charset=utf8", "root", "");
            $sql = "INSERT INTO product (code, name, price, description, category_id)
                    VALUES (:code, :name, :price, :description, :category)";
            $stmt = $pdo->prepare($sql);
            $result = $stmt->execute([
                ':code' => $code,
                ':name' => $name,
                ':price' => str_replace(",", ".", $price),
                ':description' => $description,
                ':category' => $category,
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
