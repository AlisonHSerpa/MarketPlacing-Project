<?php
session_start();
include('conexao.php');

if (isset($_SESSION['id'])) {
    $userId = $_SESSION['id'];

    // Inicia a query de atualização
    $sql_code = "UPDATE usuarios SET ";
    $updates = [];

    // Adiciona os campos à query de atualização se eles foram preenchidos
    if (!empty($_POST['nome'])) {
        $nome = $mysqli->real_escape_string($_POST['nome']);
        $updates[] = "nome_usuario = '$nome'";
    }
    
    if (!empty($_POST['email'])) {
        $email = $mysqli->real_escape_string($_POST['email']);
        
        // Verifica se o email pertence a outro usuário
        $sql_verifica = "SELECT * FROM usuarios WHERE email = '$email' AND id != '$userId'";
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

    // Verifica se há algo para atualizar
    if (!empty($updates)) {
        $sql_code .= implode(', ', $updates) . " WHERE id = '$userId'";
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
    echo "ID do usuário não fornecido!";
}
?>
