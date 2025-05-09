<?php
if (!isset($_SESSION)) {
    session_start();
}
?>

<?php if (!isset($_SESSION['id'])): ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem vindo</title>
    <link rel="shortcut icon" href="imagens/Icon_full-teste.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../styles/seu-estilo.css">
    <link rel="stylesheet" href="../styles/bem-vindo_query.css">
</head>
<body>
    <header>
        <nav class="nav">
            <menu id="partes" class="menu">
                <img src="imagens/icon.png" alt="Logo do Site" class="logo">
                <i id="burguer" class="material-symbols-outlined" onclick="clickMenu()">menu</i>
                <a href="questionario-informativo.php" class="item-menu" id="A">Acha que tem?</a>
                <a href="tela-profissionais.php" class="item-menu" id="P">Profissionais</a>
                <a href="#"><img src="imagens/perfil.png" alt="perfil" id="perfil-foto"></a>
            </menu>
        </nav>
    </header>
    
    <div id="perfil-menu" class="perfil-menu">
        <a href="login.php">Login</a>
        <a href="cadastro.php">Cadastro</a>
    </div>
    
    <hr class="divisor">
    
    <main>
        <section class="imagem" id="img01">
        <h1>O que é TDAH?</h1>
            <p>De acordo com a Biblioteca Municipal em Saúde (Ministério da Saúde), o TDAH é um transtorno neurobiológico de causas genéticas, caracterizado por sintomas como falta de atenção, inquietação e impulsividade que aparece na infância e pode acompanhar o indivíduo por toda a vida.</p>
            <a href="#scroll1" class="btn">Acredita que possui TDAH?</a>
            <a href="#scroll2" class="diferente">Sou profissional</a>
        </section>

        <section class="texto">
            <h1>Sintomas do TDAH</h1>
            <p>Como pode-se ver, muitos, senão todos, desses sintomas são associados com preguiça, ou outros apelidos mais pejorativos, resultados de ignorância por parte dos pais, que podem persistir até a fase adulta, influenciando a pessoa transtornada a desenvolver problemas mais sérios, como depressão, e ser obrigado a viver sem estar ciente dos próprios transtornos que são remediaveis por medicamentos especializados.</p>
            <img src="imagens/foto3.jpg" alt="Imagem 1">
            <img src="imagens/foto4.jpg" alt="Imagem 2">
            <img src="imagens/foto5.jpg" alt="Imagem 3">
        </section>
        
        <section class="texto" id="scroll1">
            <h1>Podemos te ajudar</h1>
            <p>Caso você esteja questionando se possui algum nivel de TDAH baseado nas informações que você possui, disponibilizamos um questionário aprovado pela neurociência para identificar sinais de que você possui o TDAH, este questionário está disponivel nesta plataforma gratuitamente. </p>
            <a href="questionario-informativo.php" class="btn">Faça o questionario</a>
            <p>Caso esteja convencido a dar mais um passo para um real diagnostico, crie um login na selfcare, podemos recomendar para você psicologos ou psiquiatras da sua preferência para que você possa ter uma consulta, tudo que queremos é lhe ajudar você a trilhar a primeira etapa de uma fase importante na sua vida.</p>
            <a href="login.php" class="btn">Faça login</a>
        </section>
        <section class="texto">
            <h1>Sou profissional</h1>
            <p>Você que é o formado em psicologia e psiquiatria e quer encontrar clientes, a selfcare funciona também como uma rede de profisssionais na area da saude mental, recomendamos aos nossos clientes o perfil dos psicologos e psiquiatras para que eles encontrem seus profissionais. Assinando a Selfcare você pode criar um perfil na nossa plataforma e ter um espaço para divulgar seu trabalho e encontrar novos cliente.</p>
            <a href="login.php" class="btn">Sou profissional</a>
        </section>
    </main>
    <footer>
        <p>Site desenvolvivo por</p>
        <p><a href=""target="_blank">Alison Serpa</a></p>
        <p><a href="" target="_blank">Júlio Cesar</a></p>
        <p><a href="" target="_blank">Lawrence Lopes</a></p>
        <p><a href="" target="_blank">Mariana Chacon</a></p>
        <p><a href="" target="_blank">Raquel Anjos</a></p>
    </footer>

    <script src="../scripts/seu-script.js"></script>
