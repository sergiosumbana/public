<?php
header("Content-Type: application/json; charset=UTF-8");

try {
    $pdo = new PDO(
        "mysql:host=localhost;dbname=cyber_gest;charset=utf8",
        "root",
        "",
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    $page   = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $limit  = 5;
    $offset = ($page - 1) * $limit;

    $search = $_GET['search'] ?? "";
    $searchSql = "";
    $params = [];

    if (!empty($search)) {
        $searchSql = "
            WHERE 
                idFornecedor    LIKE :search OR
                Nome   LIKE :search OR
                Contacto LIKE :search
              ";
        $params[':search'] = "%$search%";
    }

    // Query para obter os dados da página
    $sql = "
        SELECT * FROM fornecedor
        $searchSql
        LIMIT :limit OFFSET :offset
    ";
    $stmt = $pdo->prepare($sql);

    foreach ($params as $k => $v) {
        $stmt->bindValue($k, $v, PDO::PARAM_STR);
    }

    $stmt->bindValue(":limit", $limit, PDO::PARAM_INT);
    $stmt->bindValue(":offset", $offset, PDO::PARAM_INT);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Query para obter total de resultados filtrados
    $sqlTotal = "
        SELECT COUNT(*) 
        FROM fornecedor
        $searchSql
    ";
    $stmtTotal = $pdo->prepare($sqlTotal);
    foreach ($params as $k => $v) {
        $stmtTotal->bindValue($k, $v, PDO::PARAM_STR);
    }
    $stmtTotal->execute();
    $total = $stmtTotal->fetchColumn();

    echo json_encode([
        "data"  => $data,
        "total" => (int)$total, // total de itens filtrados
        "page"  => $page,
        "limit" => $limit
    ]);
} catch (PDOException $e) {
    echo json_encode([
        "data" => [],
        "total" => 0,
        "page" => 1,
        "limit" => 5,
        "error" => $e->getMessage()
    ]);
}
