<!DOCTYPE html>
<html lang="pl">

<head>
    <title>Opinie</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php
    // Rozpoczynamy sesję
    session_start();

    require 'connect.php';

    // Sprawdzenie, czy formularz został przesłany
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Oczyszczanie i walidacja danych wejściowych
        $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);
        $user_id = $_SESSION['user_id'];

        // Pobranie aktualnej daty
        $date = new DateTime();
        $current_date = $date->format('Y-m-d H:i:s');

        // Wstawienie komentarza, ID użytkownika i aktualnej daty do bazy danych
        $stmt = $pdo->prepare('INSERT INTO comments (comment, user_id, date) VALUES (?, ?, ?)');
        $stmt->execute([$comment, $user_id, $current_date]);
    }
    ?>

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

    <main class="container mt-3">
        <?php
        // Sprawdzenie, czy użytkownik jest zalogowany
        if (isset($_SESSION['username'])) {
            echo '
    <div class="p-3">
        <h2>Zamieść opinię</h2>
        <form action="opinions.php" method="post" class="mt-5">
            <div class="form-group">
                <label for="comment">Twój komentarz:</label>
                <textarea id="comment" name="comment" class="form-control" rows="3" required></textarea>
            </div>
            <input type="hidden" name="user_id" value="' . $_SESSION['user_id'] . '">
            <input type="submit" value="Opublikuj" class="btn btn-primary">
        </form>
    </div>
    ';
        } else {
            echo '<p class="p-3">Proszę się <a href="login.php">zalogować</a> aby umieścić opinię</p>';
        }
        ?>

        <?php
        // Pobranie komentarzy z bazy danych i wyświetlenie ich
        $stmt = $pdo->query('SELECT comments.comment, users.username, comments.date, comments.comment_id FROM comments JOIN users ON comments.user_id = users.user_id ORDER BY comments.date DESC');
        while ($row = $stmt->fetch()) {
            echo '<div class="card mt-4">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">Autor: ' . htmlspecialchars($row['username']) . '</h5>';
            echo '<p class="card-text">' . htmlspecialchars($row['comment']) . '</p>';
            echo '<p class="card-text"><small class="text-muted">Dodano: ' . htmlspecialchars($row['date']) . '</small></p>';
            // Jeśli użytkownik jest zalogowany i jest autorem komentarza, wyświetlamy przycisk do edycji
            if (isset($_SESSION['username']) && $_SESSION['username'] == $row['username']) {
                echo '<a href="edit_comment.php?id=' . $row['comment_id'] . '" class="btn btn-primary">Edit</a>';
            }
            echo '</div>';
            echo '</div>';
        }
        ?>

    </main>

    <footer id="contact" class="footer py-3 mt-3 bg-light">
        <div class="container text-center">
            <p>Email: kontakt@edenhaven.com</p>
            <p>Tel: +48 234 567 890</p>
            <p>Adres: ul. Podchorążych 2, 30-084 Kraków</p>
        </div>
    </footer>

</body>

</html>