<!DOCTYPE html>
<html lang="pl">

<head>
    <title>Logowanie</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    // Rozpoczynamy sesję
    session_start();
    ?>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Strona główna</a></li>
                <li class="nav-item"><a class="nav-link" href="news.php">Aktualności</a></li>
                <li class="nav-item"><a class="nav-link" href="gallery.php">Galeria</a></li>
                <li class="nav-item"><a class="nav-link" href="#contact">Kontakt</a></li>
            </ul>
            <h1 class="text-center">Logowanie</h1>
            <div class="navbar-nav ml-auto">
                <a class="nav-item nav-link" href="register.php">Rejestracja</a>
                <a class="nav-item nav-link" href="login.php">Logowanie</a>
            </div>
        </nav>
    </header>

    <main class="container mt-3">
        <?php
        require 'connect.php';

        // Sprawdzenie, czy metoda żądania to POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Pobranie danych z formularza
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Inicjalizacja tablicy błędów
            $errors = [];

            // Walidacja danych
            if (empty($username)) {
                $errors[] = 'Wprowadź nazwę użytkownika.';
            }

            if (empty($password)) {
                $errors[] = 'Wprowadź hasło.';
            }

            // Jeśli nie ma błędów, kontynuuj
            if (count($errors) === 0) {
                // Zapytanie SQL do pobrania użytkownika
                $sql = "SELECT * FROM users WHERE username = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$username]);
                $user = $stmt->fetch();

                // Sprawdzenie, czy użytkownik istnieje i czy hasło jest poprawne
                if ($user && password_verify($password, $user['password'])) {
                    // Rozpoczęcie sesji
                    session_start();
                    // Ustawienie zmiennych sesji
                    $_SESSION['logged_in'] = true;
                    $_SESSION['username'] = $username;
                    $_SESSION['user_id'] = $user['user_id'];
                    // Przekierowanie do index.php
                    header('Location: index.php');
                    exit;
                } else {
                    // Wyświetlenie błędu
                    echo "<p>Nieprawidłowa nazwa użytkownika lub hasło.</p>";
                }
            } else {
                // Wyświetlenie błędów
                foreach ($errors as $error) {
                    echo "<p>$error</p>";
                }
            }
        }
        ?>

        <section>
            <form method="post" action="login.php">
                <div class="form-group">
                    <label for="username">Nazwa użytkownika:</label>
                    <input type="text" class="form-control" id="username" name="username">
                </div>
                <div class="form-group">
                    <label for="password">Hasło:</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <button type="submit" class="btn btn-primary">Zaloguj</button>
            </form>
        </section>
    </main>

    <footer id="contact" class="footer mt-5 py-3 bg-light fixed-bottom">
        <div class="container text-center">
            <p>Email: kontakt@edenhaven.com</p>
            <p>Tel: +48 234 567 890</p>
            <p>Adres: ul. Podchorążych 2, 30-084 Kraków</p>
        </div>
    </footer>

</body>

</html>