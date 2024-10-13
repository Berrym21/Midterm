<?php
session_start();
$books = json_decode(file_get_contents('../books.json'), true);
?>
<a href="../auth/logout.php">Logout</a>
<h1>Book List</h1>
<ul>
    <?php foreach ($books as $book): ?>
        <li>
            <a href="detail.php?id=<?= $book['id'] ?>"><?= $book['title'] ?></a>
            <?php if (isset($_SESSION['user'])): ?>
                <a href="edit.php?id=<?= $book['id'] ?>">Edit</a>
                <a href="delete.php?id=<?= $book['id'] ?>">Delete</a>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
</ul>
<?php if (isset($_SESSION['user'])): ?>
    <a href="create.php">Add New Book</a>
<?php endif; ?>
