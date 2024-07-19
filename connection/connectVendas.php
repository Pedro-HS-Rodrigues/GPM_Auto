<?php
include_once '../connection/conect.php';

$sql = "SELECT 
            v.nome AS Vendedor, 
            vd.data AS Data, 
            e.nome_prod AS Produto, 
            vd.quantidade AS Quantidade 
        FROM venda vd
        LEFT JOIN usuario v ON vd.vendedor = v.id
        LEFT JOIN estoque e ON vd.produto = e.id";

$result = $conn->query($sql);
if (!$result) {
    die("Erro na consulta: " . $conn->error);
}

if ($result->num_rows > 0) {
    $dadosDoBanco = [];
    while ($row = $result->fetch_assoc()) {
        $dadosDoBanco[] = $row;
    }
} else {
    $dadosDoBanco = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vendedor = $_POST['vendedor'];
    $data = $_POST['data'];
    $produto = $_POST['produto'];
    $quantidade = $_POST['quantidade'];

    $sql = "INSERT INTO venda (vendedor, data, produto, quantidade) VALUES (?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("issi", $vendedor, $data, $produto, $quantidade);

        if ($stmt->execute()) {
            header("Location: ../pages/vendas.php");
            exit();
        } else {
            echo "Erro ao cadastrar a venda: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Erro na preparação da declaração: " . $conn->error;
    }
}

$sqlVendedores = "SELECT id, nome FROM usuario WHERE nivel = 4";
$resultVendedores = $conn->query($sqlVendedores);
if (!$resultVendedores) {
    die("Erro na consulta de vendedores: " . $conn->error);
}
$vendedores = [];
if ($resultVendedores->num_rows > 0) {
    while ($row = $resultVendedores->fetch_assoc()) {
        $vendedores[] = $row;
    }
}

$sqlProdutos = "SELECT id, nome_prod FROM estoque WHERE qntd > 0";
$resultProdutos = $conn->query($sqlProdutos);
if (!$resultProdutos) {
    die("Erro na consulta de produtos: " . $conn->error);
}
$produtos = [];
if ($resultProdutos->num_rows > 0) {
    while ($row = $resultProdutos->fetch_assoc()) {
        $produtos[] = $row;
    }
}

$conn->close();
?>
