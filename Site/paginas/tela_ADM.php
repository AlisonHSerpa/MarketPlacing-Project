<?php
session_start();

// Verifica se o usuário é o administrador
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    // Redireciona para a página de login se não for o administrador
    header('Location: login.php');
    exit();
}
?>
<?php
include('conexao.php');

// Função para buscar todos os usuários e profissionais
function buscarUsuariosProfissionais($mysqli) {
    $queryUsuarios = "SELECT id, nome_usuario, email, cpf, telefone FROM usuarios";
    $resultUsuarios = $mysqli->query($queryUsuarios);

    $queryProfissionais = "SELECT id_profissional, nome, email, crp, crm, atendimento, telefone, clinica FROM profissionais";
    $resultProfissionais = $mysqli->query($queryProfissionais);

    return [$resultUsuarios, $resultProfissionais];
}

// Função para buscar todos os banidos
function buscarBanidos($mysqli) {
    $queryBanidos = "SELECT id, id_banido, nome, email, cpf, cargo FROM banidos";
    return $mysqli->query($queryBanidos);
}

// Função para excluir usuários ou profissionais
if (isset($_POST['excluir'])) {
    $id = $_POST['id'] ?? null;
    $tabela = $_POST['tabela'];

    if ($id && $tabela === 'usuarios') {
        $query = "DELETE FROM usuarios WHERE id = $id";
        $mysqli->query($query);
    } else if ($id && $tabela === 'profissionais') {
        $query = "DELETE FROM profissionais WHERE id_profissional = $id";
        $mysqli->query($query);
    }
}

// Função para banir usuários (sem banir profissionais)
if (isset($_POST['banir'])) {
    $id = $_POST['id'] ?? null;
    $tabela = $_POST['tabela'];

    // Apenas permite banir usuários
    if ($id && $tabela === 'usuarios') {
        $cargo = 'usuario';

        // Obter informações do usuário para banir
        $query = "SELECT id, nome_usuario AS nome, email, cpf FROM usuarios WHERE id = $id";
        $result = $mysqli->query($query);
        $banido = $result->fetch_assoc();

        // Inserir na tabela de banidos
        $insertQuery = "INSERT INTO banidos (id_banido, nome, email, cpf, cargo) 
                        VALUES ('{$banido['id']}', '{$banido['nome']}', '{$banido['email']}', '{$banido['cpf']}', '$cargo')";
        $mysqli->query($insertQuery);

        // Excluir o usuário da tabela original
        $deleteQuery = "DELETE FROM usuarios WHERE id = $id";
        $mysqli->query($deleteQuery);
    }
}

// Função para desbanir
if (isset($_POST['desbanir'])) {
    $id = $_POST['id'];
    $cargo = $_POST['cargo'];

    // Buscar o banido antes de excluir
    $queryBanido = "SELECT * FROM banidos WHERE id = $id";
    $resultBanido = $mysqli->query($queryBanido);
    $banido = $resultBanido->fetch_assoc();

    // Define um valor padrão de telefone caso seja NULL
    $telefone = $banido['telefone'] ?? '0000-0000';

    // Desbanir o usuário, inserindo-o de volta na tabela de usuários
    if ($cargo === 'usuario') {
        $queryInsert = "INSERT INTO usuarios (id, nome_usuario, email, cpf, telefone) 
                        VALUES ('{$banido['id_banido']}', '{$banido['nome']}', '{$banido['email']}', '{$banido['cpf']}', '$telefone')";
        $mysqli->query($queryInsert);
    }

    // Remover da tabela de banidos
    $deleteBanido = "DELETE FROM banidos WHERE id = $id";
    $mysqli->query($deleteBanido);
}

