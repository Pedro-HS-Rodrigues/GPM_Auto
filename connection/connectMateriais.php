<?php
include_once '../connection/conect.php';

$sql = "SELECT id, nome_prod, tipo, qntd FROM estoque";
$result = $conn->query($sql);

$dadosDoBanco = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $dadosDoBanco[] = $row;
    }
}
?>

