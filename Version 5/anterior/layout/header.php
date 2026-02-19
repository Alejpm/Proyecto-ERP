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
<link rel="stylesheet" href="../layout/style.css">
</head>
<body>

<div class="sidebar">
<h2>ERP PRO</h2>

<a href="../dashboard/">📊 Dashboard</a>
<a href="../clientes/">👥 Clientes</a>
<a href="../productos/">📦 Productos</a>
<a href="../pedidos/">🛒 Pedidos</a>
<a href="../kanban/">🗂 Kanban</a>
<a href="../../posterior/logout.php">🚪 Salir</a>

</div>

<div class="main">
<div class="topbar">
<div>Bienvenido, <?=$_SESSION['usuario']?></div>
<div>Rol: <?=$_SESSION['rol']?></div>
</div>

<div class="content">
<?php if(isset($_SESSION['toast'])): ?>
<div class="toast" id="toast">
<?= $_SESSION['toast']; ?>
</div>
<?php unset($_SESSION['toast']); endif; ?>