// Função para atualizar usuários ou profissionais
if (isset($_POST['atualizar'])) {
    $id = $_POST['id'] ?? null;
    $tabela = $_POST['tabela'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    if ($tabela === 'usuarios' && $id) {
        $query = "UPDATE usuarios SET nome_usuario = '$nome', email = '$email', telefone = '$telefone' WHERE id = $id";
        $mysqli->query($query);
    } else if ($tabela === 'profissionais') {
        $id_profissional = $_POST['id_profissional'] ?? null;
        $crp_crm = $_POST['crp_crm'];
        $atendimento = $_POST['atendimento'];
        $clinica = $_POST['clinica'];

        if ($id_profissional) {
            // Verifica se é CRP ou CRM
            $crp = (strpos($crp_crm, 'CRP') !== false) ? $crp_crm : null;
            $crm = (strpos($crp_crm, 'CRM') !== false) ? $crp_crm : null;

            $query = "UPDATE profissionais SET nome = '$nome', email = '$email', telefone = '$telefone', 
                      crp = " . ($crp ? "'$crp'" : "NULL") . ", 
                      crm = " . ($crm ? "'$crm'" : "NULL") . ", 
                      atendimento = '$atendimento', clinica = '$clinica' 
                      WHERE id_profissional = $id_profissional";
            $mysqli->query($query);
        }
    }
}

list($resultUsuarios, $resultProfissionais) = buscarUsuariosProfissionais($mysqli);
$resultBanidos = buscarBanidos($mysqli);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel de Administração</title>
</head>
<body>
    <h1>Painel de Administração</h1>

    <section>
        <h2>Usuários</h2>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>CPF</th>
                <th>Telefone</th>
                <th>Ações</th>
            </tr>
            <?php while ($usuario = $resultUsuarios->fetch_assoc()): ?>
            <tr>
                <td><?php echo $usuario['id']; ?></td>
                <td><?php echo $usuario['nome_usuario']; ?></td>
                <td><?php echo $usuario['email']; ?></td>
                <td><?php echo $usuario['cpf']; ?></td>
                <td><?php echo $usuario['telefone']; ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
                        <input type="hidden" name="tabela" value="usuarios">
                        <button type="submit" name="excluir">Excluir</button>
                        <button type="submit" name="banir">Banir</button>
                    </form>
                    <form method="POST">
                        <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
                        <input type="hidden" name="tabela" value="usuarios">
                        <input type="text" name="nome" value="<?php echo $usuario['nome_usuario']; ?>" placeholder="Nome">
                        <input type="email" name="email" value="<?php echo $usuario['email']; ?>" placeholder="Email">
                        <input type="text" name="telefone" value="<?php echo $usuario['telefone']; ?>" placeholder="Telefone">
                        <button type="submit" name="atualizar">Atualizar</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </section>

    <section>
        <h2>Profissionais</h2>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>CRP/CRM</th>
                <th>Atendimento</th>
                <th>Telefone</th>
                <th>Clínica</th>
                <th>Ações</th>
            </tr>
            <?php while ($profissional = $resultProfissionais->fetch_assoc()): ?>
            <tr>
                <td><?php echo $profissional['id_profissional']; ?></td>
                <td><?php echo $profissional['nome']; ?></td>
                <td><?php echo $profissional['email']; ?></td>
                <td><?php echo $profissional['crp'] ?? $profissional['crm']; ?></td>
                <td><?php echo $profissional['atendimento']; ?></td>
                <td><?php echo $profissional['telefone']; ?></td>
                <td><?php echo $profissional['clinica']; ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="id" value="<?php echo $profissional['id_profissional']; ?>">
                        <input type="hidden" name="tabela" value="profissionais">
                        <button type="submit" name="excluir">Excluir</button>
                        <!-- Removido o botão de banir profissionais -->
                    </form>
                    <form method="POST">
                        <input type="hidden" name="id_profissional" value="<?php echo $profissional['id_profissional']; ?>">
                        <input type="hidden" name="tabela" value="profissionais">
                        <input type="text" name="nome" value="<?php echo $profissional['nome']; ?>" placeholder="Nome">
                        <input type="email" name="email" value="<?php echo $profissional['email']; ?>" placeholder="Email">
                        <input type="text" name="crp_crm" value="<?php echo $profissional['crp'] ?? $profissional['crm']; ?>" placeholder="CRP/CRM">
                        <input type="text" name="atendimento" value="<?php echo $profissional['atendimento']; ?>" placeholder="Atendimento">
                        <input type="text" name="telefone" value="<?php echo $profissional['telefone']; ?>" placeholder="Telefone">
                        <input type="text" name="clinica" value="<?php echo $profissional['clinica']; ?>" placeholder="Clínica">
                        <button type="submit" name="atualizar">Atualizar</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </section>

    <section>
        <h2>Banidos</h2>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>CPF</th>
                <th>Cargo</th>
                <th>Ações</th>
            </tr>
            <?php while ($banido = $resultBanidos->fetch_assoc()): ?>
            <tr>
                <td><?php echo $banido['id_banido']; ?></td>
                <td><?php echo $banido['nome']; ?></td>
                <td><?php echo $banido['email']; ?></td>
                <td><?php echo $banido['cpf']; ?></td>
                <td><?php echo $banido['cargo']; ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="id" value="<?php echo $banido['id']; ?>">
                        <input type="hidden" name="cargo" value="<?php echo $banido['cargo']; ?>">
                        <button type="submit" name="desbanir">Desbanir</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </section>
</body>
</html>
