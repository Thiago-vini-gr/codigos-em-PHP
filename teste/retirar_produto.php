<?php
require 'conexao.php';

$produto = null;
$mensagem = '';

// Se enviou o formulário de busca
if (isset($_POST['buscar'])) {
    $busca = trim($_POST['busca']);
    if (!empty($busca)) {
        $sql = "SELECT * FROM produtos WHERE id = ? OR nome LIKE ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$busca, "%$busca%"]);
        $produto = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$produto) {
            $mensagem = "Produto não encontrado.";
        }
    } else {
        $mensagem = "Informe um ID ou nome para buscar.";
    }
}

// Se enviou o formulário de retirada
if (isset($_POST['retirar'])) {
    $produto_id = intval($_POST['produto_id']);
    $quantidade_retirada = intval($_POST['quantidade']);

    // Buscar o produto para validar quantidade
    $sql = "SELECT * FROM produtos WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$produto_id]);
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$produto) {
        $mensagem = "Produto não encontrado.";
    } elseif ($quantidade_retirada <= 0) {
        $mensagem = "Quantidade inválida.";
    } elseif ($produto['quantidade'] < $quantidade_retirada) {
        $mensagem = "Quantidade insuficiente em estoque. Estoque atual: {$produto['quantidade']}.";
    } else {
        // Atualiza o estoque
        $nova_quantidade = $produto['quantidade'] - $quantidade_retirada;
        $sql = "UPDATE produtos SET quantidade = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nova_quantidade, $produto_id]);

        // Registra no log
        $sql = "INSERT INTO logs (produto_id, tipo, quantidade, data) VALUES (?, 'retirada', ?, NOW())";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$produto_id, $quantidade_retirada]);

        $mensagem = "Retirada realizada com sucesso! Estoque atual: $nova_quantidade.";
        // Atualiza variável $produto para refletir novo estoque
        $produto['quantidade'] = $nova_quantidade;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Retirar Produto do Estoque</title>
</head>
<body>
    <h2>Retirar Produto do Estoque</h2>

    <form method="post">
        <label>Buscar por ID ou Nome:</label><br>
        <input type="text" name="busca" value="<?= isset($_POST['busca']) ? htmlspecialchars($_POST['busca']) : '' ?>" required>
        <button type="submit" name="buscar">Buscar</button>
    </form>

    <hr>

    <?php if ($mensagem): ?>
        <p><strong><?= htmlspecialchars($mensagem) ?></strong></p>
    <?php endif; ?>

    <?php if ($produto): ?>
        <h3>Produto encontrado:</h3>
        <p><strong>ID:</strong> <?= $produto['id'] ?></p>
        <p><strong>Nome:</strong> <?= htmlspecialchars($produto['nome']) ?></p>
        <p><strong>Quantidade em estoque:</strong> <?= $produto['quantidade'] ?></p>

        <form method="post">
            <input type="hidden" name="produto_id" value="<?= $produto['id'] ?>">
            <label>Quantidade a retirar:</label><br>
            <input type="number" name="quantidade" min="1" max="<?= $produto['quantidade'] ?>" required><br><br>
            <button type="submit" name="retirar">Retirar</button>
        </form>
    <?php endif; ?>

    <p><a href="ver_estoque.php">Voltar ao Estoque</a></p>
</body>
</html>
