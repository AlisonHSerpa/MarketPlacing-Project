<?php
include"conexao.php";

if(isset($_POST['email']) && isset($_POST['senha'])) {
    $email = $mysqli->real_escape_string($_POST['email']);
    $senha = $mysqli->real_escape_string($_POST['senha']);

    $sql_code = "SELECT * FROM usuarios WHERE email = '$email'";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

    $quantidade = $sql_query->num_rows;

    if($quantidade == 1) {
        $usuario = $sql_query->fetch_assoc();

        if(password_verify($senha, $usuario['senha_hash'])) {
            session_start();
            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome_usuario'] = $usuario['nome_usuario'];
            header("Location: painel.php");
            exit();
        } else {
            echo "Falha ao logar! E-mail ou senha incorretos";
        }
    } else {
        echo "Falha ao logar! E-mail ou senha incorretos";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>
    <link rel="shortcut icon" href="imagens/icon_full-teste.icon" type="image/x-icon">
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
                <input type="email" id="email" name="email" required></required>
            </div>
            <div class="campo">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
            </div>
            <button type="submit" class="btn">Entrar</button>
            <a href="Bem-vindo.php" class="btn-voltar">Voltar</a>
        </form>
        <main>

            <footer>
                <p>Site Desenvolvido por:</p>
                <p><a href="" target="_blank">Júlio César Alves Fernandes</a></p>
                <p><a href="" target="_blank">Alison Henrique de Lima Serpa</a></p>
                <p><a href="" target="_blank">Lawrence Lopes Gomes Silva</a></p>
                <p><a href="" target="_blank">Mariana Chacon de Holanda Santos</a></p>
                <p><a href="" target="_blank">Raquel Anjos</a></p>
            </footer>
</body>

</html>