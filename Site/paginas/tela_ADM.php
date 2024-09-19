<?php
include 'conexao.php';

// Função para buscar todos os usuários e profissionais
function buscarUsuariosProfissionais($mysqli) {
    $queryUsuarios = "SELECT id, nome_usuario, email, cpf, telefone FROM usuarios";
    $resultUsuarios = $mysqli->query($queryUsuarios);

    $queryProfissionais = "SELECT id_profissional, nome, email, crp, crm, atendimento, telefone, clinica FROM profissionais";
    $resultProfissionais = $mysqli->query($queryProfissionais);

    return [$resultUsuarios, $resultProfissionais];
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

</body>

</html>