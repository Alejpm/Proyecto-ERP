<?php
include "config.php";

$result=$conexion->query("
SELECT codigo, estado, total, fecha
FROM pedidos
ORDER BY estado
");

$datos=[];

while($row=$result->fetch_assoc()){
$datos[]=$row;
}

header('Content-Type: application/json');
echo json_encode($datos, JSON_PRETTY_PRINT);
?>

