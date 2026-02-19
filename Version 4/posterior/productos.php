<?php
include "config.php";

if($_POST){
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
}

header("Location: ../anterior/productos/");
?>

