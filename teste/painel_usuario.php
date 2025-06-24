<?php
require 'proteger.php';
proteger('usuario'); // ou permitir vários: if in_array($_SESSION['nivel_acesso'], [...])
?>

<h2>Painel do Usuário</h2>
<p>Olá, <?= $_SESSION['nome'] ?>!</p>
<a href="logout.php">Sair</a>
