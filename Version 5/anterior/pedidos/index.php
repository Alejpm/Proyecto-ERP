<?php include "../layout/header.php"; ?>

<div class="card">
<h2>Crear Pedido</h2>
<form method="POST" action="../../posterior/pedidos.php">
Cliente ID <input name="id_cliente"><br>
Producto ID <input name="productos[1]"><br>
Cantidad <input name="productos[1]"><br>
<button>Crear</button>
</form>
</div>

<?php include "../layout/footer.php"; ?>

