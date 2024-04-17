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

// Jeśli użytkownik nie jest administratorem, przekierowujemy go na stronę główną
if (!$is_admin) {
    header('Location: index.php');
    exit;
}

// Pobieramy id wiadomości z parametru GET
$newsId = isset($_GET['id']) ? $_GET['id'] : null;

if ($newsId) {
    // Pobieramy wiadomość z bazy danych
    $sql = "SELECT * FROM news WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $newsId]);

    // Pobieramy dane wiadomości
    $news = $stmt->fetch();
}

// Jeśli formularz został wysłany
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle the photo upload
    if ($_FILES['photo']['error'] == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES['photo']['tmp_name'];
        $name = $_FILES['photo']['name'];
        move_uploaded_file($tmp_name, "uploads/$name");
        $photo_url = "uploads/$name";
    } else {
        $photo_url = $news['photo_url'];
    }

    // Aktualizujemy wiadomość w bazie danych
    $sql = "UPDATE news SET title = :title, content = :content, photo_url = :photo_url WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'title' => $_POST['title'],
        'content' => $_POST['content'],
        'photo_url' => $photo_url,
        'id' => $newsId
    ]);

    // Przekierowujemy użytkownika na stronę z aktualnościami
    header('Location: news.php');
    exit;
}
?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

<main class="container">
    <section class="row">
        <article class="col-md-8 offset-md-2">
            <header>
                <h1 class="mt-5">Edycja</h1>
            </header>

            <!-- Formularz do edycji wiadomości -->
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Tytuł:</label>
                    <input type="text" id="title" name="title" value="<?php echo $news['title']; ?>"
                        class="form-control">
                </div>

                <div class="form-group">
                    <label for="content">Treść:</label>
                    <textarea id="content" name="content"
                        class="form-control"><?php echo $news['content']; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="photo">Zdjęcie:</label>
                    <input type="file" id="photo" name="photo" class="form-control-file">
                </div>

                <input type="submit" value="Zapisz" class="btn btn-primary">
            </form>
        </article>
    </section>
</main>