<?php
include('conexao.php');

// Verificar se todos os campos obrigatórios foram preenchidos
if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['senha']) && isset($_POST['cpf']) && isset($_POST['telefone'])) {

    // Escapar os dados enviados pelo formulário
    $nome = $mysqli->real_escape_string($_POST['nome']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $senha = password_hash($mysqli->real_escape_string($_POST['senha']), PASSWORD_DEFAULT); // Hash da senha
    $cpf = $mysqli->real_escape_string($_POST['cpf']);
    $telefone = $mysqli->real_escape_string($_POST['telefone']);
    $tipo_cadastro = $_POST['tipo_cadastro'];

    // Verificar se o CPF já está cadastrado em 'usuarios' ou 'profissionais'
    $sql_verifica_cpf_usuarios = "SELECT * FROM usuarios WHERE cpf = '$cpf'";
    $sql_verifica_cpf_profissionais = "SELECT * FROM profissionais WHERE cpf = '$cpf'";
    
    $sql_verifica_result_cpf_usuarios = $mysqli->query($sql_verifica_cpf_usuarios);
    $sql_verifica_result_cpf_profissionais = $mysqli->query($sql_verifica_cpf_profissionais);

    if ($sql_verifica_result_cpf_usuarios->num_rows > 0 || $sql_verifica_result_cpf_profissionais->num_rows > 0) {
        // Se o CPF já existe em qualquer uma das tabelas, exibe uma mensagem de erro
        echo "Erro: O CPF já está cadastrado!";
    } else {
        // Verificar se o email já está cadastrado
        $sql_verifica_email = "SELECT * FROM usuarios WHERE email = '$email'";
        $sql_verifica_result_email = $mysqli->query($sql_verifica_email);

        if ($sql_verifica_result_email->num_rows > 0) {
            // Se o email já existe, exibe uma mensagem de erro
            echo "Erro: O email já está cadastrado!";
        } else {
            // Continuar com o processo de cadastro
            if ($tipo_cadastro === 'usuario') {
                // Cadastro de usuário comum
                $sql_code = "INSERT INTO usuarios (nome_usuario, email, senha_hash, cpf, telefone) 
                             VALUES ('$nome', '$email', '$senha', '$cpf', '$telefone')";
                $sql_query = $mysqli->query($sql_code);
            } elseif ($tipo_cadastro === 'profissional') {
                // Cadastro de profissional
                $numero_registro = $mysqli->real_escape_string($_POST['numero_registro']);
                $tipo_registro = $_POST['tipo_registro']; // Pode ser 'CRP' ou 'CRM'
                $atendimento = $mysqli->real_escape_string($_POST['atendimento']);
                $clinica = isset($_POST['clinica']) ? $mysqli->real_escape_string($_POST['clinica']) : null;
                $especialidade = isset($_POST['especialidade']) ? $mysqli->real_escape_string($_POST['especialidade']) : null;

                // Insere os dados na tabela 'profissionais' com base no tipo de registro
                if ($tipo_registro === 'CRP') {
                    $sql_code = "INSERT INTO profissionais (nome, crp, atendimento, clinica, especialidade, telefone, email, senha_hash, cpf)
                                 VALUES ('$nome', '$numero_registro', '$atendimento', '$clinica', '$especialidade', '$telefone', '$email', '$senha', '$cpf')";
                } else {
                    $sql_code = "INSERT INTO profissionais (nome, crm, atendimento, clinica, especialidade, telefone, email, senha_hash, cpf)
                                 VALUES ('$nome', '$numero_registro', '$atendimento', '$clinica', '$especialidade', '$telefone', '$email', '$senha', '$cpf')";
                }
                $sql_query = $mysqli->query($sql_code);
            }

            // Verifica se a consulta de inserção foi bem-sucedida
            if ($sql_query) {
                echo "Cadastro realizado com sucesso!";
                header("Location: login.php"); // Redireciona para a página de login após o cadastro
                exit();
            } else {
                echo "Falha ao cadastrar usuário: " . $mysqli->error;
            }
        }
    }
} else {
    echo "Preencha todos os campos!";
}
?>
