<?php
    /*
     * Model : logique métier
     */

function getAllProducts($pdo) {
    $query = "SELECT P.id, P.code, P.name as product_name, P.price, C.name as category_name
          FROM product P
          INNER JOIN category C ON P.category_id = C.id";
    $statement = $pdo->query($query);
    $products = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $products;
}

function getProduct($id, $pdo) {
    $sql = "SELECT * FROM product WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    return $product;
}
