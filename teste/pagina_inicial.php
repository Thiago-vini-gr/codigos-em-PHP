<?php
require 'proteger.php';
proteger('usuario');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Página Inicial</title>
</head>
<body>
    <h2>Bem-vindo(a), <?= $_SESSION['nome'] ?>!</h2>
    <p>Nível de acesso: <strong><?= $_SESSION['nivel_acesso'] ?></strong></p>

    <?php if ($_SESSION['nivel_acesso'] === 'admin'): ?>
        <p><a href="painel_admin.php">Ir para o Painel de Admin</a></p>
    <?php endif; ?>

    <p><a href="logout.php">Sair</a></p>
</body>
</html>
