<?php
session_start();
include('conexao.php');

if (isset($_SESSION['id']) && isset($_SESSION['tipo'])) {
    $userId = $_SESSION['id'];
    $tipoUsuario = $_SESSION['tipo'];

    // Inicializa a query de atualização de acordo com o tipo de usuário
    if ($tipoUsuario === 'usuario') {
        $sql_code = "UPDATE usuarios SET ";
    } else if ($tipoUsuario === 'profissional') {
        $sql_code = "UPDATE profissionais SET ";
    } else {
        echo "Tipo de usuário inválido.";
        exit();
    }

    $updates = [];

    // Adiciona os campos à query de atualização se eles foram preenchidos
    if (!empty($_POST['nome'])) {
        $nome = $mysqli->real_escape_string($_POST['nome']);
        if ($tipoUsuario === 'usuario') {
            $updates[] = "nome_usuario = '$nome'";
        } else {
            $updates[] = "nome = '$nome'";
        }
    }

    if (!empty($_POST['email'])) {
        $email = $mysqli->real_escape_string($_POST['email']);
        
        // Verifica se o email pertence a outro usuário
        if ($tipoUsuario === 'usuario') {
            $sql_verifica = "SELECT * FROM usuarios WHERE email = '$email' AND id != '$userId'";
        } else {
            $sql_verifica = "SELECT * FROM profissionais WHERE email = '$email' AND id_profissional != '$userId'";
        }

        $sql_query = $mysqli->query($sql_verifica);

        if ($sql_query->num_rows > 0) {
            echo "Email já cadastrado por outro usuário!";
            exit();
        }
        
        $updates[] = "email = '$email'";
    }

    if (!empty($_POST['senha'])) {
        $senha = password_hash($mysqli->real_escape_string($_POST['senha']), PASSWORD_DEFAULT);
        $updates[] = "senha_hash = '$senha'";
    }

    if (!empty($_POST['telefone'])) {
        $telefone = $mysqli->real_escape_string($_POST['telefone']);
        $updates[] = "telefone = '$telefone'";
    }

    if ($tipoUsuario === 'profissional') {
        if (!empty($_POST['atendimento'])) {
            $atendimento = $mysqli->real_escape_string($_POST['atendimento']);
            $updates[] = "atendimento = '$atendimento'";
        }

        if (!empty($_POST['especialidade'])) {
            $especialidade = $mysqli->real_escape_string($_POST['especialidade']);
            $updates[] = "especialidade = '$especialidade'";
        }

        if (!empty($_POST['crp'])) {
            $crp = $mysqli->real_escape_string($_POST['crp']);
            $updates[] = "crp = '$crp'";
        }

        if (!empty($_POST['crm'])) {
            $crm = $mysqli->real_escape_string($_POST['crm']);
            $updates[] = "crm = '$crm'";
        }
    }

    // Verifica se há algo para atualizar
    if (!empty($updates)) {
        if ($tipoUsuario === 'usuario') {
            $sql_code .= implode(', ', $updates) . " WHERE id = '$userId'";
        } else if ($tipoUsuario === 'profissional') {
            $sql_code .= implode(', ', $updates) . " WHERE id_profissional = '$userId'";
        }

        $sql_query = $mysqli->query($sql_code);

        if ($sql_query) {
            echo "Dados atualizados com sucesso!";
            header("Location: painel.php"); // Redireciona para a página de perfil após a atualização
            exit();
        } else {
            echo "Falha ao atualizar dados: " . $mysqli->error;
        }
    } else {
        echo "Nenhum dado para atualizar!";
    }

} else {
    echo "ID ou tipo de usuário não fornecido!";
}
?>
