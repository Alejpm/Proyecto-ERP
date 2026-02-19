</div>
</div>

<script>
function actualizarHUD(){
fetch("../../posterior/contadores.php")
.then(res=>res.json())
.then(data=>{
if(!data) return;

document.getElementById("badgePendientes").textContent=data.Pendiente;

document.getElementById("hudEstados").innerHTML=
"Pendientes: "+data.Pendiente+"<br>"+
"Pagados: "+data.Pagado+"<br>"+
"Enviados: "+data.Enviado+"<br>"+
"Cancelados: "+data.Cancelado;
})
.catch(()=>{});
}

document.addEventListener("DOMContentLoaded",function(){
actualizarHUD();
});
function toggleDark(){
document.body.classList.toggle("dark");
localStorage.setItem("darkMode",
document.body.classList.contains("dark"));
}

document.addEventListener("DOMContentLoaded",function(){
if(localStorage.getItem("darkMode")==="true"){
document.body.classList.add("dark");
}
});

</script>

</body>
</html>

