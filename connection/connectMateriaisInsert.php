<?php
session_start();
include_once '../connection/conect.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];
    $quantidade = $_POST['quantidade'];

    $sql = "INSERT INTO estoque (nome_prod, tipo, qntd) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $nome, $tipo, $quantidade);

    if ($stmt->execute()) {
        $_SESSION['message'] = 'Material cadastrado com sucesso!';
        $_SESSION['message_type'] = 'success';
    } else {
        $_SESSION['message'] = 'Erro ao cadastrar material: ' . $stmt->error;
        $_SESSION['message_type'] = 'danger';
    }

    $stmt->close();
    $conn->close();
    
    header("Location: ../pages/materiais.php");
    exit();
}
?>
