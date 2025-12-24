<?php
header("Content-Type: application/json");

// Conecta no banco (MySQL PDO exemplo)
$pdo = new PDO("mysql:host=localhost;dbname=cyber_gest","root","");

// Consulta
$stmt = $pdo->prepare("SELECT idGrupo, Tipo FROM grupo ORDER BY Tipo");
$stmt->execute();

// Retorna array de objetos JSON
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
