<?php

// Rozpoczynamy sesję
session_start();

// Dołączamy plik, który zawiera nasze połączenie do bazy danych
require 'connect.php';

// Sprawdzamy, czy formularz został wysłany
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pobieramy dane z formularza
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Przetwarzamy przesłany plik
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);

    // Wstawiamy nową wiadomość do bazy danych
    $sql = "INSERT INTO news (title, photo_url, content) VALUES (:title, :photo_url, :content)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['title' => $title, 'photo_url' => $target_file, 'content' => $content]);

    // Przekierowujemy użytkownika z powrotem na stronę z wiadomościami
    header("Location: news.php");
    exit;
}