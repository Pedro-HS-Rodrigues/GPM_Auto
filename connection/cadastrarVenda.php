<?php
include_once '../connection/conect.php';

$cliente = $_POST['cliente-name'];
$vendedor_id = $_POST['vendedor-select'];
$produto_id = $_POST['produto-select'];
$quantidade = $_POST['quantidade'];

$query = "INSERT INTO venda (cliente, vendedor_id, produto_id, quantidade, data) VALUES (?, ?, ?, ?, NOW())";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("siii", $cliente, $vendedor_id, $produto_id, $quantidade);

if ($stmt->execute()) {
    $response = array('success' => true);
} else {
    $response = array('success' => false, 'message' => $stmt->error);
}

$stmt->close();
$mysqli->close();

header('Content-Type: application/json');
echo json_encode($response);
?>
