<?php
include "config.php";

if(isset($_POST['eliminar'])){
$id=$_POST['eliminar'];

$stmt=$conexion->prepare("DELETE FROM clientes WHERE id=?");
$stmt->bind_param("i",$id);
$stmt->execute();

$_SESSION['toast']="Cliente eliminado correctamente";
header("Location: ../anterior/clientes/");
exit;
}

if(isset($_POST['nombre'])){
$stmt=$conexion->prepare("
INSERT INTO clientes(nombre,apellidos,email,telefono,fecha_registro)
VALUES(?,?,?,?,CURDATE())
");
$stmt->bind_param("ssss",
$_POST['nombre'],
$_POST['apellidos'],
$_POST['email'],
$_POST['telefono']
);
$stmt->execute();

$_SESSION['toast']="Cliente creado correctamente";
header("Location: ../anterior/clientes/");
exit;
}
?>

