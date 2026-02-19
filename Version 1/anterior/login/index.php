<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Login ERP</title>
</head>
<body>
<h2>Login</h2>
<input id="usuario">
<input id="password" type="password">
<button onclick="login()">Entrar</button>

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
if(d.success){window.location="../dashboard/";}
else{alert("Error");}
});
}
</script>
</body>
</html>

