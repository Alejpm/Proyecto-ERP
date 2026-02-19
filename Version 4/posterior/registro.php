<?php
include "config.php";

if($_POST){

$usuario = trim($_POST['usuario']);
$password = $_POST['password'];
$rol = $_POST['rol'];

if(strlen($usuario) < 3 || strlen($password) < 4){
die("Datos inválidos");
}

// comprobar si existe
$stmt = $conexion->prepare("SELECT id FROM usuarios WHERE usuario=?");
$stmt->bind_param("s",$usuario);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){
die("Usuario ya existe");
}

$hash = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conexion->prepare("
INSERT INTO usuarios(usuario,password,rol)
VALUES(?,?,?)
");

$stmt->bind_param("sss",$usuario,$hash,$rol);
$stmt->execute();

// registrar en logs
$conexion->query("
INSERT INTO logs(usuario,accion,fecha)
VALUES('$usuario','Se registró en el sistema',NOW())
");

header("Location: ../anterior/login/");
}
?>

