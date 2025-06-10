<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estrutura de controle</title>
</head>
<body>
    <h1>Foreach</h1>
    numeros pares ate dez:
    <?php 
        $n = array(2, 4, 6, 8, 10);
        foreach ($n as $i) {
            echo $i . " , ";
        }
    ?>
</body>
</html>