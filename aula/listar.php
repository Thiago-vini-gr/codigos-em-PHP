<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Pessoas</title>
</head>
<body>
    <header>
        <h1>Lista de Pessoas</h1>
    </header>
    <section>
        <?php
        require_once 'conexao.php';
        require_once 'pessoa.php';

        $database = new BancoDeDados();
        $db = $database->obterConexao();

        if ($bd === null){
            die("<p class='error'>Erro: Não foi possível conectar ao banco de dados.</p>");
        }
        ?>
</body>
</html>