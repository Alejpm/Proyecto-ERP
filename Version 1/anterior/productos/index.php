<?php include "../layout/header.php"; ?>

<div class="card">
<h2>Nuevo Producto</h2>
<form method="POST" action="../../posterior/productos.php">
<input name="nombre" placeholder="Nombre"><br>
<input name="categoria" placeholder="Categoria"><br>
<input name="precio" placeholder="Precio"><br>
<input name="stock" placeholder="Stock"><br>
<textarea name="descripcion" placeholder="Descripcion"></textarea><br>
<button>Guardar</button>
</form>
</div>

<div class="card">
<h2>Listado</h2>
<?php
$r=$conexion->query("SELECT * FROM productos");
while($row=$r->fetch_assoc()){
echo $row['nombre']." - Stock: ".$row['stock']."<br>";
}
?>
</div>

<?php include "../layout/footer.php"; ?>

