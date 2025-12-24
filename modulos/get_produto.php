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
                p.Produto   LIKE :search OR
                p.Descricao LIKE :search OR
                p.Barcod    LIKE :search OR
                g.Tipo      LIKE :search
        ";
        $params[':search'] = "%$search%";
    }

    // Query para obter os dados da página
    $sql = "
        SELECT 
            p.idproduct,
            p.Produto,
            p.Descricao,
            p.Barcod,
            p.unidade_medida,
            p.preco_custo_total,
            p.imposto_custo,
            p.preco_custo_sem_imposto,
            p.preco_venda_total,
            p.venda_sem_imposto,
            p.desconto,
            p.estado,
            p.data,
            g.Tipo AS grupo
        FROM product p
        LEFT JOIN grupo g ON p.fk_group = g.idGrupo
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
        FROM product p
        LEFT JOIN grupo g ON p.fk_group = g.idGrupo
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
