<?php
session_start(); // Iniciar a sessão
include('conexao.php');


$userId = $_SESSION['id'];

if (isset($userId)) {
    $sql = "SELECT * FROM usuarios WHERE id = $userId";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc(); // Obtenha os dados do usuário
    } else {
        echo "Usuário não encontrado!";
        exit();
    }
} else {
    echo "ID do usuário não fornecido!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Dados</title>
    <link rel="shortcut icon" href="imagens/Icon_full-teste.ico" type="image/x-icon">
    <link rel="stylesheet" href="../styles/cadastro-estilos.css">
    <link rel="stylesheet" href="../styles/cadastro-media-query.css">
</head>
<body>
    <header>
        <nav class="nav">
            <menu id="partes">
                <img src="imagens/icon.png" alt="Logo do Site" class="logo">
            </menu>
        </nav>
        <h1>Atualizar Dados</h1>
    </header>
    
    <hr class="divisor">

    <main>
        <form action="processa_novos-dados.php" method="post" class="formulario">
            <input type="hidden" id="id" name="id" value="<?php echo $usuario['id']; ?>"> <!-- ID oculto -->
            <div class="campo">
                <label for="nome">Nome de Usuário:</label>
                <input type="text" id="nome" name="nome" value="<?php echo $usuario['nome_usuario']; ?>">
            </div>
            <div class="campo">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $usuario['email']; ?>">
            </div>
            <div class="campo">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha">
            </div>
            <div class="campo">
                <label for="telefone">Telefone:</label>
                <input type="tel" id="telefone" name="telefone" value="<?php echo $usuario['telefone']; ?>">
            </div>
            <button type="submit" class="btn">Atualizar</button>
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
