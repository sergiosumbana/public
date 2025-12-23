<?php
header("Content-Type: application/json; charset=UTF-8");

try {

    $pdo = new PDO("mysql:host=localhost;dbname=cyber_gest","root","");

    // Dados recebidos do fetch JS
    $tipo = $_POST["tipo"] ?? null;
    $estado = $_POST["estado"] ?? null;
    $descricao = $_POST["descricao"] ?? null;

    if(!$tipo){
        echo json_encode(["success" => false, "msg" => "Tipo obrigatório"]);
        exit;
    }
    // Data atual
    $data = date("Y-m-d H:i:s");

    $stmt = $pdo->prepare("INSERT INTO grupo (Tipo, Estado, Descricao, Data) VALUES (?,?,?, ?)");
    $stmt->execute([$tipo, $estado, $descricao, $data]);

    echo json_encode(["success" => true, "msg" => "Categoria salva com sucesso"]);

}catch(Exception $e){

    echo json_encode([
        "success"=>false,
        "msg"=>$e->getMessage()
    ]);
}
