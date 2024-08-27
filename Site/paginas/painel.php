<?php
session_start();
include('protect.php');  // Protege a página, verifica se o usuário está logado
include('conexao.php');  // Inclui a conexão com o banco de dados

// Verifica se o usuário está logado
if(isset($_SESSION['id'])) {
    // Obtém o ID do usuário da sessão
    $id_usuario = $_SESSION['id'];
    
    // Consulta SQL para buscar as informações do usuário pelo ID
    $sql_code = "SELECT * FROM usuarios WHERE id = '$id_usuario'";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);
    
    // Verifica se a consulta retornou algum resultado
    if($sql_query->num_rows == 1) {
        $usuario = $sql_query->fetch_assoc();
    } else {
        echo "Erro: Usuário não encontrado.";
        exit();
    }
} else {
    header("Location: login.php"); // Redireciona para a página de login se não estiver logado
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Painel do Usuário</title>
    <link rel="stylesheet" href="../styles/painel.css" />
    <link rel="shortcut icon" href="Site/paginas/imagens/Icon_full-teste.ico" type="image/x-icon" />
    <!-- Link pro futuro stylesheet de CSS específico para o painel de usuário -->
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <header>
        <!-- Tag navigation que guarda uma série de links para outras páginas. -->
        <nav>
            <menu>
                <img src="Site/paginas/imagens/Icon.png" alt="Logo do Site" class="logo" />
                <a href="#" class="item-menu" id="M">Modelo de Negócio</a>
                <a href="#" class="item-menu" id="A">Acha que tem?</a>
                <a href="#" class="item-menu" id="P">Profissionais</a>
                <a href="Site/paginas/Bem-vindo.html" class="item-menu" id="D">Início</a>
                <a href=""><img src="Site/paginas/imagens/foto2.jpg" alt="perfil" id="perfil-foto" /></a>
            </menu>
        </nav>
    </header>

    <hr class="divisor" />

    <!-- Link para deslogar da sua conta -->
    <p class="btn"><a href="">Logout</a></p>

    <!-- Tag main, que vai guardar as próximas seções  -->
    <main>
        <!-- Seção da imagem de perfil -->
        <section id="imagem-perfil">
            <img src="Site/paginas/imagens/foto2.jpg" alt="perfil" />
            <div>
                <h1><?php echo htmlspecialchars($usuario['nome_usuario']); ?></h1>
                <p><?php echo htmlspecialchars($usuario['email']); ?></p>
            </div>
        </section>

        <!-- Seção de informações -->
        <section id="informacoes">
            <h2>Email:</h2>
            <p><?php echo htmlspecialchars($usuario['email']); ?></p>
            <h2>CPF:</h2>
            <p><?php echo htmlspecialchars($usuario['cpf']); ?></p>
            <h2>Telefone:</h2>
            <p><?php echo htmlspecialchars($usuario['telefone']); ?></p>
            <div class="senha-alterar">
                <h2>Senha:</h2>
                <p>****</p>
            </div>
            <button class="btn" href="nova-senha.php">Alterar senha</button>
        </section>

        <section id="formulario">
            <p>Formulário</p>
            <button class="btn-simbolo">
                <img src="Site/paginas/imagens/símbolo.png" alt="Símbolo" width="50" height="50" />
            </button>
        </section>
    </main>

    <!-- Footer para denominar os devs do projeto -->
    <footer>
        <p>Site desenvolvido por:</p>
        <p><a href="" target="_blank">Júlio César Alves Fernandes</a></p>
        <p><a href="" target="_blank">Alison Henrique de Lima Serpa</a></p>
        <p><a href="" target="_blank">Lawrence Lopes</a></p>
        <p><a href="" target="_blank">Mariana Chacon</a></p>
        <p><a href="" target="_blank">Raquel Anjos</a></p>
    </footer>

    <script src="../scripts/seu-script.js"></script>
</body>

</html>