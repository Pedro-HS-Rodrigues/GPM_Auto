<?php
include_once '../connection/connectMateriais.php'; 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $quantidade = intval($_POST['quantidade']);

    if ($conn) {
        $stmt = $conn->prepare("SELECT qntd FROM estoque WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $produto = $result->fetch_assoc();

        if ($produto) {
            $novaQuantidade = $produto['qntd'] + $quantidade;
            $stmt = $conn->prepare("UPDATE estoque SET qntd = ? WHERE id = ?");
            $stmt->bind_param("ii", $novaQuantidade, $id);
            $result = $stmt->execute();

            if ($result) {
                $_SESSION['message'] = 'Material atualizado!';
                $_SESSION['message_type'] = 'success';
            } else {
                $_SESSION['message'] = 'Material atualizado!';
                $_SESSION['message_type'] = 'danger';
            }
        } else {
            $_SESSION['message'] = 'Produto não encontrado!';
            $_SESSION['message_type'] = 'danger';
        }

        $stmt->close();
    }
        header("Location: ../pages/materiais.php");
    $conn->close();
}
?>
