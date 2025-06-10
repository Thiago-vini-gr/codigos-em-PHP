<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funçôes</title>
</head>
<body>
    <h1>Funções</h1>
    <?php 
        function soma($i, $j){
            $k = $i + $j;
            return $k;
        }
        $res = soma(4,5);
        echo "O Resultado é ".$res;
    ?>
</body>
</html>