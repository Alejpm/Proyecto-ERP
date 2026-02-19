<?php
include "../../posterior/config.php";
if(!isset($_SESSION['usuario'])){
header("Location: ../login/");
exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>ERP PRO</title>
<style>
body{font-family:Arial;background:#f4f6f9;margin:0}
header{background:#1e293b;color:white;padding:15px}
nav a{color:white;margin-right:15px;text-decoration:none}
.card{background:white;padding:15px;margin:15px;border-radius:6px}
button{padding:6px 10px}
</style>
</head>
<body>

<header>
<nav>
<a href="../dashboard/">Dashboard</a>
<a href="../clientes/">Clientes</a>
<a href="../productos/">Productos</a>
<a href="../pedidos/">Pedidos</a>
<a href="../../posterior/logout.php">Salir</a>
</nav>
</header>

