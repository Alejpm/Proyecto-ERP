<?php
include "config.php";

require_once('dompdf/autoload.inc.php');
use Dompdf\Dompdf;

$codigo=$_GET['codigo'];

$pedido=$conexion->query("
SELECT pedidos.codigo,total,clientes.nombre
FROM pedidos
JOIN clientes ON pedidos.id_cliente=clientes.id
WHERE codigo='$codigo'
")->fetch_assoc();

$html="
<h1>Factura Pedido {$pedido['codigo']}</h1>
<p>Cliente: {$pedido['nombre']}</p>
<p>Total: € {$pedido['total']}</p>
<p>Fecha: ".date("Y-m-d H:i:s")."</p>
";

$dompdf=new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4','portrait');
$dompdf->render();
$dompdf->stream("factura_{$pedido['codigo']}.pdf");
?>

