<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Login ERP PRO</title>
<link rel="stylesheet" href="../layout/auth.css">
</head>
<body>

<div class="auth-container">
<h2>Iniciar Sesión</h2>

<input id="usuario" placeholder="Usuario">
<input id="password" type="password" placeholder="Contraseña">

<button onclick="login()">Entrar</button>

<div class="auth-footer">
¿No tienes cuenta? <a href="../registro/">Registrarse</a>
</div>
</div>

<script>
function login(){
fetch("../../posterior/auth.php",{
method:"POST",
headers:{"Content-Type":"application/json"},
body:JSON.stringify({
usuario:usuario.value,
password:password.value
})
})
.then(r=>r.json())
.then(d=>{
if(d.success){
window.location="../dashboard/";
}else{
alert("Credenciales incorrectas");
}
});
}
</script>

</body>
</html>

