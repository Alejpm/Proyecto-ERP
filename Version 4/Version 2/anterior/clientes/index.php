<?php include "../layout/header.php"; ?>

<div class="card">
<h2>Nuevo Cliente</h2>
<form method="POST" action="../../posterior/clientes.php">
<input name="nombre" placeholder="Nombre"><br>
<input name="apellidos" placeholder="Apellidos"><br>
<input name="email" placeholder="Email"><br>
<input name="telefono" placeholder="Telefono"><br>
<button>Guardar</button>
</form>
</div>

<div class="card">
<h2>Listado</h2>
<?php
$r=$conexion->query("SELECT * FROM clientes");
while($row=$r->fetch_assoc()){
echo $row['nombre']." ".$row['apellidos']."<br>";
}
?>
</div>

<?php include "../layout/footer.php"; ?>

