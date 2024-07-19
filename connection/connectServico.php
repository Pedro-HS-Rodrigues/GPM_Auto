<?php
include_once '../connection/conect.php';

$sql = "SELECT 
            m.nome AS Mecânico, 
            s.data AS Data, 
            s.servico AS Serviço, 
            e.nome_prod AS Produto, 
            s.quantidade_prod AS Quantidade 
        FROM servico s
        LEFT JOIN usuario m ON s.mecanico = m.id
        LEFT JOIN estoque e ON s.produto = e.id";

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
    $mecanico = $_POST['mecanico'];
    $data = $_POST['data'];
    $servico = $_POST['servico'];
    $produto = $_POST['produto'];
    $quantidade = $_POST['quantidade'];

    $sql = "INSERT INTO servico (mecanico, data, servico, produto, quantidade_prod) VALUES (?, ?, ?, ?, ?)";


    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("issii", $mecanico, $data, $servico, $produto, $quantidade);

        if ($stmt->execute()) {
            header("Location: ../pages/servico.php");
            exit();
        } else {

            echo "Erro ao cadastrar o serviço: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Erro na preparação da declaração: " . $conn->error;
    }
}

$sqlMecanicos = "SELECT id, nome FROM usuario WHERE nivel = 3";
$resultMecanicos = $conn->query($sqlMecanicos);
if (!$resultMecanicos) {
    die("Erro na consulta de mecânicos: " . $conn->error);
}
$mecanicos = [];
if ($resultMecanicos->num_rows > 0) {
    while ($row = $resultMecanicos->fetch_assoc()) {
        $mecanicos[] = $row;
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

$dadosDoBanco = $dadosDoBanco; 

$conn->close();
?>
