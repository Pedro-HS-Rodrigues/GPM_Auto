<?php
include_once '../connection/conect.php';

$query = "SELECT id, nome FROM usuarios WHERE nivel = 4";
$result = $mysqli->query($query);

$vendedores = array();
while ($row = $result->fetch_assoc()) {
    $vendedores[] = $row;
}

header('Content-Type: application/json');
echo json_encode($vendedores);

$mysqli->close();
?>
