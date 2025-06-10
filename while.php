<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>estrutura de controle</title>
</head>
<body>
    <h1>While</h1>
    numeros pares ate dez:
    <?php 
        $i = 2;
        while ($i <= 10) {
            echo $i . " , ";
            $i = $i + 2; 
        }
    ?>
</body>
</html>