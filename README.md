# Projeto-1: Marketplace para Psicólogos e Psiquiatras

**Disciplina**: Projeto 1 - Engenharia da Computação, UFRPE, Campus UABJ

Este projeto é dedicado à disciplina de Projeto 1 do curso de Engenharia da Computação da UFRPE, Campus UABJ. O objetivo principal é desenvolver um site marketplace que conecte usuários a psicólogos e psiquiatras, forneça informações sobre Transtorno de Déficit de Atenção e Hiperatividade (TDAH), e ofereça um questionário para identificar possíveis sinais de TDAH.

## 🎯 Objetivo do Projeto

- **Plataforma Marketplace**: Criar um site que permita aos usuários encontrarem psicólogos e psiquiatras de forma rápida e eficiente.
- **Informações sobre TDAH**: Fornecer conteúdo educativo sobre TDAH, ajudando os usuários a entender melhor o transtorno.
- **Questionário de Sinais de TDAH**: Desenvolver um questionário que ajude na identificação de possíveis sinais de TDAH nos usuários.
 
## 👥 Equipe

- **[Alison Henrique Serpa](https://github.com/AlisonHSerpa)** - Desenvolvedor Backend e Frontend
- **[Júlio César](https://github.com/jcfern87)** - Desenvolvedor Backend e Frontend
- **[Lawrence Lopes](https://github.com/lawrst)** - Designer de Interface e Desenvolvedor Frontend
- **[Mariana de Holanda](https://github.com/mhchacon)** - Designer de Interface e Desenvolvedor Frontend
- **[Raquel Anjos](https://github.com/raqu-ajm)** - Designer de Interface e Desenvolvedor Frontend

## 🧑‍🏫 Orientação

- **Professor**: [Ygor Amaral](https://github.com/ygoramaral)
- **Consultor**: [José Miguel](http://github.com/JMiguelsilva2003)

## 🚀 Tecnologias Utilizadas

O projeto está sendo desenvolvido utilizando as seguintes tecnologias:

- **JavaScript**: Para a lógica de interação no frontend e backend.
- **CSS**: Para estilização e layout das páginas.
- **HTML**: Para a estruturação do conteúdo do site.
- **PHP**: Para o desenvolvimento do backend e integração com o banco de dados.
- **SQL**: Para o gerenciamento e manipulação dos dados armazenados.

## 📝 Como Contribuir

1. Faça um clone do repositório:
    ```bash
    git clone https://github.com/AlisonHSerpa/Projeto-1.git
    ```
2. Crie uma branch para a sua feature:
    ```bash
    git checkout -b minha-feature
    ```
3. Faça as alterações necessárias e commit:
    ```bash
    git commit -m "Adiciona minha feature"
    ```
4. Envie para a branch principal:
    ```bash
    git push origin minha-feature
    ```
5. Crie um Pull Request na interface do GitHub.

## Guia de Deploy para Servidor PHP com XAMPP e Composer

### Passo 1: Instalar o XAMPP
1. *Baixe o XAMPP*: Acesse o site oficial do XAMPP e baixe a versão para Windows.
2. *Instale o XAMPP*: Execute o instalador e siga as instruções. Certifique-se de selecionar os componentes necessários, como Apache, MySQL, PHP e phpMyAdmin.
3. *Inicie o XAMPP*: Após a instalação, abra o painel de controle do XAMPP e inicie o Apache e o MySQL.

### Passo 2: Configurar o PHP no XAMPP
1. *Verifique a instalação do PHP*: Abra o terminal (cmd) e digite php -v para verificar se o PHP está instalado corretamente.
2. *Configurar o php.ini*: No diretório de instalação do XAMPP, abra o arquivo php.ini (geralmente localizado em C:\xampp\php\php.ini) e certifique-se de que as seguintes extensões estejam habilitadas (remova o ponto e vírgula ; no início das linhas, se necessário):
   ini
   extension=php_openssl.dll
   extension=php_curl.dll
   
3. *Atenção*: Os passos seguintes somente devem ser executados em um novo projeto, no caso da importação do projeto já configurado, os passos 3,4 e 5 podem ser ignorados

#### Passo 3: Instalar o Composer
1. *Baixe o Composer*: Acesse o site oficial do Composer e baixe o instalador para Windows.
2. *Execute o instalador*: Siga as instruções do instalador. Quando solicitado, selecione o caminho para o php.exe (geralmente em C:\xampp\php\php.exe).
3. *Verifique a instalação*: Após a instalação, abra o terminal e digite composer para verificar se o Composer foi instalado corretamente.

### Passo 4: Configurar o Projeto PHP
1. *Crie um diretório para o projeto*: No diretório htdocs do XAMPP (geralmente em C:\xampp\htdocs), crie uma pasta para o seu projeto.
2. *Inicie um novo projeto com o Composer*: No terminal, navegue até o diretório do projeto e execute o comando:
   bash
   composer init
	
### Passo 5: Instalar o banco de dados SQL
1. *crie uma tabela para o banco de dados*:
   <br> -id
   <br> -nome_usuario
   <br> -email
   <br> -senha_hash
   <br> -cpf
   <br> -telefone

## 📄 Licença

Este projeto está licenciado sob a [MIT License](LICENSE).
