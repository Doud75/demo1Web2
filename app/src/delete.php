<?php

    // delete article with id and get back to index
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $articleId = $_POST["articleId"];
        require_once('../database/pdo.php');
        if ($articleId) {
            $query = $pdo->prepare("DELETE FROM `articles` WHERE `id` = :id");
            $query->execute([
                ":id" => $articleId
            ]);
            http_response_code(302);
        }
    }
    header("Location: /index.php");
    exit();
