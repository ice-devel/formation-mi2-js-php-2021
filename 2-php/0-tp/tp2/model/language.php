<?php
    function getAllLanguages($pdo) {
        $result = $pdo->query("SELECT id, name FROM language");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }