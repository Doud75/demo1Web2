<?php
$engine = "mysql";
$host = "database";
$port = 3306;
$dbname = "app";
$username = "root";
$password = "triumph";
$pdo = new PDO("$engine:host=$host:$port;dbname=$dbname", $username, $password);
