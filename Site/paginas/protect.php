<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    echo '
    <!DOCTYPE html>
    <html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Acesso Negado</title>
        <style>
            body {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                background-color: #f2f2f2;
                font-family: Arial, sans-serif;
            }
            .container {
                text-align: center;
                background-color: white;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            }
            h1 {
                color: #e74c3c;
            }
            p {
                margin: 15px 0;
            }
            a {
                text-decoration: none;
                color: #3498db;
                font-weight: bold;
            }
            a:hover {
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Acesso Negado</h1>
            <p>Você não pode acessar esta página porque não está logado.</p>
            <p><a href="Bem-vindo.php">Voltar</a></p>
        </div>
    </body>
    </html>';
    die();
}
?>
