<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rezerwacja</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

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
            <header>
                <h1 class="text-center">Hotel Eden Haven</h1>
            </header>
            <div class="navbar-nav ml-auto">
                <?php
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

    <main>
        <div class="container">
            <section>
                <h2>Rezerwacja</h2>
                <p>Wybierz datę pobytu oraz pokój, który chcesz zarezerwować.</p>

                <form action="reservation.php" method="post" class="mt-5">
                    <div class="form-group">
                        <label for="start_date">Wybierz datę początkową pobytu:</label>
                        <input type="date" id="start_date" name="start_date" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="end_date">Wybierz datę końcową pobytu:</label>
                        <input type="date" id="end_date" name="end_date" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="room">Wybierz typ pokoju:</label>
                        <select id="room" name="room" class="form-control" required>
                            <option value="1">Pokój Deluxe: "Royal Retreat"</option>
                            <option value="2">Pokój Superior: "Elegance Suite"</option>
                            <option value="3">Pokój Standard: "Cozy Haven"</option>
                        </select>
                    </div>

                    <input type="submit" value="Zarezerwuj" class="btn btn-primary mb-5">
                </form>

                <section>
                    <div class="card-deck">
                        <div class="card mb-4">
                            <img src="pokoj1.jpg" alt="Pokój Deluxe: Royal Retreat" class="card-img-top hover-enlarge">
                            <div class="card-body">
                                <h5 class="card-title">Pokój Deluxe: "Royal Retreat"</h5>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <img src="pokoj2.jpg" alt="Pokój Superior: Elegance Suite"
                                class="card-img-top hover-enlarge">
                            <div class="card-body">
                                <h5 class="card-title">Pokój Superior: "Elegance Suite"</h5>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <img src="pokoj3.jpg" alt="Pokój Standard: Cozy Haven" class="card-img-top hover-enlarge">
                            <div class="card-body">
                                <h5 class="card-title">Pokój Standard: "Cozy Haven"</h5>
                            </div>
                        </div>
                    </div>
                </section>

                <?php

                require 'connect.php';
                // Inicjalizacja zmiennych wiadomości
                $message = '';
                $messageClass = '';


                // Sprawdzenie, czy użytkownik jest zalogowany
                if (!isset($_SESSION['user_id'])) {
                    $message = "Musisz się zalogować, aby zrobić rezerwację.";
                    $messageClass = 'alert-danger';
                } else {

                    // Sprawdzenie, czy dane z formularza zostały przesłane
                    if (!empty($_POST)) {
                        // Pobranie danych z formularza
                        $start_date = $_POST['start_date'];
                        $end_date = $_POST['end_date'];
                        $room = $_POST['room'];

                        // Sprawdzenie, czy data końcowa jest późniejsza niż data początkowa
                        if ($end_date <= $start_date) {
                            $message = "Data końcowa musi być późniejsza niż data początkowa. Spróbuj ponownie.";
                            $messageClass = 'alert-danger';
                        } else {
                            $sql = "INSERT INTO reservations (start_date, end_date, room, user_id)
            VALUES (?, ?, ?, ?)";

                            $stmt = $pdo->prepare($sql);
                            $stmt->bindParam(1, $start_date);
                            $stmt->bindParam(2, $end_date);
                            $stmt->bindParam(3, $room);
                            $stmt->bindParam(4, $_SESSION['user_id']);

                            // Zapisanie wyniku w zmiennych
                            if ($stmt->execute()) {
                                $message = "Rezerwacja złożona pomyślnie. Dziękujemy!";
                                $messageClass = 'alert-success';
                            } else {
                                $message = $stmt->errorInfo()[2];
                                $messageClass = 'alert-danger';
                            }
                        }
                    }
                }
                ?>

                <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

                <!-- Wyświetlanie powiadomienia -->
                <?php if (isset($message) && $message != ''): ?>
                    <div class="toast mt-5" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000"
                        style="position: absolute; top: 0; right: 0;">
                        <div class="toast-header">
                            <strong class="mr-auto">Powiadomienie</strong>
                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="toast-body <?php echo $messageClass; ?>">
                            <?php echo $message; ?>
                        </div>
                    </div>

                    <!-- Inicjalizacja powiadomienia -->
                    <script>
                        $(document).ready(function () {
                            $('.toast').toast('show');
                        });
                    </script>
                <?php endif; ?>

            </section>
        </div>
    </main>

    <footer id="contact" class="footer mt-auto py-3 bg-light">
        <div class="container text-center">
            <p>Email: kontakt@edenhaven.com</p>
            <p>Tel: +48 234 567 890</p>
            <p>Adres: ul. Podchorążych 2, 30-084 Kraków</p>
        </div>
    </footer>

</body>

</html>