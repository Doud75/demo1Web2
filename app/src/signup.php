<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["mail"]) && isset($_POST["password"]) && isset($_POST["firstName"]) && isset($_POST["lastName"])) {
        require_once "../database/pdo.php";
        $mail = $_POST["mail"];
        $password = hash("sha512", $_POST["password"]);
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        
        $query = $pdo->prepare("SELECT `mail` FROM `users` WHERE `mail` = :mail;");
        $query->execute([
            ":mail" => $mail,
        ]);
        $user = $query->fetch();
        
        // checking if user already exists. if not, create one.
        if (!$user) {
            $query = $pdo->prepare("INSERT INTO `users` (`first_name`, `last_name`, `mail`, `password`) VALUES(:first_name, :last_name, :mail, :password)");
            $query->execute([
                ":first_name" => $firstName,
                ":last_name" => $lastName,
                ":mail" => $mail,
                ":password" => $password,
            ]);

            $query = $pdo->prepare("SELECT `id`, `mail`, `password`, `first_name`, `last_name`, `admin` FROM `users` WHERE `mail` = :mail;");
            $query->execute([
                ":mail" => $mail,
            ]);
            $user = $query->fetch();

            // first user is automatically admin
            if ($user["id"] === 1) {
                $updateUser = 'UPDATE `users` SET `admin` = :admin WHERE `id` = :id';
                $query = $pdo->prepare($updateUser);
                $query->execute([
                    ":admin" => true,
                    ":id" => $user["id"]
                ]);
                $user["admin"] = '1';
            }
            
            // set session[user] and go to index
            $_SESSION["user"] = $user;
            http_response_code(302);
            header("Location: /index.php");
            exit();
        } else {
            echo "L'utilisateur existe déjà";
        }
    }
}
require_once("../vue/signup.php");

