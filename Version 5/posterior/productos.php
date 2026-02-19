<?php
include "config.php";

if(isset($_POST['eliminar'])){
$id=$_POST['eliminar'];

$stmt=$conexion->prepare("DELETE FROM productos WHERE id=?");
$stmt->bind_param("i",$id);
$stmt->execute();

$_SESSION['toast']="Producto eliminado correctamente";
header("Location: ../anterior/productos/");
exit;
}

if(isset($_POST['nombre'])){
$stmt=$conexion->prepare("
INSERT INTO productos(nombre,categoria,precio,stock,descripcion)
VALUES(?,?,?,?,?)
");
$stmt->bind_param("ssdis",
$_POST['nombre'],
$_POST['categoria'],
$_POST['precio'],
$_POST['stock'],
$_POST['descripcion']
);
$stmt->execute();

$_SESSION['toast']="Producto creado correctamente";
header("Location: ../anterior/productos/");
exit;
}
?>

