<?php
session_start();

// Sprawdzamy, czy użytkownik jest zalogowany
if (!isset($_SESSION['user_id'])) {
    // Użytkownik nie jest zalogowany. Przekierowujemy go na stronę logowania
    header('Location: login.php');
    exit();
}

// Użytkownik jest zalogowany. Pobieramy jego rezerwacje i je wyświetlamy
$user_id = $_SESSION['user_id'];

// Dołączamy plik z połączeniem do bazy danych
require 'connect.php';

// Przygotowujemy i wykonujemy zapytanie SQL
$stmt = $pdo->prepare("SELECT reservations.*, users.username FROM reservations JOIN users ON reservations.user_id = users.user_id WHERE reservations.user_id = ?");
$stmt->execute([$user_id]);

// Pobieramy wszystkie rezerwacje
$reservations = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moje rezerwacje</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
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
                // Jeśli użytkownik jest zalogowany, wyświetlamy jego nazwę użytkownika i linki do wylogowania i rezerwacji
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

    <div class="container mt-5">
        <h1 class="mb-4">Moje rezerwacje</h1>
        <?php foreach ($reservations as $reservation): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Rezerwacja użytkownika: <?= $reservation['username'] ?></h5>
                    <p class="card-text">Data początkowa: <?= $reservation['start_date'] ?></p>
                    <p class="card-text">Data końcowa: <?= $reservation['end_date'] ?></p>
                    <?php
                    if ($reservation['room'] == 1) {
                        echo 'Pokój Deluxe: "Royal Retreat"';
                    } elseif ($reservation['room'] == 2) {
                        echo 'Pokój Superior: "Elegance Suite"';
                    } elseif ($reservation['room'] == 3) {
                        echo 'Pokój Standard: "Cozy Haven""';
                    }
                    ?>
                    </p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>