<?php
session_start(); // Iniciar a sessão
include('conexao.php');

// Verificar o tipo de usuário (usuario ou profissional)
$userId = $_SESSION['id'];
$tipoUsuario = $_SESSION['tipo'];

if (isset($userId)) {
    if ($tipoUsuario === 'usuario') {
        // Se for um usuário, buscar da tabela 'usuarios'
        $sql = "SELECT * FROM usuarios WHERE id = $userId";
    } else if ($tipoUsuario === 'profissional') {
        // Se for um profissional, buscar da tabela 'profissionais'
        $sql = "SELECT * FROM profissionais WHERE id_profissional = $userId";
    } else {
        echo "Erro: Tipo de usuário desconhecido.";
        exit();
    }

    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc(); // Obtenha os dados do usuário ou profissional
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
            <!-- Exibir campos de acordo com o tipo de usuário -->
            <?php if ($tipoUsuario === 'usuario'): ?>
                <input type="hidden" id="id" name="id" value="<?php echo $usuario['id']; ?>"> <!-- ID oculto -->
                <div class="campo">
                    <label for="nome">Nome de Usuário:</label>
                    <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($usuario['nome_usuario']); ?>">
                </div>
                <div class="campo">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>">
                </div>
                <div class="campo">
                    <label for="telefone">Telefone:</label>
                    <input type="tel" id="telefone" name="telefone" value="<?php echo htmlspecialchars($usuario['telefone']); ?>">
                </div>
                <div class="campo">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha">
                </div>

            <?php elseif ($tipoUsuario === 'profissional'): ?>
                <input type="hidden" id="id_profissional" name="id_profissional" value="<?php echo $usuario['id_profissional']; ?>"> <!-- ID oculto -->
                <div class="campo">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($usuario['nome']); ?>">
                </div>
                <div class="campo">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>">
                </div>
                <div class="campo">
                    <label for="telefone">Telefone:</label>
                    <input type="tel" id="telefone" name="telefone" value="<?php echo htmlspecialchars($usuario['telefone']); ?>">
                </div>
                <div class="campo">
                    <label for="atendimento">Tipo de Atendimento:</label>
                    <select id="atendimento" name="atendimento">
                        <option value="online" <?php if ($usuario['atendimento'] == 'online') echo 'selected'; ?>>Online</option>
                        <option value="presencial" <?php if ($usuario['atendimento'] == 'presencial') echo 'selected'; ?>>Presencial</option>
                        <option value="ambos" <?php if ($usuario['atendimento'] == 'ambos') echo 'selected'; ?>>Ambos</option>
                    </select>
                </div>
                <div class="campo">
                    <label for="especialidade">Especialidade:</label>
                    <input type="text" id="especialidade" name="especialidade" value="<?php echo htmlspecialchars($usuario['especialidade']); ?>">
                </div>
                <div class="campo">
                    <label for="crp">CRP (para Psicólogos):</label>
                    <input type="text" id="crp" name="crp" value="<?php echo htmlspecialchars($usuario['crp']); ?>">
                </div>
                <div class="campo">
                    <label for="crm">CRM (para Psiquiatras):</label>
                    <input type="text" id="crm" name="crm" value="<?php echo htmlspecialchars($usuario['crm']); ?>">
                </div>
                <div class="campo">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha">
                </div>

            <?php endif; ?>

            <button type="submit" class="btn">Atualizar</button>
            <a href="Bem-vindo.php" class="btn-voltar">Voltar</a>
        </form>
    </main>

    <footer>
        <p>Site Desenvolvido por:</p>
        <p><a href="" target="_blank">Júlio César Alves Fernandes</a></p>
        <p><a href="" target="_blank">Alison Henrique de Lima Serpa</a></p>
    </footer>
</body>
</html>
