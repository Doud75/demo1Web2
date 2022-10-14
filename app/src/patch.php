<?php

    // update article by id, and go back to index
    if($_SERVER["REQUEST_METHOD"] === "POST") {
        if(isset($_POST["modifyTitle"]) && isset($_POST["modifyContent"]) && isset($_POST["articleId"])) {
            $title = $_POST["modifyTitle"];
            $content = $_POST["modifyContent"];
            $articleId = $_POST["articleId"];

            require_once('../database/pdo.php');
            $updateArticle = 
                'UPDATE `articles`
                SET `title` = :title, `content`= :content, `date` = CURRENT_TIMESTAMP
                WHERE `id` = :article_id';
            $query = $pdo->prepare($updateArticle);
            $query->execute([
                ":title" => $title,
                ":content" => $content,
                ":article_id" => $articleId
            ]);
            http_response_code(302);
        }
    }
    header("Location: /index.php");
    exit();

