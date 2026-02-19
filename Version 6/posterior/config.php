<?php
$conexion = new mysqli("localhost","root","","erp_pro");
if($conexion->connect_error){ die("Error conexión"); }
session_start();
?>

