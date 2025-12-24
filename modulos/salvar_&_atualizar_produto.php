<?php

header('Content-Type: application/json');

// =======================
// CONFIGURAÇÃO DO BANCO
// =======================
$host = "localhost";
$db   = "cyber_gest";
$user = "root";
$pass = "";

try {
    $conn = new PDO(
        "mysql:host=$host;dbname=$db;charset=utf8",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'msg' => 'Erro BD: ' . $e->getMessage()]);
    exit;
}

// =======================
// RECEBER DADOS DO FORM
// =======================
$action = $_POST['action'] ?? 'create';
$productId = $_POST['product_id'] ?? null;

// Dados do produto
$descricao = $_POST['Descricao'] ?? '';
$product_name = $_POST['product_name'] ?? '';
$barcod    = $_POST['product-barcod'] ?? '';
$unidade   = $_POST['product-units'] ?? '';
$fk_group  = $_POST['fk_group'] ?? null;

// Custos
$preco_custo_com_imposto = floatval($_POST['preco-custo-com-imposto'] ?? 0);
$imposto_custo           = floatval($_POST['imposto-custo'] ?? 0);
$preco_custo_sem_imposto = floatval($_POST['preco-custo-sem-imposto'] ?? 0);

// Venda
$preco_venda_com_imposto = floatval($_POST['preco-venda-com-imposto-input'] ?? 0);
$preco_venda_sem_imposto = floatval($_POST['preco-venda-sem-imposto-input'] ?? 0);

// Extras
$estado = 'Ativo';
$data   = date('Y-m-d H:i:s');

try {

    // =======================
    // ATUALIZAR PRODUTO
    // =======================
    if ($action === 'update' && !empty($productId)) {

        $sql = "UPDATE product SET
            Descricao = :descricao,
            Produto = :product_name,
            Barcod = :barcod,
            unidade_medida = :unidade,
            preco_custo_total = :preco_custo_com,
            imposto_custo = :imposto_custo,
            preco_custo_sem_imposto = :preco_custo_sem,
            preco_venda_total = :preco_venda_com,
            venda_sem_imposto = :preco_venda_sem,
            fk_group = :fk_group,
            estado = :estado,
            data = :data
        WHERE idproduct = :id";

        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':descricao'        => $descricao,
            ':product_name'     => $product_name,
            ':barcod'           => $barcod,
            ':unidade'          => $unidade,
            ':preco_custo_com'  => $preco_custo_com_imposto,
            ':imposto_custo'    => $imposto_custo,
            ':preco_custo_sem'  => $preco_custo_sem_imposto,
            ':preco_venda_com'  => $preco_venda_com_imposto,
            ':preco_venda_sem'  => $preco_venda_sem_imposto,
            ':fk_group'         => $fk_group,
            ':estado'           => $estado,
            ':data'             => $data,
            ':id'               => $productId
        ]);

        echo json_encode(['status' => 'success', 'msg' => 'Produto atualizado com sucesso']);
        exit;
    }

    // =======================
    // CRIAR PRODUTO
    // =======================
    $sql = "INSERT INTO product (
        Descricao,
        Produto,
        Barcod,
        unidade_medida,
        preco_custo_total,
        imposto_custo,
        preco_custo_sem_imposto,
        preco_venda_total,
        venda_sem_imposto,
        fk_group,
        estado,
        data
    ) VALUES (
        :descricao,
        :product_name,
        :barcod,
        :unidade,
        :preco_custo_com,
        :imposto_custo,
        :preco_custo_sem,
        :preco_venda_com,
        :preco_venda_sem,
        :fk_group,
        :estado,
        :data
    )";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':descricao'        => $descricao,
        ':product_name'     => $product_name,
        ':barcod'           => $barcod,
        ':unidade'          => $unidade,
        ':preco_custo_com'  => $preco_custo_com_imposto,
        ':imposto_custo'    => $imposto_custo,
        ':preco_custo_sem'  => $preco_custo_sem_imposto,
        ':preco_venda_com'  => $preco_venda_com_imposto,
        ':preco_venda_sem'  => $preco_venda_sem_imposto,
        ':fk_group'         => $fk_group,
        ':estado'           => $estado,
        ':data'             => $data
    ]);

    echo json_encode(['status' => 'success', 'msg' => 'Produto cadastrado com sucesso']);
    exit;
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'msg' => $e->getMessage()]);
    exit;
}
