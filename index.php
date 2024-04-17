<!DOCTYPE html>
<html lang="pl">

<head>
    <title>Hotel Eden Haven</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
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

    <main class="container mt-3">
        <section>
            <h2>Witaj w Eden Haven</h2>
            <div class="row">
                <div class="col-md-6">
                    <p>Witaj w Eden Haven - Twoim ukojeniu wśród natury i luksusu. Nasz hotel to oaza spokoju położona w
                        malowniczej scenerii, gdzie zieleń otacza Cię ze wszystkich stron, a śpiew ptaków towarzyszy
                        Twojemu
                        wypoczynkowi.</p>
                    <p>W naszym hotelu znajdziesz wszystko, czego potrzebujesz, aby zrelaksować się i odprężyć. Nasze
                        pokoje
                        są przestronne, a ich wystrój nawiązuje do natury, co pozwala Ci poczuć się jak w domu. W naszej
                        restauracji serwujemy dania przygotowane z lokalnych produktów, które zachwycą Twoje
                        podniebienie.
                    </p>
                    <p>Zapewniamy także dostęp do najnowocześniejszych udogodnień, które ułatwią Ci pobyt i sprawią, że
                        poczujesz się jak w domu. Dzięki bezpłatnemu WiFi, telewizorom z płaskim ekranem i minibarom w
                        pokojach będziesz mógł cieszyć się wygodą i rozrywką na wyciągnięcie ręki.</p>
                </div>
                <div class="col-md-6">
                    <img src="hotel.jpg" alt="Hotel Eden Haven"
                        class="img-fluid rounded border card-img-top hover-enlarge">
                </div>
            </div>
        </section>

        <section>
            <h2>Nasze pokoje</h2>
            <div class="card-deck">
                <div class="card mb-4">
                    <img src="pokoj1.jpg" alt="Pokój Deluxe: Royal Retreat" class="card-img-top hover-enlarge">
                    <div class="card-body">
                        <h5 class="card-title">Pokój Deluxe: "Royal Retreat"</h5>
                        <p class="card-text">Przestronny pokój z widokiem na ogród. Wyposażony w łóżko king-size,
                            telewizor
                            z płaskim ekranem, minibar i bezpłatne WiFi.</p>
                    </div>
                </div>
                <div class="card mb-4">
                    <img src="pokoj2.jpg" alt="Pokój Superior: Elegance Suite" class="card-img-top hover-enlarge">
                    <div class="card-body">
                        <h5 class="card-title">Pokój Superior: "Elegance Suite"</h5>
                        <p class="card-text">Przestronny pokój z widokiem na basen. Wyposażony w dwa łóżka pojedyncze,
                            telewizor z płaskim ekranem, minibar i bezpłatne WiFi.</p>
                    </div>
                </div>
                <div class="card mb-4">
                    <img src="pokoj3.jpg" alt="Pokój Standard: Cozy Haven" class="card-img-top hover-enlarge">
                    <div class="card-body">
                        <h5 class="card-title">Pokój Standard: "Cozy Haven"</h5>
                        <p class="card-text">Elegancki pokój z widokiem na las. Wyposażony w łóżko queen-size, telewizor
                            z
                            płaskim ekranem, minibar i bezpłatne WiFi.</p>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-3 mb-3">
                <a href="reservation.php" class="btn btn-primary px-4 py-2">Zarezerwuj pokój</a>
            </div>
        </section>

        <section>
            <h2>Nasza restauracja</h2>
            <div class="row">
                <div class="col-md-6">
                    <img src="bufet1.jpg" alt="Restauracja" class="img-fluid rounded border hover-enlarge">
                </div>
                <div class="col-md-6">
                    <p>Nasza restauracja to miejsce, w którym zasmakujesz prawdziwych smaków. Serwujemy dania
                        przygotowane z
                        lokalnych produktów, które zachwycą Twoje podniebienie. Nasz szef kuchni dba o to, aby każde
                        danie
                        było nie tylko smaczne, ale także pięknie podane.</p>
                    <p>W naszym menu znajdziesz zarówno dania kuchni polskiej, jak i międzynarodowej. Każdy znajdzie coś
                        dla
                        siebie, niezależnie od preferencji smakowych. Nasza restauracja to idealne miejsce na
                        romantyczną
                        kolację, spotkanie biznesowe czy rodzinny obiad.</p>
                </div>
            </div>

            <div class="d-flex justify-content-center mt-3 mb-3">
                <a href="opinions.php" class="btn btn-primary px-4 py-2">Opinie naszych gości</a>
            </div>
        </section>

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