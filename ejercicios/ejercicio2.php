<?php 
    if($_POST) {
        // Recibir informacion del formulario HTML ( POST )
        // METODO POST OCULTA Y RECEPCIONA LOS DATOS ENVIADOS
        $nombre=$_POST['txtNombre'];

        echo "Hola ".$nombre;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
</head>
<body>
    <form action="ejercicio2.php" method="post">
        Nombre:
        <input type="text" name="txtNombre" id="">
        <br>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>