<?php
require 'conexao.php';

// Dados do formulário
$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$quantidade = (int)$_POST['quantidade'];
$preco = (float)$_POST['preco'];

// Simulando usuário logado (em um sistema real, viria da sessão)
$usuario = 'admin';

try {
    // 1. Inserir produto
    $sql = "INSERT INTO produtos (nome, descricao, quantidade) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $descricao, $quantidade]);

    // 2. Obter o ID do produto inserido
    $produto_id = $pdo->lastInsertId();

    // 3. Inserir no log
    $sql_log = "INSERT INTO logs_estoque (produto_id, acao, quantidade_anterior, quantidade_atual, usuario)
                VALUES (?, 'inserir', 0, ?, ?)";
    $stmt_log = $pdo->prepare($sql_log);
    $stmt_log->execute([$produto_id, $quantidade, $usuario]);

    echo "<p>Produto <strong>$nome</strong> cadastrado com sucesso!</p>";
    echo '<a href="formulario_cadastro.html">Cadastrar outro produto</a>';
} catch (PDOException $e) {
    echo "Erro ao cadastrar produto: " . $e->getMessage();
}
?>
