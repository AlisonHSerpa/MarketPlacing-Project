<?php

include('protect.php');

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profissionais</title>
    <link rel="shortcut icon" href="imagens/Icon_full-teste.ico" type="image/x-icon">
    <link rel="stylesheet" href="../styles/profissionais-estilo.css">
    <link rel="stylesheet" href="../styles/bem-vindo_query.css">
</head>
<body>
    <header>
        <nav class="nav">
            <menu id="partes" class="menu">
                <img src="imagens/icon.png" alt="Logo do Site" class="logo">
                <i id="burguer" class="material-symbols-outlined" onclick="clickMenu()">menu</i>
                <a href="tela-profissionais.php" class="item-menu" id="P">Profissionais</a>
                <a href="questionario-informativo.php" class="item-menu" id="A">Acha que tem?</a>
                <a href="Bem-vindo.php" class="item-menu" id="P">Inicio</a>
                <a href="#"><img src="imagens/perfil.png" alt="perfil" id="perfil-foto"></a>
            </menu>
        </nav>
    </header>

    <hr class="divisor">

    <main>
        <section class="texto">
            <h1>Conheça Nossos Profissionais</h1>
            <h2>e se consulte com médicos especializados em TDAH</h2>
        </section>

        <section class="texto">
            <p id="especial">Para localizarmos profissionais perto de você, nos informe:</p>
            <button class="btn" id="localizacao" >Sua localização</button>
        </section>

        <form id="searchForm">
            <div class="campo">
                <label for="profissao">Profissão:</label>
                <select id="profissao" name="profissao">
                    <option value="">Selecione a Profissão</option>
                    <option value="Psicólogo">Psicólogo</option>
                    <option value="Psiquiatra">Psiquiatra</option>
                </select>

                <label for="nome">Nome do Profissional:</label>
                <input type="text" id="nome" name="nome">
            </div>
        <button type="submit" class="btn">Buscar</button>
        </form>


        <section id="profissionais"></section>

        <div id="navigation">
            <!--<button id="verMenos" class="btn" style="display:none;">Ver Menos</button>-->
            <button id="verMais" class="btn" style="display:none;">Ver Mais</button>
        </div>
    </main>

    <section class="texto">
            <p>Gostaria de fazer parte do nosso time de profissionais?</p>

            <p>Faça parte da rede de profissionais especializados em TDAH. Ao se inscrever, você terá a oportunidade de se conectar com outros especialistas, compartilhar conhecimentos e experiências, e encontrar novas oportunidades de trabalho.</p>
            <button class="btn" onclick="window.location.href='cadastro-profissional.php'">Sou profissional</button>
        </section>

        <footer>
            <p>Site desenvolvivo por</p>
            <p><a href=""target="_blank">Alison Serpa</a></p>
            <p><a href="" target="_blank">Júlio Cesar</a></p>
            <p><a href="" target="_blank">Lawrence Lopes</a></p>
            <p><a href="" target="_blank">Mariana Chacon</a></p>
            <p><a href="" target="_blank">Raquel Anjos</a></p>
        </footer>

    <script src="../scripts/seu-script.js"></script>
    <script src="../scripts/profissionais.js"></script>
</body>
</html>
