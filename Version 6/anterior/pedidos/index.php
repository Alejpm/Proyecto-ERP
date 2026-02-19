<?php include "../layout/header.php"; ?>

<div class="card">
<h2>Crear Pedido</h2>

<form method="POST" action="../../posterior/pedidos.php">
<input type="hidden" name="crear" value="1">

<label>ID Cliente</label>
<input name="id_cliente" required>

<label>ID Producto</label>
<input name="id_producto" required>

<label>Cantidad</label>
<input name="cantidad" type="number" min="1" required>

<button>Crear Pedido</button>
</form>
</div>

<div class="card">
<h2>Cambiar Estado Pedido</h2>

<form method="POST" action="../../posterior/pedidos.php">
<input type="hidden" name="cambiar_estado" value="1">

<label>Código Pedido</label>
<input name="codigo" required>

<label>Nuevo Estado</label>
<select name="estado">
<option value="Pagado">Pagado</option>
<option value="Enviado">Enviado</option>
<option value="Cancelado">Cancelado</option>
</select>

<button>Actualizar Estado</button>
</form>
</div>

<div class="card">
<h2>Listado</h2>
<div class="card">
<h2>Historial de Cambios</h2>

<div class="table-wrapper">
<table class="erp-table">
<thead>
<tr>
<th>Código</th>
<th>De</th>
<th>A</th>
<th>Fecha</th>
</tr>
</thead>
<tbody>

<?php
$r=$conexion->query("SELECT * FROM historial_pedidos ORDER BY fecha DESC LIMIT 20");
while($row=$r->fetch_assoc()){
echo "
<tr>
<td>{$row['codigo']}</td>
<td>{$row['estado_anterior']}</td>
<td>{$row['estado_nuevo']}</td>
<td>{$row['fecha']}</td>
</tr>
";
}
?>

</tbody>
</table>
</div>
</div>

<div class="table-wrapper">
<table class="erp-table">
<thead>
<tr>
<th>ID</th>
<th>Código</th>
<th>Cliente</th>
<th>Estado</th>
<th>Total</th>
</tr>
</thead>
<tbody>

<?php
$r=$conexion->query("
SELECT pedidos.*, clientes.nombre
FROM pedidos
LEFT JOIN clientes ON pedidos.id_cliente=clientes.id
ORDER BY pedidos.id DESC
");

while($row=$r->fetch_assoc()){
echo "
<tr>
<td>{$row['id']}</td>
<td>{$row['codigo']}</td>
<td>{$row['nombre']}</td>
<td>{$row['estado']}</td>
<td>€ {$row['total']}</td>
</tr>
";
}
?>

</tbody>
</table>
</div>
</div>

<?php include "../layout/footer.php"; ?>

