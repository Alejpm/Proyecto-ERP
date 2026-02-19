<?php
include "config.php";

$id=$_GET['id'];

$pedido=$conexion->query("
SELECT pedidos.id,total,clientes.nombre
FROM pedidos
JOIN clientes ON pedidos.id_cliente=clientes.id
WHERE pedidos.id=$id
")->fetch_assoc();

$file="factura_".$id.".txt";
file_put_contents($file,
"Factura Pedido #".$pedido['id']."
Cliente: ".$pedido['nombre']."
Total: €".$pedido['total']."
Fecha: ".date("Y-m-d H:i:s")
);
?>

