<?php
header("Content-Type: application/json; charset=UTF-8");

try {
    $pdo = new PDO("mysql:host=localhost;dbname=cyber_gest","root","");

    $id = intval($_GET["id"]);

    $stmt = $pdo->prepare("DELETE FROM grupo WHERE idGrupo = ?");
    $stmt->execute([$id]);

    echo json_encode(["message" => "Categoria eliminada com sucesso"]);
    
} catch (Exception $e) {
    echo json_encode(["message" => "Erro ao eliminar"]);
}
