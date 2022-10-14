<?php
    session_start();
    // if no user connected, redirect to login
    if(!isset($_SESSION['user'])) {
        header("Location: src/login.php");
        exit();
    }
    // get articles, and display them in vue/index.php
    $user = $_SESSION['user'];
    require_once('database/pdo.php');
    $selectArticles = 'SELECT * FROM `articles` ORDER BY `date` DESC';
    $query = $pdo->query($selectArticles);
    $articles = $query->fetchAll(PDO::FETCH_ASSOC);
    require_once("vue/index.php");

