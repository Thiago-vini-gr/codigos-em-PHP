<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Pessoas</title>
    <link rel="stylesheet" href="style.css"> 
</head>

<body>
<header>
    <h1>Lista de Pessoas</h1>
    <nav class="menu">
        <ul>
            <li><a href="index.php">Início</a></li>
            <li><a href="listar.php">Listar Pessoas</a></li>
            <li><a href="integracao.php">Cadastrar Pessoa</a></li>
        </ul>
    </nav>
</header>
    <section>
        <?php
        require_once 'conexao.php'; // Conexão com o banco de dados
        require_once 'pessoa.php'; // Classe Pessoa

        $database = new BancoDeDados(); // Instância da classe BancoDeDados
        $db = $database->obterConexao(); // Obtém a conexão com o banco de dados

        if ($db === null) { // Se a conexão falhar
            die("<p class='error'>Erro: Não foi possível conectar ao banco de dados.</p>");
        }

        $pessoa = new Pessoa($db); // Instância da classe Pessoa com a conexão do banco de dados
        $stmt = $pessoa->ler(); // Chama o método ler() para obter os dados das pessoas
        $num_linhas = $stmt->rowCount(); // Conta o número de linhas retornadas

        if ($num_linhas > 0) { // Se houver pessoas cadastradas
            while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) { // Itera sobre cada linha retornada
                echo "<div class='pessoa'>"; // Início do bloco de cada pessoa
                echo "<p>ID: " . $linha['id'] . "</p>"; // Exibe o ID da pessoa
                echo "<p>Nome: " . $linha['nome'] . "</p>"; // Exibe o nome da pessoa
                echo "<p>Idade: " . $linha['idade'] . "</p>"; // Exibe a idade da pessoa
                echo "<a href='editar.php?id=" . $linha['id'] . "' class='editar-btn'>Editar</a>"; // Botão de edição
                echo "</div>";
            }
        } else {
            echo "<p class='error'>Nenhuma pessoa encontrada.</p>"; 
        }
        ?>
    </section>
</body>

</html>