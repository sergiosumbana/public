<?php
header("Content-Type: application/json; charset=UTF-8");

try {

    $pdo = new PDO(
        "mysql:host=localhost;dbname=cyber_gest;charset=utf8",
        "root",
        "",
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    $data = json_decode(file_get_contents("php://input"), true);
    $id = $data["id"] ?? null;

    if (!$id) {
        echo json_encode([
            "status" => "error",
            "msg" => "ID inválido"
        ]);
        exit;
    }

    $stmt = $pdo->prepare("DELETE FROM product WHERE idproduct = ?");
    $stmt->execute([$id]);

    echo json_encode([
        "status" => "success",
        "msg" => "Produto eliminado com sucesso"
    ]);

} catch (Exception $e) {

    echo json_encode([
        "status" => "error",
        "msg" => $e->getMessage()
    ]);
}
