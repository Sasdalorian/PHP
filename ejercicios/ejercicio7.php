<?php 
    if($_POST) {
        $valorA=$_POST['valorA'];
        $valorB=$_POST['valorB'];

        $suma= $valorA + $valorB;
        $resta= $valorA - $valorB;
        $multiplicar= $valorA * $valorB;
        $dividir= $valorA / $valorB;

        echo "Suma: ".$suma."<br>";
        echo "Resta: ".$resta."<br>";
        echo "Multiplicacion: ".$multiplicar."<br>";
        echo "Divicion: ".$dividir."<br>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operadores Aritmeticos</title>
</head>
<body>
    <form action="ejercicio7.php" method="post">
        Valor A:
        <input type="text" name="valorA" id="">
        Valor B:
        <input type="text" name="valorB" id="">

        <input type="submit" value="Calcular">
    </form>
</body>
</html>