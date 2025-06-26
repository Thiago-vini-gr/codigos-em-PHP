<?php
require_once 'conexao.php'; // Conexão com o banco de dados
require_once 'pessoa.php'; // Classe Pessoa

$database = new BancoDeDados();
$db = $database->obterConexao();

if ($db === null) {
    die("<p class='error'>Erro: Não foi possível conectar ao banco de dados.</p>");
}

$pessoa = new Pessoa($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $novaIdade = $_POST['idade'];

    if ($pessoa->altera_idade($id, $novaIdade)) {
        // Redireciona para a página listar.php após a atualização
        header("Location: listar.php");
        exit();
    } else {
        echo "<p class='error'>Erro ao atualizar a idade.</p>";
    }
} else {
    $id = $_GET['id'];
    $dadosPessoa = $pessoa->buscarPorId($id); // Supondo que você tenha uma função para buscar dados por ID
    if (!$dadosPessoa) {
        die("<p class='error'>Pessoa não encontrada.</p>");
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pessoa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Editar Pessoa</h1>
        <nav class="menu">
        <ul>
            <li><a href="index.php">Início</a></li>
            <li><a href="listar.php">Listar Pessoas</a></li>
            <li><a href="integracao.php">Cadastrar Pessoa</a></li>
        </ul>
    </nav>
    </header>
    <section>
        <form action="editar.php" method="post">
            <input type="hidden" name="id" value="<?php echo $dadosPessoa['id']; ?>">
            <label for="idade">Nova Idade:</label>
            <input type="number" id="idade" name="idade" value="<?php echo $dadosPessoa['idade']; ?>" required>
            <button type="submit">Atualizar</button>
        </form>
    </section>
</body>
</html>