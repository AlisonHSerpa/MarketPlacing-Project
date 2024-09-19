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

function buscarBanidos($mysqli) {
    $queryBanidos = "SELECT id, nome, email, cpf, cargo FROM banidos";
    return $mysqli->query($queryBanidos);
}

if (isset($_POST['excluir'])) {
    $id = $_POST['id'] ?? null;
    $tabela = $_POST['tabela'];

    if ($id && $tabela === 'usuarios') {
        $query = "DELETE FROM usuarios WHERE id = $id";
        $mysqli->query($query);
    } else if ($id && $tabela === 'profissionais') {
        $query = "DELETE FROM profissionais WHERE id_profissional = $id";
        $mysqli->query($query);
    }
}

// Função para banir usuários ou profissionais
if (isset($_POST['banir'])) {
    $id = $_POST['id'] ?? null;
    $tabela = $_POST['tabela'];
    $cargo = $tabela === 'usuarios' ? 'usuário' : 'profissional';

    if ($id) {
        $query = "INSERT INTO banidos (id, nome, email, cpf, cargo) 
                  SELECT id, nome_usuario, email, cpf, '$cargo' FROM $tabela WHERE id = $id";
        $mysqli->query($query);

        // Exclui o banido das tabelas originais
        if ($tabela === 'usuarios') {
            $deleteQuery = "DELETE FROM usuarios WHERE id = $id";
        } else if ($tabela === 'profissionais') {
            $deleteQuery = "DELETE FROM profissionais WHERE id_profissional = $id";
        }

        $mysqli->query($deleteQuery);
    }
}

if (isset($_POST['desbanir'])) {
    $id = $_POST['id'];
    $cargo = $_POST['cargo'];

    // Buscar o banido antes de excluir
    $queryBanido = "SELECT * FROM banidos WHERE id = $id";
    $resultBanido = $mysqli->query($queryBanido);
    $banido = $resultBanido->fetch_assoc();
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