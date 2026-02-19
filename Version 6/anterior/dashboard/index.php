<?php include "../layout/header.php"; ?>

<div class="card">
<h2>Evolución Mensual de Ventas (Año <?= date("Y") ?>)</h2>

<canvas id="graficaVentas" height="100"></canvas>

<?php
$ventasMes = [];
for($i=1;$i<=12;$i++){
    $ventasMes[$i] = 0;
}

$result = $conexion->query("
SELECT MONTH(fecha) mes, SUM(total) total
FROM pedidos
WHERE estado='Pagado'
AND YEAR(fecha)=YEAR(CURDATE())
GROUP BY MONTH(fecha)
");

while($row=$result->fetch_assoc()){
    $ventasMes[(int)$row['mes']] = (float)$row['total'];
}

$datos = array_values($ventasMes);
?>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('graficaVentas').getContext('2d');

const graficaVentas = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [
            "Ene","Feb","Mar","Abr","May","Jun",
            "Jul","Ago","Sep","Oct","Nov","Dic"
        ],
        datasets: [{
            label: 'Ventas (€)',
            data: <?= json_encode($datos) ?>,
            tension: 0.35,
            fill: true,
            borderColor: '#2563eb',
            backgroundColor: 'rgba(37,99,235,0.15)',
            pointBackgroundColor: '#2563eb',
            pointRadius: 5
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                min: 0,
                max: 50000,
                ticks: {
                    stepSize: 5000,
                    callback: function(value){
                        return (value/1000) + "K";
                    },
                    color: '#2563eb'   // 🔵 Letras eje Y azules
                },
                grid: {
                    color: document.body.classList.contains("dark") ? "#334155" : "#e2e8f0"
                }
            },
            x: {
                ticks: {
                    color: '#2563eb'   // 🔵 Letras eje X azules
                },
                grid: {
                    color: document.body.classList.contains("dark") ? "#334155" : "#e2e8f0"
                }
            }
        },
        plugins: {
            legend: {
                labels: {
                    color: '#2563eb'  // 🔵 Texto leyenda azul
                }
            }
        }
    }
});
</script>

</script>

</script>

<?php include "../layout/footer.php"; ?>

