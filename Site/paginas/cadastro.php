<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="shortcut icon" href="imagens/Icon_full-teste.ico" type="image/x-icon">
    <link rel="stylesheet" href="../styles/cadastro-estilos.css">
    <link rel="stylesheet" href="../styles/cadastro-media-query.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
</head>
<body>
    <header>
        <nav class="nav">
            <menu id="partes">
                <img src="imagens/icon.png" alt="Logo do Site" class="logo">
            </menu>
        </nav>
        <h1>Sign Up</h1>
    </header>
    
    <hr class="divisor">

    <main>
        <form action="processa_cadastro.php" method="post" class="formulario">
            <div class="campo">
                <label for="tipo">Tipo de Cadastro:</label>
                <label><input type="radio" name="tipo_cadastro" value="usuario" checked> Usuário Comum</label>
                <label><input type="radio" name="tipo_cadastro" value="profissional"> Profissional</label>
            </div>

            <!-- Campos comuns -->
            <div class="campo">
                <label for="nome">Nome de Usuário:</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            <div class="campo">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="campo">
                <label for="cpf">CPF:</label>
                <input type="text" id="cpf" name="cpf" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" placeholder="000.000.000-00" required>
            </div>
            <div class="campo">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" minlength="8" required>
            </div>
            <div class="campo">
                <label for="telefone">Telefone:</label>
                <input type="tel" id="telefone" name="telefone" pattern="\(\d{2}\)\s\d{5}-\d{4}" placeholder="(00) 00000-0000" required>
            </div>

            <!-- Campos para profissionais (escondidos por padrão) -->
            <div id="profissional-campos" style="display: none;">
                <div class="campo">
                    <label for="crp_crm">CRP ou CRM:</label>
                    <input type="text" id="crp_crm" name="crp_crm" placeholder="Informe CRP ou CRM">
                </div>
                <div class="campo">
                    <label for="atendimento">Atendimento:</label>
                    <select id="atendimento" name="atendimento">
                        <option value="online">Online</option>
                        <option value="presencial">Presencial</option>
                        <option value="ambos">Ambos</option>
                    </select>
                </div>
                <div class="campo">
                    <label for="clinica">Clínica:</label>
                    <input type="text" id="clinica" name="clinica">
                </div>
                <div class="campo">
                    <label for="especialidade">Especialidade:</label>
                    <textarea id="especialidade" name="especialidade"></textarea>
                </div>
            </div>

            <button type="submit" class="btn">Enviar</button>
            <a href="Bem-vindo.php" class="btn-voltar">Voltar</a>
        </form>
    </main>

    <footer>
        <p>Site desenvolvido por...</p>
    </footer>

    <script>
        $(document).ready(function(){
            $('#cpf').mask('000.000.000-00'); // Máscara para CPF
            $('#telefone').mask('(00) 00000-0000'); // Máscara para telefone

            // Mostrar/esconder campos profissionais com base no tipo de cadastro
            $('input[name="tipo_cadastro"]').on('change', function() {
                if ($(this).val() === 'profissional') {
                    $('#profissional-campos').show();
                } else {
                    $('#profissional-campos').hide();
                }
            });
        });
    </script>
</body>
</html>