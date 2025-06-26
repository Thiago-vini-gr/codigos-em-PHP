<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Pessoa</title>
</head>
<body>
    <div class="container">
        <header>
            <h1>Cadastro de Pessoa</h1>
        </header>
        <section>
            <?php
            require_once 'conexao.php'; // Conexão com o banco de dados
            require_once 'pessoa.php'; // Classe Pessoa

            $mensagem = ''; // Mensagem de feedback
            $cadastroSucesso = false; // Variável para verificar se o cadastro foi bem-sucedido

            $database = new BancoDeDados(); // Instância da classe BancoDeDados
            $db = $database->obterConexao(); // Obtém a conexão com o banco de dados

            if ($db === null) { // Se a conexão falhar
                $mensagem = "Erro: Não foi possível conectar ao banco de dados"; // Mensagem de erro
            } else { // Se a conexão for bem-sucedida
                $pessoa = new Pessoa($db); // Instância da classe Pessoa com a conexão do banco de dados

                if ($_SERVER["REQUEST_METHOD"] == "POST") { // Verifica se o formulário foi enviado
                    $pessoa->nome = $_POST['nome']; // Obtém o nome da pessoa do formulário
                    $pessoa->idade = $_POST['idade']; // Obtém a idade da pessoa do formulário
                    if ($pessoa->criar()) { // Tenta criar a pessoa no banco de dados
                        $mensagem = "Pessoa '{$pessoa->nome}' cadastrada com sucesso!"; // Mensagem de sucesso
                        $cadastroSucesso = true; // Define que o cadastro foi bem-sucedido
                    } else { // Se o cadastro falhar
                        $mensagem = "Erro ao cadastrar a pessoa."; // Mensagem de erro
                    }
                }
            }
?>
         <form action="" method="post" id="fromCadastroPessoa"> <label for="nome">Nome:</label> <!-- Campo de entrada para o nome da pessoa -->
         <input type="text" id="nome" name="nome" required> <!-- Campo de entrada para o nome da pessoa -->
         <label for="idade">Idade:</label> <!-- Campo de entrada para a idade da pessoa -->
        <input type="number" id="idade" name="idade" required> <!-- Campo de entrada para a idade da pessoa -->
        <input type="submit" value="Cadastrar"> <!-- Botão de envio do formulário -->
        </form>
        </section>
        </div>

        <script>
            const mensagemDoPHP = "<?php echo $mensagem; ?>";   // Mensagem de feedback do PHP
            const cadastroFoiSucesso = <?php echo json_encode($cadastroSucesso); ?>; // Verifica se o cadastro foi bem-sucedido

            if (mensagemDoPHP){
                alert(mensagemDoPHP);

                if (cadastrofoiSucesso){ 
                    document.getElementById('nome').value = ''; // Limpa o campo de nome
                    document.getElementById('idade').value = ''; // Limpa o campo de idade

                    document.getElement('nome').focus(); // Foca no campo de nome
                }
            }
            </script>
</body>
</html>