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
$action        = $_POST['action'] ?? 'create';
$fornecedorId  = $_POST['idFornecedor'] ?? null;

// Dados do fornecedor
$nome     = $_POST['Nome'] ?? '';
$morada   = $_POST['Morada'] ?? '';
$contacto = $_POST['Contacto'] ?? '';
$email    = $_POST['Email'] ?? '';
$nuit     = $_POST['Nuit'] ?? '';
$estado   = $_POST['Estado'] ?? 'Ativo';
$data     = date('Y-m-d H:i:s');

try {

    // =======================
    // ATUALIZAR FORNECEDOR
    // =======================
    if ($action === 'update' && !empty($fornecedorId)) {

        $sql = "UPDATE fornecedor SET
            Nome     = :nome,
            Morada   = :morada,
            Contacto = :contacto,
            Email    = :email,
            Nuit     = :nuit,
            Estado   = :estado,
            Data     = :data
        WHERE idFornecedor = :id";

        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':nome'     => $nome,
            ':morada'   => $morada,
            ':contacto' => $contacto,
            ':email'    => $email,
            ':nuit'     => $nuit,
            ':estado'   => $estado,
            ':data'     => $data,
            ':id'       => $fornecedorId
        ]);

        echo json_encode(['status' => 'success', 'msg' => 'Fornecedor atualizado com sucesso']);
        exit;
    }

    // =======================
    // CRIAR FORNECEDOR
    // =======================
    $sql = "INSERT INTO fornecedor (
        Nome,
        Morada,
        Contacto,
        Email,
        Nuit,
        Estado,
        Data
    ) VALUES (
        :nome,
        :morada,
        :contacto,
        :email,
        :nuit,
        :estado,
        :data
    )";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':nome'     => $nome,
        ':morada'   => $morada,
        ':contacto' => $contacto,
        ':email'    => $email,
        ':nuit'     => $nuit,
        ':estado'   => $estado,
        ':data'     => $data
    ]);

    echo json_encode(['status' => 'success', 'msg' => 'Fornecedor cadastrado com sucesso']);
    exit;

} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'msg' => $e->getMessage()]);
    exit;
}