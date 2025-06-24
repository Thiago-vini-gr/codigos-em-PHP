<?php
session_start();

function proteger($nivel_requerido) {
    if (!isset($_SESSION['usuario_id'])) {
        header('Location: formulario_login.html');
        exit;
    }

    if ($_SESSION['nivel_acesso'] !== $nivel_requerido) {
        echo "Acesso negado.";
        exit;
    }
}
