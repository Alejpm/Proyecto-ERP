<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Registro ERP PRO</title>
<link rel="stylesheet" href="../layout/auth.css">
</head>
<body>

<div class="auth-container">
<h2>Crear Cuenta</h2>

<form method="POST" action="../../posterior/registro.php">
<input name="usuario" placeholder="Usuario" required>
<input name="password" type="password" placeholder="Contraseña" required>

<select name="rol">
<option value="empleado">Empleado</option>
<option value="admin">Administrador</option>
</select>

<button>Registrarse</button>
</form>

<div class="auth-footer">
¿Ya tienes cuenta? <a href="../login/">Iniciar sesión</a>
</div>
</div>

</body>
</html>

