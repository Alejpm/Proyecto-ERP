<?php include "../layout/header.php"; ?>

<div class="card">
<h2>Nuevo Cliente</h2>

<form method="POST" action="../../posterior/clientes.php">
<input name="nombre" placeholder="Nombre" required>
<input name="apellidos" placeholder="Apellidos" required>
<input name="email" placeholder="Email" required>
<input name="telefono" placeholder="Teléfono">
<button>Guardar</button>
</form>
</div>

<div class="card">
<h2>Listado de Clientes</h2>

<div class="table-wrapper">
<table class="erp-table">
<thead>
<tr>
<th>ID</th>
<th>Nombre</th>
<th>Email</th>
<th>Teléfono</th>
<th>Fecha</th>
<th>Acciones</th>
</tr>
</thead>
<tbody>

<?php
$r=$conexion->query("SELECT * FROM clientes ORDER BY id DESC");
while($row=$r->fetch_assoc()){
echo "
<tr>
<td>{$row['id']}</td>
<td>{$row['nombre']} {$row['apellidos']}</td>
<td>{$row['email']}</td>
<td>{$row['telefono']}</td>
<td>{$row['fecha_registro']}</td>
<td>
<form method='POST' action='../../posterior/clientes.php' style='display:inline'>
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

