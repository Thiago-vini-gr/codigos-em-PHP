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