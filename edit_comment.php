<?php
// Rozpoczęcie sesji
session_start();

require 'connect.php';

// Sprawdzenie, czy formularz został wysłany
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Pobranie ID komentarza i nowego tekstu komentarza
    $id = $_POST['id'];
    $comment = $_POST['comment'];

    // Aktualizacja komentarza w bazie danych
    $stmt = $pdo->prepare('UPDATE comments SET comment = ? WHERE comment_id = ?');
    $stmt->execute([$comment, $id]);

    // Przekierowanie z powrotem na stronę opinii
    header('Location: opinions.php');
    exit;
} else {
    // Pobranie ID komentarza z URL
    $id = $_GET['id'];

    // Pobranie komentarza z bazy danych
    $stmt = $pdo->prepare('SELECT comment FROM comments WHERE comment_id = ?');
    $stmt->execute([$id]);
    $comment = $stmt->fetchColumn();
}
?>


<!DOCTYPE html>
<html lang="pl">

<head>
    <title>Edytuj Komentarz</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-5">
                    <div class="card-header">Edytuj Komentarz</div>
                    <div class="card-body">
                        <form action="edit_comment.php" method="post">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                            <div class="form-group">
                                <label for="comment">Komentarz</label>
                                <textarea class="form-control" id="comment" name="comment"
                                    rows="3"><?php echo htmlspecialchars($comment); ?></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Aktualizuj Komentarz</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>

</html>