</body>
</html>

<?php else: ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem vindo</title>
    <link rel="shortcut icon" href="imagens/Icon_full-teste.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../styles/seu-estilo.css">
    <link rel="stylesheet" href="../styles/bem-vindo_query.css">
</head>
<body>
    <header>
        <nav class="nav">
            <menu id="partes" class="menu">
                <img src="imagens/icon.png" alt="Logo do Site" class="logo">
                <i id="burguer" class="material-symbols-outlined" onclick="clickMenu()">menu</i>
                <a href="questionario-informativo.php" class="item-menu" id="A">Acha que tem?</a>
                <a href="tela-profissionais.php" class="item-menu" id="P">Profissionais</a>
                <a href="painel.php"><img src="imagens/foto2.jpg" alt="perfil" id="perfil-foto"></a>
            </menu>
        </nav>
    </header>
    
    <hr class="divisor">
    
    <main>
        <section class="imagem" id="img01">
        <h1>O que é TDAH?</h1>
            <p>De acordo com a Biblioteca Municipal em Saúde (Ministério da Saúde), o TDAH é um transtorno neurobiológico de causas genéticas, caracterizado por sintomas como falta de atenção, inquietação e impulsividade que aparece na infância e pode acompanhar o indivíduo por toda a vida.</p>
            <a href="#scroll1" class="btn">Acredita que possui TDAH?</a>
            <a href="#scroll2" class="diferente">Sou profissional</a>
        </section>

        <section class="texto">
            <h1>Sintomas do TDAH</h1>
            <p>Como pode-se ver, muitos, senão todos, desses sintomas são associados com preguiça, ou outros apelidos mais pejorativos, resultados de ignorância por parte dos pais, que podem persistir até a fase adulta, influenciando a pessoa transtornada a desenvolver problemas mais sérios, como depressão, e ser obrigado a viver sem estar ciente dos próprios transtornos que são remediaveis por medicamentos especializados.</p>
            <img src="imagens/foto3.jpg" alt="Imagem 1">
            <img src="imagens/foto4.jpg" alt="Imagem 2">
            <img src="imagens/foto5.jpg" alt="Imagem 3">
        </section>

        <section class="texto" id="scroll1">
            <h1>Podemos te ajudar</h1>
            <p>Caso você esteja questionando se possui algum nivel de TDAH baseado nas informações que você possui, disponibilizamos um questionário aprovado pela neurociência para identificar sinais de que você possui o TDAH, este questionário está disponivel nesta plataforma gratuitamente. </p>
            <p>Caso esteja convencido a dar mais um passo para um real diagnostico, crie um login na selfcare, podemos recomendar para você psicologos ou psiquiatras da sua preferência para que você possa ter uma consulta, tudo que queremos é lhe ajudar você a trilhar a primeira etapa de uma fase importante na sua vida.</p>
            <a href="login.php" class="btn">Faça login</a>
        </section>
        <section class="texto">
            <h1>Sou profissional</h1>
            <p>Você que é o formado em psicologia e psiquiatria e quer encontrar clientes, a selfcare funciona também como uma rede de profisssionais na area da saude mental, recomendamos aos nossos clientes o perfil dos psicologos e psiquiatras para que eles encontrem seus profissionais. Assinando a Selfcare você pode criar um perfil na nossa plataforma e ter um espaço para divulgar seu trabalho e encontrar novos cliente.</p>
            <a href="login.php" class="btn">Sou profissional</a>
        </section>
    </main>
    <footer>
            <p>Site desenvolvivo por</p>
            <p><a href=""target="_blank">Alison Serpa</a></p>
            <p><a href="" target="_blank">Júlio Cesar</a></p>
            <p><a href="" target="_blank">Lawrence Lopes</a></p>
            <p><a href="" target="_blank">Mariana Chacon</a></p>
            <p><a href="" target="_blank">Raquel Anjos</a></p>
    </footer>
    </main>

    <script src="../scripts/seu-script.js"></script>
</body>
</html>


<?php endif; ?>