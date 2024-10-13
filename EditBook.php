<?php
session_start();

// Redirect to login if the user is not logged in
if (!isset($_SESSION['user'])) {
    header('Location: ../auth/login.php');
    exit;
}

// Load the books data
$books = json_decode(file_get_contents('../books.json'), true);

// Get the book ID from the URL
$id = $_GET['id'];

// Find the book to edit
$bookIndex = array_search($id, array_column($books, 'id'));
if ($bookIndex === false) {
    echo "Book not found!";
    exit;
}

// Handle form submission to update the book
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $books[$bookIndex]['title'] = $_POST['title'];
    $books[$bookIndex]['author'] = $_POST['author'];
    $books[$bookIndex]['year'] = $_POST['year'];
    $books[$bookIndex]['genre'] = $_POST['genre'];
    $books[$bookIndex]['isbn'] = $_POST['isbn'];
    $books[$bookIndex]['status'] = $_POST['status'];

    // Save the updated data back to books.json
    file_put_contents('../books.json', json_encode($books));

    // Redirect back to the books list
    header('Location: index.php');
    exit;
}

// Get the current book details for the form
$book = $books[$bookIndex];
?>

<h1>Edit Book</h1>
<form method="POST">
    <input type="text" name="title" value="<?= htmlspecialchars($book['title']) ?>" required><br>
    <input type="text" name="author" value="<?= htmlspecialchars($book['author']) ?>" required><br>
    <input type="number" name="year" value="<?= htmlspecialchars($book['year']) ?>" required><br>
    <input type="text" name="genre" value="<?= htmlspecialchars($book['genre']) ?>" required><br>
    <input type="text" name="isbn" value="<?= htmlspecialchars($book['isbn']) ?>" required><br>
    <select name="status" required>
        <option value="Available" <?= $book['status'] == 'Available' ? 'selected' : '' ?>>Available</option>
        <option value="Borrowed" <?= $book['status'] == 'Borrowed' ? 'selected' : '' ?>>Borrowed</option>
    </select><br>
    <button type="submit">Save Changes</button>
</form>
<a href="index.php">Back to Book List</a>
