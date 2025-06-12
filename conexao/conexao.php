<?php
$hostname = "localhost";
$bancodedados = "banco_php";
$usuario = "root";
$senha = "";

$mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);

    if ($mysqli->connect_error) {
    echo "Falha na conexão:( " . $mysqli->connect_error . ")" . $mysqli->connect_errno;
} 
    else {
    
}

?>