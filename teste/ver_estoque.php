<?php
require 'conexao.php';

try {
    $sql = "SELECT * FROM produtos ORDER BY id DESC";
    $stmt = $pdo->query($sql);
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro ao buscar produtos: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Estoque Atual</title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: auto;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px 12px;
        }
        th {
            background-color: #eee;
        }
        h2 {
            text-align: center;
        }
        .link-voltar {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h2>Estoque Atual</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Quantidade</th>
                <th>Data de Cadastro</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($produtos) > 0): ?>
                <?php foreach ($produtos as $produto): ?>
                    <tr>
                        <td><?= $produto['id'] ?></td>
                        <td><?= htmlspecialchars($produto['nome']) ?></td>
                        <td><?= htmlspecialchars($produto['descricao']) ?></td>
                        <td><?= $produto['quantidade'] ?></td>
                        <td><?= $produto['criado_em'] ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="6">Nenhum produto cadastrado.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="link-voltar">
        <a href="formulario_cadastro.html">Cadastrar novo produto</a>
    </div>
</body>
</html>
