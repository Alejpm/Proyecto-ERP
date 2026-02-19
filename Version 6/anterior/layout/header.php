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

<a href="../kanban/">
🗂 Kanban
<span class="badge" id="badgePendientes">0</span>
</a>

<div id="hudEstados" style="margin-top:15px;font-size:13px;color:#94a3b8;">
Pendientes: 0<br>
Pagados: 0<br>
Enviados: 0<br>
Cancelados: 0
</div>

<a href="../../posterior/logout.php">🚪 Salir</a>
</div>

<div class="main">
<div class="topbar">
<button onclick="toggleDark()">🌙</button>
<div>Bienvenido, <?=$_SESSION['usuario']?></div>
<div>Rol: <?=$_SESSION['rol']?></div>
</div>

<div class="content">

