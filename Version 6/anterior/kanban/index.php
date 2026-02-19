<?php include "../layout/header.php"; ?>

<h2>Kanban de Pedidos</h2>

<style>
.board{display:flex;gap:20px;margin-top:20px}
.column{
flex:1;
background:#f1f5f9;
padding:15px;
border-radius:10px;
min-height:400px;
}
.column h3{
display:flex;
justify-content:space-between;
}
.count{
background:#1e293b;
color:white;
padding:2px 8px;
border-radius:12px;
font-size:12px;
}
.card{
background:white;
padding:10px;
margin-bottom:10px;
border-radius:8px;
cursor:grab;
box-shadow:0 3px 6px rgba(0,0,0,0.1);
transition:0.2s;
}
.card:hover{transform:scale(1.03)}
.dragging{opacity:0.5}

.estado-Pendiente{border-left:6px solid orange}
.estado-Pagado{border-left:6px solid blue}
.estado-Enviado{border-left:6px solid green}
.estado-Cancelado{border-left:6px solid red}
</style>

<div class="board">

<?php
$estados=["Pendiente","Pagado","Enviado","Cancelado"];

foreach($estados as $estado){

echo "<div class='column' data-estado='$estado'>";
echo "<h3>$estado <span class='count'>0</span></h3>";

$result=$conexion->query("
SELECT codigo,total 
FROM pedidos
WHERE estado='$estado'
");

while($row=$result->fetch_assoc()){

echo "
<div class='card estado-$estado'
draggable='true'
data-codigo='{$row['codigo']}'>
<b>{$row['codigo']}</b><br>
Total: € {$row['total']}
</div>
";
}

echo "</div>";
}
?>

</div>

<script>

function actualizarContadores(){
document.querySelectorAll(".column").forEach(col=>{
col.querySelector(".count").textContent =
col.querySelectorAll(".card").length;
});
}

actualizarContadores();

let cards=document.querySelectorAll(".card");
let columns=document.querySelectorAll(".column");

cards.forEach(card=>{
card.addEventListener("dragstart",()=>{
card.classList.add("dragging");
});
card.addEventListener("dragend",()=>{
card.classList.remove("dragging");
actualizarContadores();
});
});

columns.forEach(column=>{
column.addEventListener("dragover",e=>{
e.preventDefault();
const dragging=document.querySelector(".dragging");
if(dragging){
column.appendChild(dragging);
}
});

column.addEventListener("drop",()=>{
const card=document.querySelector(".dragging");
if(!card) return;

const codigo = card.dataset.codigo;
const nuevoEstado = column.dataset.estado;

fetch("../../posterior/actualizar_estado.php",{
method:"POST",
headers:{
"Content-Type":"application/json"
},
body:JSON.stringify({
codigo:codigo,
estado:nuevoEstado
})
})
.then(response=>response.json())
.then(data=>{
console.log(data);

if(data.success){
actualizarHUD();
}else{
alert("Error al actualizar estado");
}
})
.catch(err=>{
console.error(err);
alert("Error conexión");
});

card.className="card estado-"+nuevoEstado;
actualizarContadores();
});
});

</script>

<?php include "../layout/footer.php"; ?>

