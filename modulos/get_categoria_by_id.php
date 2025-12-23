<?php
header("Content-Type: application/json; charset=UTF-8");

try {
    $pdo = new PDO("mysql:host=localhost;dbname=cyber_gest","root","");

    $id = intval($_GET["id"]);

    $stmt = $pdo->prepare("SELECT * FROM grupo WHERE idGrupo = ?");
    $stmt->execute([$id]);

    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    echo json_encode([
        "success" => true,
        "data" => $data
    ]);

} catch(Exception $e){
    echo json_encode([
        "success" => false,
        "error" => $e->getMessage()
    ]);
}
