<?php include "../layout/header.php"; ?>

<div class="card">
<?php
$ventas=$conexion->query("SELECT SUM(total) t FROM pedidos")->fetch_assoc()['t'];
$clientes=$conexion->query("SELECT COUNT(*) t FROM clientes")->fetch_assoc()['t'];
$stock_bajo=$conexion->query("SELECT COUNT(*) t FROM productos WHERE stock<stock_minimo")->fetch_assoc()['t'];
?>
<h3>Ventas totales: €<?= $ventas ?? 0 ?></h3>
<h3>Total clientes: <?= $clientes ?></h3>
<h3>Productos con stock bajo: <?= $stock_bajo ?></h3>
</div>

<?php include "../layout/footer.php"; ?>

