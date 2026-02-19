<?php
include "config.php";

$data = json_decode(file_get_contents("php://input"), true);

$stmt = $conexion->prepare("SELECT * FROM usuarios WHERE usuario=? AND password=MD5(?)");
$stmt->bind_param("ss",$data['usuario'],$data['password']);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows>0){
    $user=$result->fetch_assoc();
    $_SESSION['usuario']=$user['usuario'];
    $_SESSION['rol']=$user['rol'];
    echo json_encode(["success"=>true]);
}else{
    echo json_encode(["success"=>false]);
}
?>

