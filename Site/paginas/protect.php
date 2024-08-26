<?php 

if(!isset($_SESSION['id'])) {
    echo '<p><a href="paginas/index.html">Sair</a></p>';
    die("Você não pode acessar esta página porque não está logado.<p><a href=\"Bem-vindo.php\">Entrar</a></p>");
}