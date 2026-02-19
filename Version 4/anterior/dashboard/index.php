<?php include "../layout/header.php"; ?>

<div class="card">
<h2>Resumen General</h2>

<?php
$ventas=$conexion->query("SELECT SUM(total) t FROM pedidos")->fetch_assoc()['t'];
$clientes=$conexion->query("SELECT COUNT(*) t FROM clientes")->fetch_assoc()['t'];
$stock_bajo=$conexion->query("SELECT COUNT(*) t FROM productos WHERE stock<stock_minimo")->fetch_assoc()['t'];
?>

<p>Ventas totales: <strong>€<?= $ventas ?? 0 ?></strong></p>
<p>Total clientes: <strong><?= $clientes ?></strong></p>
<p>Productos con stock bajo: <span class="badge"><?= $stock_bajo ?></span></p>
</div>

<?php include "../layout/footer.php"; ?>

