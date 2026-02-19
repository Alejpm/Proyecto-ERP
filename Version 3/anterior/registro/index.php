<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Registro ERP</title>
<style>
body{font-family:Arial;background:#f4f6f9}
form{background:white;padding:20px;margin:50px auto;width:300px;border-radius:8px}
input,select,button{width:100%;margin:8px 0;padding:8px}
button{background:#2563eb;color:white;border:none}
</style>
</head>
<body>

<form method="POST" action="../../posterior/registro.php">
<h2>Registro</h2>

<input name="usuario" placeholder="Usuario" required>
<input name="password" type="password" placeholder="Contraseña" required>

<select name="rol">
<option value="empleado">Empleado</option>
<option value="admin">Admin</option>
</select>

<button>Crear cuenta</button>

<a href="../login/">Volver al login</a>
</form>

</body>
</html>

