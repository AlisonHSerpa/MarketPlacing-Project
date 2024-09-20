<?php

include('protect.php');

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questionário</title>
    <link rel="shortcut icon" href="imagens/Icon_full-teste.ico" type="image/x-icon">
    <link rel="stylesheet" href="../styles/questionario-estilos.css">
</head>
<body>
    <main>
        <a href="Bem-vindo.php">Voltar</a>
        <section>
            <p id="question"></p>
        </section>

        <form onsubmit="return false;">
            <div id="buttons">
                <button type="button" onclick="submitAnswer(1)">Nunca</button>
                <button type="button" onclick="submitAnswer(2)">Quase Nunca</button>
                <button type="button" onclick="submitAnswer(3)">De vez em quando</button>
                <button type="button" onclick="submitAnswer(4)">Quase Sempre</button>
                <button type="button" onclick="submitAnswer(5)">Sempre</button>
            </div>
            <button id="submit" type="button" style="display:none;" onclick="sendData()">Enviar Respostas</button>
        </form>
    </main>

    <section class="img">
        <img src="imagens/caricature-removebg.png" alt="" srcset="" id="astr">
        <img src="imagens/earth.png" alt="" srcset="" id="terra">
    </section>
    <script src="../scripts/questionario-script.js"></script>
</body>
</html>
