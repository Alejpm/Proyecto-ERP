<?php
include "config.php";

$data=json_decode(file_get_contents("php://input"),true);

$id=$data['id'];
$estado=$data['estado'];

$stmt=$conexion->prepare("UPDATE pedidos SET estado=? WHERE id=?");
$stmt->bind_param("si",$estado,$id);
$stmt->execute();

if($estado=="Pagado"){
file_get_contents("http://localhost/erp_pro/posterior/generar_factura.php?id=".$id);
}

$conexion->query("
INSERT INTO logs(usuario,accion,fecha)
VALUES('".$_SESSION['usuario']."','Cambio estado pedido $id a $estado',NOW())
");

echo json_encode(["success"=>true]);
?>

