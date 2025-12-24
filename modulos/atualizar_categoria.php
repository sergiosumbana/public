<?php
header("Content-Type: application/json; charset=UTF-8");

try {

    $pdo = new PDO("mysql:host=localhost;dbname=cyber_gest","root","");

    $id   = $_POST["id"] ?? null;
    $tipo = $_POST["tipo"] ?? null;
    $estado = $_POST["estado"] ?? null;
    $descricao = $_POST["descricao"] ?? null;

    if(!$id){
        echo json_encode(["success" => false, "msg" => "ID inválido"]);
        exit;
    }

    if(!$tipo){
        echo json_encode(["success" => false, "msg" => "tipo obrigatório"]);
        exit;
    }

    $stmt = $pdo->prepare("UPDATE grupo SET Tipo=?, Estado=?, Descricao=?  WHERE idGrupo=?");
    $stmt->execute([$tipo, $estado, $descricao, $id]);

    echo json_encode([
        "success" => true,
        "msg" => "Categoria atualizada com sucesso!"
    ]);

}catch(Exception $e){

    echo json_encode([
        "success"=>false,
        "msg"=>$e->getMessage()
    ]);
}

