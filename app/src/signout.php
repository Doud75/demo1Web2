<?php
    // empty session and go to login
    session_start();
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            unset($_SESSION["user"]);
            http_response_code(302);
        }
    header('Location: ./login.php');
    exit();