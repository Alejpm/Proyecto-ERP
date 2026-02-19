<?php include "../layout/header.php"; ?>

<div class="card">
<h2>Nuevo Producto</h2>

<form method="POST" action="../../posterior/productos.php">
<input name="nombre" placeholder="Nombre" required>
<input name="categoria" placeholder="Categoría" required>
<input name="precio" placeholder="Precio" required>
<input name="stock" placeholder="Stock" required>
<textarea name="descripcion" placeholder="Descripción"></textarea>
<button>Guardar</button>
</form>
</div>

<div class="card">
<h2>Listado de Productos</h2>

<div class="table-wrapper">
<table class="erp-table">
<thead>
<tr>
<th>ID</th>
<th>Nombre</th>
<th>Categoría</th>
<th>Precio</th>
<th>Stock</th>
<th>Acciones</th>
</tr>
</thead>
<tbody>

<?php
$r=$conexion->query("SELECT * FROM productos ORDER BY id DESC");
while($row=$r->fetch_assoc()){

$stockColor = $row['stock'] < 5 ? "style='color:red;font-weight:bold'" : "";

echo "
<tr>
<td>{$row['id']}</td>
<td>{$row['nombre']}</td>
<td>{$row['categoria']}</td>
<td>€ {$row['precio']}</td>
<td $stockColor>{$row['stock']}</td>
<td>
<form method='POST' action='../../posterior/productos.php' style='display:inline'>
<input type='hidden' name='eliminar' value='{$row['id']}'>
<button class='action-btn btn-delete'>Eliminar</button>
</form>
</td>
</tr>
";
}
?>

</tbody>
</table>
</div>
</div>

<?php include "../layout/footer.php"; ?>

