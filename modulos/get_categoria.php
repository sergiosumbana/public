<?php
ini_set('display_errors', 0);
error_reporting(0);
//header("Content-Type: application/json; charset=UTF-8");


header("Content-Type: application/json; charset=UTF-8");
try {
    $pdo = new PDO("mysql:host=localhost;dbname=cyber_gest", "root", "");

    // parâmetros recebidos do JS
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $limit = 5;              // registros por página
    $offset = ($page - 1) * $limit;

    // consulta produtos
    $stmt = $pdo->prepare("SELECT * FROM grupo LIMIT :limit OFFSET :offset");
    $stmt->bindValue(":limit", $limit, PDO::PARAM_INT);
    $stmt->bindValue(":offset", $offset, PDO::PARAM_INT);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // total de registros
    $total = $pdo->query("SELECT COUNT(*) FROM grupo")->fetchColumn();

    // enviar JSON estruturado
    echo json_encode([
        "data" => $data,
        "total" => $total,
        "page" => $page,
        "limit" => $limit
    ]);
    exit;
} catch (PDOException $e) {
    echo json_encode([
        "data" => [],
        "total" => 0,
        "page" => 1,
        "limit" => 5,
        "error" => $e->getMessage()
    ]);
}
