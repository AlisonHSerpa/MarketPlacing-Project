<?php
include"conexao.php";

if(isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['senha']) && isset($_POST['cpf']) && isset($_POST['telefone'])) {
    $nome = $mysqli->real_escape_string($_POST['nome']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $senha = password_hash($mysqli->real_escape_string(($_POST['senha'])), PASSWORD_DEFAULT);
    // Hash da senha
    $cpf = $mysqli->real_escape_string($_POST['cpf']);
    $telefone = $mysqli->real_escape_string($_POST['telefone']);

    // Verifica se o email ou CPF já estão cadastrados 
    $sql_verifica = "SELECT * FROM usuarios WHERE email = '$email' OR cpf = '$cpf'";
    $sql_query = $mysqli->query($sql_verifica);

    if($sql_query->num_rows > 0) {
        echo "Email ou CPF já cadastrado!";
    } else {
        // Insere os dados no banco de dados
        $sql_code = "INSERT INTO usuarios (nome_usuario, email, senha_hash, cpf, telefone) VALUES ('$nome', '$email', '$senha', '$cpf', '$telefone')";
        $sql_query = $mysqli->query($sql_code);

        if($sql_query) {
            echo "Usuárioo cadastrado com sucesso!";
            header("Location: login.php"); // Redireciona para a página de login após o cadastro
            exit();
        } else {
            echo "Falha ao cadastrar usuário: " . $mysqli->error;
        }
    }
} else {
    echo "Preencha todos os campos!";
}