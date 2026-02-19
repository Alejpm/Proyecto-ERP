<?php include "../layout/header.php"; ?>

<style>
.board{display:flex;gap:20px;padding:20px}
.column{
flex:1;
background:#f1f5f9;
padding:15px;
border-radius:10px;
min-height:500px;
transition:background 0.3s;
}
.column h3{
text-align:center;
display:flex;
justify-content:space-between;
align-items:center;
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
padding:12px;
margin:12px 0;
border-radius:8px;
cursor:grab;
box-shadow:0 3px 8px rgba(0,0,0,0.1);
transition:transform 0.2s, box-shadow 0.2s;
}

.card:hover{
transform:scale(1.02);
box-shadow:0 6px 12px rgba(0,0,0,0.2);
}

.dragging{opacity:0.5}
.estado-Pendiente{border-left:6px solid orange}
.estado-Pagado{border-left:6px solid blue}
.estado-Enviado{border-left:6px solid green}
.estado-Cancelado{border-left:6px solid red}

.modal{
display:none;
position:fixed;
top:0;left:0;
width:100%;height:100%;
background:rgba(0,0,0,0.5);
justify-content:center;
align-items:center;
}
.modal-content{
background:white;
padding:20px;
border-radius:10px;
width:300px;
}
</style>

<h2>Kanban Avanzado Pedidos</h2>

<input type="text" id="filtro" placeholder="Filtrar por cliente">

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
echo "
<div class='card estado-$estado' draggable='true'
data-id='{$row['id']}'
data-cliente='{$row['nombre']}'
data-total='{$row['total']}'>
<b>Pedido #{$row['id']}</b><br>
Cliente: {$row['nombre']}<br>
€ {$row['total']}
</div>
";
}

echo "</div>";
}
?>
</div>

<div class="modal" id="modal">
<div class="modal-content">
<h3>Detalle Pedido</h3>
<div id="detalle"></div>
<button onclick="cerrarModal()">Cerrar</button>
</div>
</div>

<script>

function actualizarContadores(){
document.querySelectorAll(".column").forEach(col=>{
let count=col.querySelectorAll(".card").length;
col.querySelector(".count").textContent=count;
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
});
card.addEventListener("click",()=>{
document.getElementById("detalle").innerHTML=
"Cliente: "+card.dataset.cliente+"<br>Total: €"+card.dataset.total;
document.getElementById("modal").style.display="flex";
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
const nuevoEstado=column.dataset.estado;

fetch("../../posterior/actualizar_estado.php",{
method:"POST",
headers:{"Content-Type":"application/json"},
body:JSON.stringify({id:id,estado:nuevoEstado})
});

card.className="card estado-"+nuevoEstado;
actualizarContadores();
});
});

document.getElementById("filtro").addEventListener("input",function(){
let texto=this.value.toLowerCase();
document.querySelectorAll(".card").forEach(card=>{
let cliente=card.dataset.cliente.toLowerCase();
card.style.display=cliente.includes(texto)?"block":"none";
});
});

function cerrarModal(){
document.getElementById("modal").style.display="none";
}

</script>

<?php include "../layout/footer.php"; ?>

