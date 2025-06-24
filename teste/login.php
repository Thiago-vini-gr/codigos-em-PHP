<?php
session_start();
require 'conexao.php';

$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM usuarios WHERE email = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$email]);
$usuario = $stmt->fetch();

if ($usuario && password_verify($senha, $usuario['senha'])) {
    $_SESSION['usuario_id'] = $usuario['id'];
    $_SESSION['nome'] = $usuario['nome'];
    $_SESSION['nivel_acesso'] = $usuario['nivel_acesso'];

    // Redireciona de acordo com o nível
    if ($usuario['nivel_acesso'] === 'admin') {
        header('Location: painel_admin.php');
    } else {
        header('Location: painel_usuario.php');
    }
} else {
    echo "Login inválido.";
}
