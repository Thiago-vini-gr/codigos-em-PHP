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
            require_once 'conexao.php';
            require_once 'pessoa.php';

            $mensagem = '';
            $cadastroSucesso = false;

            $database = new BancoDeDados();
            $db = $database->obterConexao();

            if ($db === null){
                $mensagem = "Erro: Não foi possível conectar ao banco de dados";
            } else {
                if ($_SERVER["REQUEST_METHOD"] == "POST"){
                    $pessoa = new Pessoa($db);
                    $pessoa->nome = $_POST['nome'];
                    $pessoa->idade = $_POST['idade'];

                    if ($pessoa->criar()){
                        $mensagem = "Pessoa '{$pessoa->nome}' cadastrada com sucesso!";
                        $cadastroSucesso = true;
                    } else{
                        $mensagem = "Erro ao cadastrar a pessoa.";
                    }
                }
            }
?>
         <form action="" method="post" id="fromCadastroPessoa"> <label for="nome">Nome:</label>
         <input type="text" id="nome" name="nome" required>
         <label for="idade">Idade:</label>
        <input type="number" id="idade" name="idade" required>
        <input typw="submit" value="Cadastrar">
        </form>
        </section>
        </div>

        <script>
            const mensagemDoPHP = "<?php echo $mensagem; ?>";
            const cadastroFoi Sucesso = <?php echo json_encode($cadastroSucesso); ?>;

            if (mensagemDoPHP){
                alert(mensagemDoPHP);

                if (cadastrofoiSucesso){
                    document.getElementById('nome').value = '';
                    document.getElementById('idade').value = '';

                    document.getElement('nome').focus();
                }
            }
            </script>
</body>
</html>