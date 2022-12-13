<?php
$servername = 'localhost';
$username = 'gnome';
$password = 'slayer';
$dbname = 'students';

$charset = "utf8mb4";
$dsn = "mysql:host=" . $servername . ";dbname=" . $dbname;
$conn = new PDO($dsn, $username, $password);
