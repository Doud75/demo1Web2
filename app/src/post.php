<?php
    session_start();
    // add new article and go back to index
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['title']) && isset($_POST['content'])) {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $author = $_SESSION['user']['first_name'] . ' ' . $_SESSION['user']['last_name'];
            $userId = $_SESSION['user']['id'];

            require_once('../database/pdo.php');
            $newArticle = 
                'INSERT INTO `articles` (`title`, `content`, `author`, `user_id`)
                VALUES(:title, :content, :author, :user_id)';

            $query = $pdo->prepare($newArticle);

            $query->execute([
                ':title' => $title,
                ':content' => $content,
                ':author' => $author,
                ':user_id' => $userId
            ]);
        
            http_response_code(302);
        }    
    }
    header("Location: /index.php");
    exit();