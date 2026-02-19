<?php
include "config.php";

function generarCodigo($conexion){
    do{
        $codigo = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"),0,10);
        $check = $conexion->prepare("SELECT id FROM pedidos WHERE codigo=?");
        $check->bind_param("s",$codigo);
        $check->execute();
        $result = $check->get_result();
    }while($result->num_rows > 0);
    return $codigo;
}

# CREAR PEDIDO COMPLETO
if(isset($_POST['crear'])){

    $id_cliente = $_POST['id_cliente'];
    $id_producto = $_POST['id_producto'];
    $cantidad = $_POST['cantidad'];

    $conexion->begin_transaction();

    try{

        # Obtener producto
        $producto = $conexion->prepare("SELECT precio, stock FROM productos WHERE id=?");
        $producto->bind_param("i",$id_producto);
        $producto->execute();
        $result = $producto->get_result()->fetch_assoc();

        if(!$result){
            throw new Exception("Producto no existe");
        }

        if($result['stock'] < $cantidad){
            throw new Exception("Stock insuficiente");
        }

        $precio = $result['precio'];
        $total = $precio * $cantidad;

        $codigo = generarCodigo($conexion);

        # Insertar pedido
        $stmt = $conexion->prepare("
        INSERT INTO pedidos(codigo,id_cliente,fecha,estado,total)
        VALUES(?, ?, NOW(), 'Pendiente', ?)
        ");
        $stmt->bind_param("sid",$codigo,$id_cliente,$total);
        $stmt->execute();

        $id_pedido = $stmt->insert_id;

        # Insertar linea
        $linea = $conexion->prepare("
        INSERT INTO lineas_pedido(id_pedido,id_producto,cantidad,precio_unitario)
        VALUES(?,?,?,?)
        ");
        $linea->bind_param("iiid",$id_pedido,$id_producto,$cantidad,$precio);
        $linea->execute();

        # Actualizar stock
        $update = $conexion->prepare("
        UPDATE productos SET stock = stock - ? WHERE id=?
        ");
        $update->bind_param("ii",$cantidad,$id_producto);
        $update->execute();

        $conexion->commit();

        $_SESSION['toast']="Pedido creado con código: $codigo";
        header("Location: ../anterior/pedidos/");
        exit;

    }catch(Exception $e){
        $conexion->rollback();
        $_SESSION['toast']="Error: ".$e->getMessage();
        header("Location: ../anterior/pedidos/");
        exit;
    }
}

# CAMBIAR ESTADO
if(isset($_POST['cambiar_estado'])){

    $codigo = $_POST['codigo'];
    $estado = $_POST['estado'];

    $stmt=$conexion->prepare("UPDATE pedidos SET estado=? WHERE codigo=?");
    $stmt->bind_param("ss",$estado,$codigo);
    $stmt->execute();

    $_SESSION['toast']="Estado actualizado correctamente";
    header("Location: ../anterior/pedidos/");
    exit;
}
?>

