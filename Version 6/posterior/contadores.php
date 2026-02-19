<?php
include "config.php";

$datos = [
"Pendiente"=>$conexion->query("SELECT COUNT(*) c FROM pedidos WHERE estado='Pendiente'")->fetch_assoc()['c'],
"Pagado"=>$conexion->query("SELECT COUNT(*) c FROM pedidos WHERE estado='Pagado'")->fetch_assoc()['c'],
"Enviado"=>$conexion->query("SELECT COUNT(*) c FROM pedidos WHERE estado='Enviado'")->fetch_assoc()['c'],
"Cancelado"=>$conexion->query("SELECT COUNT(*) c FROM pedidos WHERE estado='Cancelado'")->fetch_assoc()['c']
];

echo json_encode($datos);
?>

