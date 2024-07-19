<?php
include_once '../connection/conect.php';

$query = "SELECT id, nome FROM estoque";
$result = $mysqli->query($query);

$produtos = array();
while ($row = $result->fetch_assoc()) {
    $produtos[] = $row;
}

header('Content-Type: application/json');
echo json_encode($produtos);

$mysqli->close();
?>
