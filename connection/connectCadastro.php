<?php
include_once '../connection/conect.php';

if (isset($_POST['nome'], $_POST['cargo'], $_POST['nivel'], $_POST['username'], $_POST['senha'])) {

    $nome = $_POST['nome'];
    $cargo = $_POST['cargo'];
    $nivel = $_POST['nivel'];
    $username = $_POST['username'];
    $senha = $_POST['senha'];


    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);


    $sql = "INSERT INTO usuario (nome, cargo, nivel, username, senha) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssiss", $nome, $cargo, $nivel, $username, $senha_hash);

    if ($stmt->execute()) {
        $_SESSION['message'] = 'Usuário cadastrado com sucesso!';
        $_SESSION['message_type'] = 'success';
    } else {
        $_SESSION['message'] = 'Erro ao cadastrar usuário!';
        $_SESSION['message_type'] = 'danger';
    }

    $stmt->close();
}

$conn->close();

if (basename($_SERVER['PHP_SELF']) != 'cadastro.php') {
    header("Location: ../pages/cadastro.php");
    exit();
}
?>
