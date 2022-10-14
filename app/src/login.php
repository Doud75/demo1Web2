<?php 

    session_start();

    // get user by mail, check if mail and password are egual with database
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST["mail"]) && isset($_POST["password"])) {
            require_once "../database/pdo.php";
            $mail = $_POST["mail"];
            $password = hash("sha512", $_POST["password"]);
            
            $query = $pdo->prepare(
                "SELECT `id`, `mail`, `password`, `first_name`, `last_name`, `admin`
                FROM `users`
                WHERE `mail` = :mail"
            );
            $query->execute([
                ":mail" => $mail,
            ]);
            $user = $query->fetch();
            
            if (!$user || $user["password"] !== $password) {
                echo "utilisateur invalide";
            } else {
                // set session[user] and go to index
                $_SESSION["user"] = $user;
                http_response_code(302);
                header("Location: /index.php");
                exit();
            }
        }
    }
    require_once("../vue/login.php");

