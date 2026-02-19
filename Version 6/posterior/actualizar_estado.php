<?php
include "config.php";

header("Content-Type: application/json");

// Leer datos JSON enviados desde Kanban
$data = json_decode(file_get_contents("php://input"), true);

if(!$data || !isset($data['codigo']) || !isset($data['estado'])){
    echo json_encode(["success"=>false,"error"=>"Datos inválidos"]);
    exit;
}

$codigo = $data['codigo'];
$nuevoEstado = $data['estado'];

$conexion->begin_transaction();

try{

    // 1️⃣ Obtener estado actual
    $stmt = $conexion->prepare("SELECT estado FROM pedidos WHERE codigo=?");
    $stmt->bind_param("s",$codigo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if($resultado->num_rows == 0){
        throw new Exception("Pedido no encontrado");
    }

    $pedido = $resultado->fetch_assoc();
    $estadoAnterior = $pedido['estado'];

    // 2️⃣ Actualizar estado
    $update = $conexion->prepare("UPDATE pedidos SET estado=? WHERE codigo=?");
    $update->bind_param("ss",$nuevoEstado,$codigo);
    $update->execute();

    // 3️⃣ Guardar historial
    $hist = $conexion->prepare("
        INSERT INTO historial_pedidos(codigo,estado_anterior,estado_nuevo,fecha)
        VALUES(?,?,?,NOW())
    ");
    $hist->bind_param("sss",$codigo,$estadoAnterior,$nuevoEstado);
    $hist->execute();

    // 4️⃣ Si pasa a Pagado → generar factura PDF
    if($nuevoEstado == "Pagado"){
        file_get_contents("http://localhost/erp_pro/posterior/generar_factura.php?codigo=".$codigo);
    }

    $conexion->commit();

    echo json_encode(["success"=>true]);

}catch(Exception $e){

    $conexion->rollback();

    echo json_encode([
        "success"=>false,
        "error"=>$e->getMessage()
    ]);
}
?>

