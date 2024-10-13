<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../auth/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $books = json_decode(file_get_contents('../books.json'), true) ?? [];
    $newBook = [
        'id' => count($books) + 1,
        'title' => $_POST['title'],
        'author' => $_POST['author'],
        'year' => $_POST['year'],
        'genre' => $_POST['genre'],
        'isbn' => $_POST['isbn'],
        'status' => 'Available'
    ];
    $books[] = $newBook;
    file_put_contents('../books.json', json_encode($books));
    header('Location: index.php');
    exit;
}
?>
<form method="POST">
    <input type="text" name="title" placeholder="Title" required>
    <input type="text" name="author" placeholder="Author" required>
    <input type="number" name="year" placeholder="Year" required>
    <input type="text" name="genre" placeholder="Genre" required>
    <input type="text" name="isbn" placeholder="ISBN" required>
    <button type="submit">Add Book</button>
</form>
