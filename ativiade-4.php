<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemplo com php</title>
</head>
<body>
    <h1>Dia e noite</h1>
    <?php
        date_default_timezone_set("America/Sao_Paulo");
        $hoje = date("d/m/y");
        $agora = date("H:i");
        $hora = date("H");
        if ($hora >= 4 or $hora < 13) {
            echo "<img src='img/sol.png' alt='Sol'>";
            echo " bom dia!";
        }elseif ($hora >= 13 or $hora < 18) {
            echo "<img src='img/lua.png' alt='Lua'>";
            echo " boa tarde!";
        }else {
            echo "<img src='img/lua.png' alt='Lua'";
            echo " boa noite!";
        }
            
        echo " hoje é dia ". $hoje. " e agora são ". $agora. " horas. ";
        
    ?>
</body>
</html>