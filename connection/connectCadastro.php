<?php
session_start();
include_once '../connection/conect.php';

// Verifica se os dados foram enviados corretamente
if (isset($_POST['nome'], $_POST['cargo'], $_POST['nivel'], $_POST['username'], $_POST['senha'])) {
    // Recebe os dados do formulário
    $nome = $_POST['nome'];
    $cargo = $_POST['cargo'];
    $nivel = $_POST['nivel'];
    $username = $_POST['username'];
    $senha = $_POST['senha'];

    // Codifica a senha
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    // Inserir no banco de dados
    $sql = "INSERT INTO usuario (nome, cargo, nivel, username, senha) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssiss", $nome, $cargo, $nivel, $username, $senha_hash);

    if ($stmt->execute()) {
        echo "Cadastro realizado com sucesso!";
    } else {
        echo "Erro ao cadastrar usuário: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Erro: Todos os campos do formulário devem ser preenchidos.";
}

$conn->close();
?>
