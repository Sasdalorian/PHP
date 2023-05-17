<?php 
    if($_POST) {
        $valorA=$_POST['valorA'];
        $valorB=$_POST['valorB'];

        if( ($valorA != $valorB) && ($valorA > $valorB) ) {
            echo $valorA." es diferente que ".$valorB." y también es mayor <br>";
        }

        if( ($valorA != $valorB) || ($valorA > $valorB) ) {
            echo "acepto cualquiera de las dos";
        }
    };
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
    <form action="ejercicio9.php" method="post">
        Valor A:
        <input type="text" name="valorA" id="">
        Valor B:
        <input type="text" name="valorB" id="">

        <input type="submit" value="Calcular">
    </form>
</body>
</html>