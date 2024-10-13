<?php
$books = json_decode(file_get_contents('../books.json'), true);
$id = $_GET['id'];
$book = array_filter($books, fn($b) => $b['id'] == $id)[0];
?>
<h1><?= $book['title'] ?></h1>
<p>Author: <?= $book['author'] ?></p>
<p>Year: <?= $book['year'] ?></p>
<p>Genre: <?= $book['genre'] ?></p>
<p>ISBN: <?= $book['isbn'] ?></p>
<p>Status: <?= $book['status'] ?></p>
