<?php

// Rozpoczynamy sesję
session_start();

// Dołączamy plik, który zawiera nasze połączenie do bazy danych
require 'connect.php';

// Zakładamy, że mamy id użytkownika zapisane w zmiennej sesyjnej
$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if ($userId) {
    // Pobieramy użytkownika z bazy danych
    $sql = "SELECT admin FROM users WHERE user_id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $userId]);

    // Pobieramy dane użytkownika
    $user = $stmt->fetch();

    // Sprawdzamy, czy użytkownik jest administratorem
    $is_admin = $user ? $user['admin'] == 1 : false;
} else {
    $is_admin = false;
}

// Pobieramy wiadomości z bazy danych
$sql = "SELECT * FROM news";
$stmt = $pdo->prepare($sql);
$stmt->execute();

// Pobieramy wszystkie wiersze jako tablicę asocjacyjną
$news = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <title>Aktualności</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Strona główna</a></li>
                <li class="nav-item"><a class="nav-link" href="news.php">Aktualności</a></li>
                <li class="nav-item"><a class="nav-link" href="gallery.php">Galeria</a></li>
                <li class="nav-item"><a class="nav-link" href="#contact">Kontakt</a></li>
            </ul>
            <h1 class="text-center">Hotel Eden Haven</h1>
            <div class="navbar-nav ml-auto">
                <?php
                // Jeśli użytkownik jest zalogowany, wyświetlamy jego nazwę użytkownika i link do wylogowania
                // W przeciwnym razie wyświetlamy linki do rejestracji i logowania
                if (isset($_SESSION['username'])) {
                    echo '<span class="navbar-text">Witaj, ' . $_SESSION['username'] . '</span>';
                    echo '<a class="nav-item nav-link" href="my_reservations.php">Moje rezerwacje</a>';
                    echo '<a class="nav-item nav-link" href="logout.php">Wyloguj</a>';
                } else {
                    echo '<a class="nav-item nav-link" href="register.php">Rejestracja</a>';
                    echo '<a class="nav-item nav-link" href="login.php">Logowanie</a>';
                }
                ?>
            </div>
        </nav>
    </header>

    <main class="container mt-4">
        <section class="row">
            <?php
            $i = 0;
            foreach ($news as $row) {
                // Skracamy treść wiadomości do 100 znaków
                $truncated_content = (strlen($row["content"]) > 100) ? substr($row["content"], 0, 100) . '...' : $row["content"];

                // Karta dla każdej wiadomości
                echo "<div class='col-md-4 mb-4'>";
                echo "<div class='card' data-toggle='modal' data-target='#newsModal" . $i . "'>";
                echo "<img src='" . $row["photo_url"] . "' class='card-img-top' alt='News Photo'>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>" . $row["title"] . "</h5>";
                echo "<p class='card-text'>" . $truncated_content . "</p>";
                echo "</div>";
                echo "</div>";
                echo "</div>";



                // Modal dla każdego posta
                echo "<div class='modal fade' id='newsModal" . $i . "' tabindex='-1' role='dialog' aria-labelledby='newsModalLabel" . $i . "' aria-hidden='true'>";  // Tworzymy nowy modal dla każdej wiadomości
                echo "<div class='modal-dialog modal-xl' role='document'>";  // Używamy modal-xl dla bardzo dużego modala
                echo "<div class='modal-content'>";  // Tutaj zaczyna się treść modala
                echo "<div class='modal-header'>";  // Tworzymy nagłówek modala
                echo "<h5 class='modal-title' id='newsModalLabel" . $i . "'>" . $row["title"] . "</h5>";  // Wyświetlamy tytuł wiadomości jako tytuł modala
                echo "<button type='button' class='close' data-dismiss='modal' aria-label='Zamknij'>";  // Dodajemy przycisk do zamykania modala
                echo "<span aria-hidden='true'>&times;</span>";  // Dodajemy ikonę 'x' do przycisku zamykania
                echo "</button>";
                echo "</div>";
                echo "<div class='modal-body'>";  // Tutaj zaczyna się ciało modala
                echo "<div class='img-container'>";  // Tworzymy nowy div dla obrazu
                echo "<img src='" . $row["photo_url"] . "' class='img-fluid img-responsive w-100 mx-auto d-block' alt='News Photo'>";  // Wyświetlamy obraz wiadomości, czynimy go responsywnym i na pełną szerokość
                echo "</div>";
                echo "<div class='content-container'>";  // Tworzymy nowy div dla treści
                echo "<p>" . $row["content"] . "</p>";  // Wyświetlamy pełną treść wiadomości w modalu
                echo "</div>";
                echo "</div>";
                echo "<div class='modal-footer'>";  // Tutaj zaczyna się stopka modala
                echo "<button type='button' class='btn btn-primary' data-dismiss='modal'>Zamknij</button>";  // Dodajemy przycisk do zamykania modala
            
                // Jeśli użytkownik jest administratorem, dodajemy przycisk do edycji wiadomości
                if ($is_admin) {
                    echo "<a href='edit_news.php?id=" . $row["id"] . "' class='btn btn-warning'>Edytuj</a>";  // Dodajemy przycisk do edycji wiadomości
                }

                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";  // Tutaj kończy się nasz modal
            
                $i++;

            }
            ?>
        </section>


        <?php
        // Dodajemy formularz do dodawania postów, jeśli użytkownik jest administratorem
        if ($is_admin) {
            echo "<h2 class='mt-4'>Utwórz post</h2>";
            echo "<form action='add_news.php' method='POST' enctype='multipart/form-data'>";
            echo "<div class='form-group'>";
            echo "<label for='title'>Tytuł</label>";
            echo "<input type='text' class='form-control' id='title' name='title' placeholder='Tytuł' required>";
            echo "</div>";
            echo "<div class='form-group'>";
            echo "<label for='photo'>Wybierz zdjęcie</label>";
            echo "<input type='file' class='form-control-file' id='photo' name='photo' required>";
            echo "</div>";
            echo "<div class='form-group'>";
            echo "<label for='content'>Treść</label>";
            echo "<textarea class='form-control' id='content' name='content' placeholder='Treść' required></textarea>";
            echo "</div>";
            echo "<button type='submit' class='btn btn-primary'>Dodaj post</button>";
            echo "</form>";

        }
        ?>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</body>
<footer id="contact" class="footer mt-auto py-3 bg-light">
    <div class="container text-center">
        <p>Email: kontakt@edenhaven.com</p>
        <p>Tel: +48 234 567 890</p>
        <p>Adres: ul. Podchorążych 2, 30-084 Kraków</p>
    </div>
</footer>

</html>