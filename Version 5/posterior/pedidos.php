<?php
include "config.php";

$conexion->begin_transaction();

try{

$id_cliente=$_POST['id_cliente'];
$productos=$_POST['productos']; // array id=>cantidad

$stmt=$conexion->prepare("
INSERT INTO pedidos(id_cliente,fecha,estado,total)
VALUES(?,NOW(),'Pendiente',0)
");
$stmt->bind_param("i",$id_cliente);
$stmt->execute();
$id_pedido=$stmt->insert_id;

$total=0;

foreach($productos as $id_producto=>$cantidad){

$p=$conexion->query("SELECT precio,stock FROM productos WHERE id=$id_producto")->fetch_assoc();

if($p['stock']<$cantidad){
throw new Exception("Stock insuficiente");
}

$subtotal=$p['precio']*$cantidad;
$total+=$subtotal;

$conexion->query("
INSERT INTO lineas_pedido(id_pedido,id_producto,cantidad,precio_unitario)
VALUES($id_pedido,$id_producto,$cantidad,".$p['precio'].")
");

$conexion->query("
UPDATE productos SET stock=stock-$cantidad WHERE id=$id_producto
");
}

$conexion->query("UPDATE pedidos SET total=$total WHERE id=$id_pedido");

$conexion->commit();

$_SESSION['toast'] = "Pedido creado correctamente";
header("Location: ../anterior/pedidos/");
exit;


}catch(Exception $e){
$conexion->rollback();
echo $e->getMessage();
}
?>

