<?php
include('conexao.php');
include ('protect.php'); // Inclui o script de proteção para verificar se o usuário está logado

// ID do usuário obtido da sessão
$user_id = $_SESSION['id']; // Obtém o ID do usuário logado

// Buscando o nome do usuário na tabela 'usuários'
$stmt = $mysqli->prepare("SELECT nome_usuario FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($nome_usuario);
$stmt->fetch();
$stmt->close();

if (!$nome_usuario) {
    echo "Erro: Usuário não encontrado.";
    exit();
}

// Respostas do questionário
$respostas = [];
for ($i = 1; $i <= 18; $i++) {
    $respostas[] = $_POST["resposta$i"];
}

// Verificando se o usuário já tem uma linha na tabela `respostas_questionario`
$stmt = $mysqli->prepare("SELECT id FROM respostas_questionario WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    // Se o usuário já tiver uma linha, atualize as respostas existentes
    $stmt->close();
    $query = "UPDATE respostas_questionario SET ";
    for ($i = 1; $i <= 18; $i++) {
        $query .= "resposta$i = ?, ";
    }
    $query = rtrim($query, ", ") . " WHERE user_id = ?";
    $stmt = $mysqqli->prepare($query);

    // Combina as respostas e o user_id em um único array
    $parametros = array_merge($respostas, [$user_id]);

    // Converte os valores de $parametros em uma lista de referências para bind_param
    $stmt->bind_param(str_repeat("i", 18) . "i", ...$parametros);

    if ($stmt->execute()) {
        // Redireciona para peinel.php após atualizar as respostas
        header("Location: painel.php");
        exit();
    } else {
        echo "Erro ao atualizar as respostas: " . $stmt->error;
    }
} else {
    // Se o usuário não tiver uma linha, insira novas respostas
    $stmt->close();
    $query = "INSERT INTO respostas_questionario (user_id, nome_usuario, " . implode(", ", array_map(fn($i) => "resposta$i", range(1, 18))) . ") VALUES (?, ?, " . str_repeat("?, ", 17) . "?)";

    $stmt = $mysqli->prepare($query);

    // Combina user_id, nome_usuario e as respostas em um único array
    $parametros = array_merge([$user_id, $nome_usuario], $respostas);

    // Converte os valores de $parametros em uma lista de referências para bind_param
    $stmt->bind_param("is" . str_repeat("i", 18), ...$parametros);

    if ($stmt->execute()) {
        // Redireciona para painel.php após inserir as respostas
        header("Location: painel.php");
        exit();
    } else {
        echo "Erro ao inserir as respostas: " . $stmt->error;
    }
}

$stmt->close();
$mysqli->close();