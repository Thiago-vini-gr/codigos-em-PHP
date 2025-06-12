<?php
include ('conexao.php');
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Cadastro</title>
</head>
<body>
    <h2>Formulário de Cadastro</h2>
    <form action="cadastrar.php" method="post">
        <label for="nome_usuario">Nome:</label><br>
        <input type="text" id="nome_usuario" name="nome_usuario" required><br><br>

        <label for="contato_usuario">Contato:</label><br>
        <input type="text" id="contato_usuario" name="contato_usuario" required><br><br>

        <label for="email_usuario">Email:</label><br>
        <input type="email" id="email_usuario" name="email_usuario" required><br><br>

        <label for="senha_usuario">Senha:</label><br>
        <input type="password" id="senha_usuario" name="senha_usuario" required><br><br>

        <button type="submit">Cadastrar</button>
</body>
</html>