<?php
session_start();

// Conexão com o banco de dados
include('conexao.php');

// Verifica se o formulário foi enviado
if (isset($_POST['email']) && isset($_POST['senha'])) {
    $email = $mysqli->real_escape_string($_POST['email']);
    $senha = $_POST['senha'];

    // Verifica se é o administrador
    if ($email === 'Alisonserpa02@gmail.com' && $senha === '260702Alison') {
        // Inicia a sessão do administrador
        $_SESSION['admin'] = true;
        $_SESSION['nome_usuario'] = 'Administrador';
        header('Location: tela_ADM.php');
        exit();
    }

    // Verifica na tabela de usuários
    $sql_code_usuario = "SELECT * FROM usuarios WHERE email = '$email'";
    $sql_query_usuario = $mysqli->query($sql_code_usuario);

    if ($sql_query_usuario->num_rows == 1) {
        $usuario = $sql_query_usuario->fetch_assoc();

        if (password_verify($senha, $usuario['senha_hash'])) {
            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome_usuario'] = $usuario['nome_usuario'];
            $_SESSION['tipo'] = 'usuario';
            header("Location: painel.php");
            exit();
        }
    }

    // Verifica na tabela de profissionais
    $sql_code_profissional = "SELECT * FROM profissionais WHERE email = '$email'";
    $sql_query_profissional = $mysqli->query($sql_code_profissional);

    if ($sql_query_profissional->num_rows == 1) {
        $profissional = $sql_query_profissional->fetch_assoc();

        if (password_verify($senha, $profissional['senha_hash'])) {
            $_SESSION['id'] = $profissional['id_profissional'];
            $_SESSION['nome_usuario'] = $profissional['nome'];
            $_SESSION['tipo'] = 'profissional';
            header("Location: painel.php");
            exit();
        }
    }

    // Se nenhum login for válido, exibe erro
    echo "Falha ao logar! E-mail ou senha incorretos.";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="../styles/login-estilos.css">
    <link rel="shortcut icon" href="imagens/icon_full-teste.ico" type="image/x-icon">
</head>
<body>
    <header>
        <nav class="nav">
            <menu id="partes">
                <img src="imagens/icon.png" alt="Logo do Site" class="logo">
            </menu>
        </nav>
        <h1>Login</h1>
    </header>
    
    <hr class="divisor">

    <main>
        <form action="login.php" method="post" autocomplete="on" class="formulario">
            <div class="campo">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="campo">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
            </div>
            <button type="submit" class="btn">Entrar</button>
            <a href="Bem-vindo.php" class="btn-voltar">Voltar</a>
        </form>
    </main>

    <footer>
            <p>Site desenvolvivo por</p>
            <p><a href=""target="_blank">Alison Serpa</a></p>
            <p><a href="" target="_blank">Júlio Cesar</a></p>
            <p><a href="" target="_blank">Lawrence Lopes</a></p>
            <p><a href="" target="_blank">Mariana Chacon</a></p>
            <p><a href="" target="_blank">Raquel Anjos</a></p>
    </footer>
</body>
</html>
