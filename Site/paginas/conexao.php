<?php
$hostname = "localhost"; // Endereço do servidor MySQL (normalmente localhost se estiver na mesma máquina)
$bancodedados = "cadastro_user_projeto_1"; // Nome do banco de dados
$usuario = "root"; // Nome de usuário do MySQL
$senha = ""; // Senha do usuário do MySQL (deixe vazio se não tiver senha)

// Conexão com o banco de dados
$mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);

// Verifica se houve algum erro na conexão
if ($mysqli->connect_errno) {
    echo "Falha na conexão: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}