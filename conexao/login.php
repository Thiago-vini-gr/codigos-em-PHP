
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-box">
        <h1>Login</h1>
        <form action="login.php" method="post">
            <label for="email_usuario">Email:</label>
            <input type="email" id="email_usuario" name="email_usuario" required>

            <label for="senha_usuario">Senha:</label>
            <input type="password" id="senha_usuario" name="senha_usuario" required>

            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>

<?php
include('conexao.php'); // Inclui a conexão com o banco de dados

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email_usuario = $_POST['email_usuario'];
    $senha_usuario = $_POST['senha_usuario'];

    // Consulta para verificar o email no banco de dados
    $sql = "SELECT senha_usuario FROM cadastro WHERE email_usuario = ?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("s", $email_usuario);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($senha_hash);
            $stmt->fetch();

            // Verifica se a senha está correta
            if (password_verify($senha_usuario, $senha_hash)) {
                echo "<script>alert('Login realizado com sucesso!'); window.location.href = 'dashboard.php';</script>";
            } else {
                echo "<script>alert('Senha incorreta!'); window.location.href = 'login.php';</script>";
            }
        } else {
            echo "<script>alert('Email não encontrado!'); window.location.href = 'login.php';</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Erro na consulta: " . $mysqli->error . "'); window.location.href = 'login.php';</script>";
    }

    $mysqli->close();
}
?>