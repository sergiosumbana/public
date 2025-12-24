<?php
header('Content-Type: application/json');
$host="localhost"; $db="cyber_gest"; $user="root"; $pass="";
try {
    $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass, [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
} catch(PDOException $e) {
    echo json_encode(['status'=>'error','msg'=>$e->getMessage()]);
    exit;
}

$id = $_GET['id'] ?? 0;

//$stmt = $conn->prepare("SELECT * FROM product WHERE idproduct = :id LIMIT 1");



$stmt = $conn->prepare("SELECT 
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
    LEFT JOIN grupo g ON p.fk_group = g.idGrupo WHERE idproduct = :id LIMIT 1");










$stmt->execute([':id'=>$id]);
$produto = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode($produto);
