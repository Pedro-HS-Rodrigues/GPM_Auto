<?php
include_once '../connection/conect.php';

$sqlMecanicos = "SELECT id, nome FROM usuario WHERE nivel = 3";
$resultMecanicos = $conn->query($sqlMecanicos);
$mecanicos = [];
if ($resultMecanicos->num_rows > 0) {
    while ($row = $resultMecanicos->fetch_assoc()) {
        $mecanicos[] = $row;
    }
}

$sqlProdutos = "SELECT id, nome_prod FROM estoque";
$resultProdutos = $conn->query($sqlProdutos);
$produtos = [];
if ($resultProdutos->num_rows > 0) {
    while ($row = $resultProdutos->fetch_assoc()) {
        $produtos[] = $row;
    }
}

$dadosDoBanco = $dadosDoBanco; 
?>
