<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../auth/login.php');
    exit;
}

$id = $_GET['id'];
$books = json_decode(file_get_contents('../books.json'), true);
$books = array_filter($books, fn($b) => $b['id'] != $id);
file_put_contents('../books.json', json_encode($books));
header('Location: index.php');
?>
