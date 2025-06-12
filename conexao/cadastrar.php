<?php
include ('conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $nome_usuario = $_POST['nome_usuario'];
    $contato_usuario = $_POST['contato_usuario'];
    $email_usuario = $_POST['email_usuario'];
    $senha_usuario = $_POST['senha_usuario'];

    $senha_hash = password_hash($senha_usuario, PASSWORD_DEFAULT);

    $sql = "INSERT INTO cadastro (nome_usuario, senha_usuario, email_usuario, contato_usuario) 
            VALUES (?, ?, ?, ?)";

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("ssss", $nome_usuario, $senha_hash, $email_usuario, $contato_usuario);

        if ($stmt->execute()) {
            echo "Cadastro realizado com sucesso!";
        } else {
            echo "Erro ao cadastrar: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Erro na preparação da consulta: " . $mysqli->error;
    }

}

$mysqli->close();
?>