<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel ="shortcut icon "href="imagens/
    lcon_full-teste.ico" type="image/x-icon">
    <link rel="stylesheet" href="../styles/
    cadastro-estilos.css">
    <link rel="stylesheet" href="../styles/ cadastro-media-query.css">
</head>
<body
    <header>
        <nav class="nav">
        <menu id="partes">
        <img src ="imagens/icon.png" alt="Logo do site" class="logo">
        </menu>
        </nav>
        <h1>Sign Up</h1>
    </header>

    <hr class="divisor">

    <main>
        <form action="processa_cadastro.php" method="post" class="formularios">
            <div class="campo">
                <label for = "nome">Nome de Usuário:</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            <div class="campo">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="campo">
                <label for="cpf">CPF:</label>
                <input type="text" id="cpf" name="cpf" required>
            </div>
            <div class="campo">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
            </div>
            <div class="campo">
                <label for="telefone">Telefone:</label>
                <input type="tel" id="telefone" name="telefone" value="819" required>
            </div>
            <button type="submit" class="btn">Enviar</button>
            <a href="Bem-vindo.php" class="btn-voltar">Voltar</a>
        </form>
        </main>

        <!-- creditos -->
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
   </form>        
  </main>