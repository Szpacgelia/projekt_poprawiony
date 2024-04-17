<?php
// Połączenie z bazą danych
$host = 'localhost';
$db = 's168775';
$user = 's168775';
$pass = 'myRw8Xzsql';

$dsn = "mysql:host=$host;dbname=$db;";
$opt = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);
?>