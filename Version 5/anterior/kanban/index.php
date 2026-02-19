<?php include "../layout/header.php"; ?>

<h2>Kanban Empresarial de Pedidos</h2>

<canvas id="graficaEstados" height="100"></canvas>

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
margin:10px 0;
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

.prioridad{color:red;font-weight:bold}
</style>

<div class="board">
<?php
$estados=["Pendiente","Pagado","Enviado","Cancelado"];

foreach($estados as $estado){
echo "<div class='column' data-estado='$estado'>";
echo "<h3>$estado <span class='count'>0</span></h3>";

$result=$conexion->query("
SELECT pedidos.id,total,clientes.nombre
FROM pedidos
JOIN clientes ON pedidos.id_cliente=clientes.id
WHERE estado='$estado'
");

while($row=$result->fetch_assoc()){
$prioridad = $row['total']>500 ? "<div class='prioridad'>🔥 Alta prioridad</div>" : "";

echo "
<div class='card estado-$estado'
draggable='true'
data-id='{$row['id']}'>
<b>Pedido #{$row['id']}</b><br>
Cliente: {$row['nombre']}<br>
Total: € {$row['total']}
$prioridad
</div>
";
}
echo "</div>";
}
?>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
let ctx=document.getElementById("graficaEstados").getContext("2d");

function contar(){
return [
document.querySelector("[data-estado='Pendiente']").querySelectorAll(".card").length,
document.querySelector("[data-estado='Pagado']").querySelectorAll(".card").length,
document.querySelector("[data-estado='Enviado']").querySelectorAll(".card").length,
document.querySelector("[data-estado='Cancelado']").querySelectorAll(".card").length
];
}

let chart=new Chart(ctx,{
type:'bar',
data:{
labels:['Pendiente','Pagado','Enviado','Cancelado'],
datasets:[{
label:'Pedidos',
data:contar(),
backgroundColor:['orange','blue','green','red']
}]
}
});

function actualizarGrafica(){
chart.data.datasets[0].data=contar();
chart.update();
}

function actualizarContadores(){
document.querySelectorAll(".column").forEach(col=>{
col.querySelector(".count").textContent=col.querySelectorAll(".card").length;
});
}
actualizarContadores();

let cards=document.querySelectorAll(".card");
let columns=document.querySelectorAll(".column");

cards.forEach(card=>{
card.addEventListener("dragstart",()=>card.classList.add("dragging"));
card.addEventListener("dragend",()=>{
card.classList.remove("dragging");
actualizarContadores();
actualizarGrafica();
});
});

columns.forEach(column=>{
column.addEventListener("dragover",e=>{
e.preventDefault();
const dragging=document.querySelector(".dragging");
column.appendChild(dragging);
});

column.addEventListener("drop",()=>{
const card=document.querySelector(".dragging");
const id=card.dataset.id;
const estado=column.dataset.estado;

fetch("../../posterior/actualizar_estado.php",{
method:"POST",
headers:{"Content-Type":"application/json"},
body:JSON.stringify({id:id,estado:estado})
});

card.className="card estado-"+estado;

if(estado==="Enviado"){
alert("📦 Pedido enviado");
}

actualizarContadores();
actualizarGrafica();
});
});
</script>

<?php include "../layout/footer.php"; ?>

