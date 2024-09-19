<?php
session_start();
include('protect.php');  // Protege a página, verifica se o usuário está logado
include('conexao.php');  // Inclui a conexão com o banco de dados

// Verifica se o usuário está logado
if (isset($_SESSION['id'])) {
    // Obtém o ID do usuário da sessão
    $id_usuario = $_SESSION['id'];

    // Verifica o tipo de usuário (pode ser 'usuario' ou 'profissional')
    if ($_SESSION['tipo'] === 'usuario') {
        // Consulta SQL para buscar as informações da tabela de usuários
        $sql_code = "SELECT * FROM usuarios WHERE id = '$id_usuario'";
    } else if ($_SESSION['tipo'] === 'profissional') {
        // Consulta SQL para buscar as informações da tabela de profissionais
        $sql_code = "SELECT * FROM profissionais WHERE id_profissional = '$id_usuario'";
    } else {
        echo "Erro: Tipo de usuário desconhecido.";
        exit();
    }

    // Executa a consulta
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

    // Verifica se a consulta retornou algum resultado
    if ($sql_query->num_rows == 1) {
        $usuario = $sql_query->fetch_assoc();
    } else {
        echo "Erro: Usuário não encontrado.";
        exit();
    }
} else {
    header("Location: login.php"); // Redireciona para a página de login se não estiver logado
    exit();
}
  // Manipulação do upload de foto de perfil
$foto_perfil = 'imagens/foto2.jpg'; // Padrão caso o usuário não tenha foto
if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $arquivo = $_FILES['foto'];

    // Verifica o tamanho do arquivo (máximo 2MB)
    if ($arquivo['size'] > 2097152) {
        die("Arquivo muito grande! Max: 2MB");
    }

    // Definindo diretório de upload e novo nome para o arquivo
    $pasta = "upload/arquivos/";
    $nomeDoArquivo = $arquivo['name'];
    $novoNomeDoArquivo = uniqid();
    $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));

    // Verifica a extensão do arquivo
    if ($extensao != "jpg" && $extensao != 'png') {
        die("Tipo de arquivo não aceito");
    }

    // Movendo o arquivo para a pasta de destino
    $caminhoArquivo = $pasta . $novoNomeDoArquivo . "." . $extensao;
    $deu_certo = move_uploaded_file($arquivo["tmp_name"], $caminhoArquivo);

    if ($deu_certo) {
        // Atualiza a foto de perfil na variável para exibição
        $foto_perfil = $caminhoArquivo;

        // Atualiza o caminho da foto no banco de dados
        $sql_update = "UPDATE usuarios SET foto_perfil = '$caminhoArquivo' WHERE id = '$id_usuario'";
        if (!$mysqli->query($sql_update)) {
            die("Erro ao atualizar foto de perfil: " . $mysqli->error);
        }
    } else {
        echo "<p>Falha ao enviar o arquivo.</p>";
    }
} else if (!empty($usuario['foto_perfil'])) {
    // Se o usuário já tiver uma foto de perfil no banco, atualiza a exibição
    $foto_perfil = $usuario['foto_perfil'];
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Usuário</title>
    <link rel="shortcut icon" href="imagens/Icon_full-teste.ico" type="image/x-icon">
    <link rel="stylesheet" href="../styles/painel-estilo.css">
    <link rel="stylesheet" href="../styles/bem-vindo_query.css">
    <style>
        /* Estilos personalizados para os botões menores */

        #foto {
            display: block;
            margin-bottom: 10px;
            color: white;
        }

        button {
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        button:hover {
            background-color: #45a049;
        }

        #imagem-perfil {
            display: flex;
        }

        #foto-upload-container {
            display: flex;
            flex-direction: column;
            margin-bottom: 60px;
            margin-top: -100px;
            margin-left: 130px;
        }
        </style>
</head>
<body>
    <header>
        <nav class="nav">
            <menu id="partes" class="menu">
                <img src="imagens/icon.png" alt="Logo do Site" class="logo">
                <i id="burguer" class="material-symbols-outlined" onclick="clickMenu()">menu</i>

                <!-- "Acha que tem?" link será exibido apenas se o usuário for 'usuario' -->
                <?php if ($_SESSION['tipo'] === 'usuario'): ?>
                    <a href="questionario-informativo.php" class="item-menu" id="A">Acha que tem?</a>
                <?php endif; ?>

                <a href="tela-profissionais.php" class="item-menu" id="P">Profissionais</a>
                <a href="Bem-vindo.php" class="item-menu" id="D">Início</a>
                <a href=""><img src="<?php echo htmlspecialchars($foto_perfil); ?>" alt="perfil" id="perfil-foto"></a>
            </menu>
        </nav>
    </header>
    <hr class="divisor">

    <p class="btn"><a href="logout.php">Logout</a></p>

    <main>
        <section id="imagem-perfil">
            <img src="<?php echo htmlspecialchars($foto_perfil); ?>" alt="perfil">
            
            <div>
                <h1><?php echo htmlspecialchars($usuario['nome_usuario'] ?? $usuario['nome']); ?></h1>
                <p><?php echo htmlspecialchars($usuario['email']); ?></p>
            </div>
        </section>    
        <!-- Upload de foto de perfil -->
        <div id="foto-upload-container">
            <form method="post" enctype="multipart/form-data" action="">
                <input type="file" id="foto" name="foto">
                <button type="submit">Atualizar Foto</button>
            </form>
        </div>  
        <section id="informacoes">
            <h2>Email:</h2>
            <p><?php echo htmlspecialchars($usuario['email']); ?></p>
            <h2>CPF:</h2>
            <p><?php echo htmlspecialchars($usuario['cpf']); ?></p>
            <h2>Telefone:</h2>
            <p><?php echo htmlspecialchars($usuario['telefone']); ?></p>
            !-- Exibe informações adicionais se o usuário for um profissional -->
            <?php if ($_SESSION['tipo'] === 'profissional'): ?>
                <h2>Atendimento:</h2>
                <p><?php echo htmlspecialchars($usuario['atendimento']); ?></p>
                <h2>Especialidade:</h2>
                <p><?php echo htmlspecialchars($usuario['especialidade']); ?></p>
                <h2>CRP/CRM:</h2>
                <p><?php echo htmlspecialchars($usuario['crp'] ?? $usuario['crm']); ?></p>
            <?php endif; ?> 
            <div class="senha-alterar">
                <h2>Senha:</h2>
                <p>********</p>
            </div>
            <button class="btn"><a href="novos-dados.php">Alterar dados</a></button>
        </section>
        <!-- O formulário será exibido apenas se o usuário for 'usuario' -->
        <?php if ($_SESSION['tipo'] === 'usuario'): ?>
            <section id="formulario">
                <p>Formulário</p>
                <button class="btn-simbolo">
                    <img src="imagens/símbolo.png" alt="Simbolo" width="50" height="50">
                </button>
            </section>
        <?php endif; ?>
    </main>

    <footer>
        <p>Site Desenvolvido por:</p>
        <p><a href="" target="_blank">Júlio César Alves Fernandes</a></p>
        <p><a href="" target="_blank">Alison Henrique de Lima Serpa</a></p>
    </footer>

    <script src="../scripts/seu-script.js"></script>
</body>
</html>