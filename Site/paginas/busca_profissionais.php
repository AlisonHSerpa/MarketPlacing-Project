<?php
include('conexao.php');

header('Content-Type: application/json');

// Obtenção dos parâmetros da requisição
$profissao = $_GET['profissao'] ?? '';
$nome = $_GET['nome'] ?? '';
$offset = (int) ($_GET['offset'] ?? 0);
$limit = (int) ($_GET['limit'] ?? 10);

// Construção da condição da consulta SQL
$condition = "WHERE 1=1";
if ($profissao === 'Psicólogo') {
    $condition .= " AND crp IS NOT NULL";
} elseif ($profissao === 'Psiquiatra') {
    $condition .= " AND crm IS NOT NULL";
}
if (!empty($nome)) {
    $condition .= " AND nome LIKE ?";
    $nome = "%$nome%";
}

// Preparação da consulta SQL
$query = "SELECT nome, crp, crm, atendimento, clinica, especialidade, telefone 
          FROM profissionais 
          $condition
          LIMIT ? OFFSET ?";

if ($stmt = $mysqli->prepare($query)) {
    if (!empty($nome)) {
        $stmt->bind_param('sii', $nome, $limit, $offset);
    } else {
        $stmt->bind_param('ii', $limit, $offset);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $profissionais = [];
    while ($row = $result->fetch_assoc()) {
        $profissionais[] = $row;
    }

    $hasMore = count($profissionais) === $limit;

    echo json_encode(['profissionais' => $profissionais, 'hasMore' => $hasMore]);

    $stmt->close();
} else {
    echo json_encode(['error' => 'Erro na preparação da consulta SQL.']);
}

$mysqli->close();
?>
