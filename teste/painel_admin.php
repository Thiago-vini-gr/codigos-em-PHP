<?php
require 'proteger.php';
proteger('admin');
?>

<h2>Painel do Administrador</h2>
<p>Bem-vindo, <?= $_SESSION['nome'] ?>!</p>
<a href="logout.php">Sair</a>
