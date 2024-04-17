<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeria</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
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
            <h1 class="text-center">Hotel Eden Haven</h1>
            <div class="navbar-nav ml-auto">
                <?php
                // Jeśli użytkownik jest zalogowany, wyświetlamy powitanie i link do wylogowania
                if (isset($_SESSION['username'])) {
                    echo '<span class="navbar-text">Witaj, ' . $_SESSION['username'] . '</span>';
                    echo '<a class="nav-item nav-link" href="my_reservations.php">Moje rezerwacje</a>';
                    echo '<a class="nav-item nav-link" href="logout.php">Wyloguj</a>';
                } else {
                    // Jeśli użytkownik nie jest zalogowany, wyświetlamy linki do rejestracji i logowania
                    echo '<a class="nav-item nav-link" href="register.php">Rejestracja</a>';
                    echo '<a class="nav-item nav-link" href="login.php">Logowanie</a>';
                }
                ?>
            </div>
        </nav>
    </header>
    <main>
        <section class="container-fluid">
            <div class="gallery row justify-content-center p-3">
                <!-- Tutaj wyświetlamy miniaturki zdjęć pokoi -->
                <!-- Kliknięcie na miniaturkę otwiera modal z pełnym zdjęciem -->
                <div class="gallery row justify-content-center p-3">
                    <!-- Tutaj wyświetlamy miniaturki zdjęć pokoi -->
                    <!-- Kliknięcie na miniaturkę otwiera modal z pełnym zdjęciem -->
                    <div class="col-sm-3 mb-4">
                        <div class="card mx auto">
                            <img src="pokoj1.jpg" alt="Thumbnail" class="card-img-top thumbnail img-fluid hover-enlarge"
                                data-toggle="modal" data-target="#imageModal" data-src="pokoj1.jpg">
                            <div class="card-body">
                                <p class="card-text">Pokój Deluxe: "Royal Retreat"</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 mb-4">
                        <div class="card mx auto">
                            <img src="pokoj2.jpg" alt="Thumbnail" class="card-img-top thumbnail img-fluid hover-enlarge"
                                data-toggle="modal" data-target="#imageModal" data-src="pokoj2.jpg">
                            <div class="card-body">
                                <p class="card-text">Pokój Superior: "Elegance Suite"</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 mb-4">
                        <div class="card mx auto">
                            <img src="pokoj3.jpg" alt="Thumbnail" class="card-img-top thumbnail img-fluid hover-enlarge"
                                data-toggle="modal" data-target="#imageModal" data-src="pokoj3.jpg">
                            <div class="card-body">
                                <p class="card-text">Pokój Standard: "Cozy Haven"</p>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-3 mb-4">
                            <div class="card mx auto">
                                <img src="lazienka1.jpg" alt="Thumbnail"
                                    class="card-img-top thumbnail img-fluid hover-enlarge" data-toggle="modal"
                                    data-target="#imageModal" data-src="lazienka1.jpg">
                                <div class="card-body">
                                    <p class="card-text">Łazienka pokoju Deluxe: "Royal Retreat"</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 mb-4">
                            <div class="card mx auto">
                                <img src="lazienka2.jpg" alt="Thumbnail"
                                    class="card-img-top thumbnail img-fluid hover-enlarge" data-toggle="modal"
                                    data-target="#imageModal" data-src="lazienka2.jpg">
                                <div class="card-body">
                                    <p class="card-text">Łazienka pokoju Superior: "Elegance Suite"</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 mb-4">
                            <div class="card mx auto">
                                <img src="lazienka3.jpg" alt="Thumbnail"
                                    class="card-img-top thumbnail img-fluid hover-enlarge" data-toggle="modal"
                                    data-target="#imageModal" data-src="lazienka3.jpg">
                                <div class="card-body">
                                    <p class="card-text">Łazienka pokoju Standard: "Cozy Haven"</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Modal -->
        <!-- Wyświetlanie pełnego zdjęcia po kliknięciu na miniaturkę -->
        <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title" id="modalText">Card Text</div> <!-- Card text goes here -->
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img src="" class="img-fluid" id="modalImage">
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Pobieramy miniaturki
            var thumbnails = document.getElementsByClassName('thumbnail');
            // Pobieramy element obrazu w modalu
            var modalImage = document.getElementById('modalImage');
            // Pobieramy element tekstu w modalu
            var modalText = document.getElementById('modalText');

            // Dodajemy nasłuchiwacz zdarzeń do każdej miniaturki
            for (var i = 0; i < thumbnails.length; i++) {
                thumbnails[i].addEventListener('click', function () {
                    // Ustawiamy źródło obrazu w modalu na źródło klikniętej miniaturki
                    modalImage.src = this.dataset.src;
                    // Pobieramy tekst z karty
                    var cardText = this.parentElement.getElementsByClassName('card-text')[0].innerText;
                    // Ustawiamy tekst w modalu na tekst z karty
                    modalText.innerText = cardText;
                });
            }
        </script>
    </main>

    <footer id="contact" class="footer mt-auto py-3 bg-light">
        <div class="container text-center">
            <p>Email: kontakt@edenhaven.com</p>
            <p>Tel: +48 234 567 890</p>
            <p>Adres: ul. Podchorążych 2, 30-084 Kraków</p>
        </div>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>

</html>