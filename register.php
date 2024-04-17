<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body>
    <header>
        <?php
        // Rozpoczynamy sesję
        session_start();
        ?>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Strona główna</a></li>
                <li class="nav-item"><a class="nav-link" href="news.php">Aktualności</a></li>
                <li class="nav-item"><a class="nav-link" href="gallery.php">Galeria</a></li>
                <li class="nav-item"><a class="nav-link" href="#contact">Kontakt</a></li>
            </ul>
            <h1 class="text-center">Rejestracja</h1>
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
            $email = $_POST['email'];

            // Inicjalizacja tablicy błędów
            $errors = [];

            // Walidacja danych
            if (empty($username)) {
                $errors[] = 'Wprowadź nazwę użytkownika.';
            }

            if (empty($email)) {
                $errors[] = 'Wprowadź adres email.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Wprowadź poprawny adres email.';
            }

            if (empty($password)) {
                $errors[] = 'Wprowadź hasło.';
            }

            // Jeśli nie ma błędów, kontynuuj
            if (count($errors) === 0) {
                // Szyfrowanie hasła
                $password = password_hash($password, PASSWORD_DEFAULT);

                // Zapytanie SQL do dodania nowego użytkownika
                $sql = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$username, $password, $email]);

                // Przekierowanie do login.php
                header('Location: login.php');
                exit;
            } else {
                // Wyświetlenie błędów
                foreach ($errors as $error) {
                    echo "<p>$error</p>";
                }
            }
        }
        ?>

        <form method="post" action="register.php">
            <div class="form-group">
                <label for="username">Nazwa użytkownika:</label>
                <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="password">Hasło:</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Zarejestruj</button>
        </form>
    </main>

    <footer id="contact" class="footer fixed-bottom py-3 bg-light">
        <div class="container text-center">
            <p>Email: kontakt@edenhaven.com</p>
            <p>Tel: +48 234 567 890</p>
            <p>Adres: ul. Podchorążych 2, 30-084 Kraków</p>
        </div>
    </footer>

</body>

</html>