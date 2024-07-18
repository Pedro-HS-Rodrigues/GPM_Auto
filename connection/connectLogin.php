<?php
session_start();
include '../connection/conect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    $sql = "SELECT id, nome, username, senha FROM usuario WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if ($password === $user['senha']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: ../pages/dashboard.php");
            exit();
        } else {
            $_SESSION['login_error'] = "Senha incorreta!";
        }
    } else {
        $_SESSION['login_error'] = "Usuário não encontrado!";
    }

    header("Location: ../pages/index.php");
    exit();
}
?>
