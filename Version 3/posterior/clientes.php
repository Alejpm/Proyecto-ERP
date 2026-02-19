<?php
include "config.php";

if($_POST){
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

    $conexion->query("
    INSERT INTO logs(usuario,accion,fecha)
    VALUES('".$_SESSION['usuario']."','Creó cliente',NOW())
    ");
}

header("Location: ../anterior/clientes/");
?>

