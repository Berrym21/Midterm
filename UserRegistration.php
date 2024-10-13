<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $users = json_decode(file_get_contents('../users.json'), true) ?? [];
    $users[] = ['username' => $username, 'password' => $password];

    file_put_contents('../users.json', json_encode($users));
    header('Location: login.php');
    exit;
}
?>
<form method="POST">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Sign Up</button>
</form>
