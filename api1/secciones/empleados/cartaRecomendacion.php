<?php 
    include("../../db.php");
// Recepcionamos ID para mostrar nombre e ID del puesto
if(isset($_GET['txtID'])){
    $txtID = isset($_GET['txtID']) ? $_GET['txtID'] : "";
    try {
        $sentencia = $conexion->prepare("SELECT * FROM tbl_empleados WHERE id=:id");
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();
        $registro=$sentencia->fetch(PDO::FETCH_LAZY);

        $nombre=$registro['nombre'];
        $apellidos=$registro['apellidos'];

        $nombreCompleto= $nombre." ".$apellidos;

        $foto=$registro['foto'];
        $cv=$registro['cv'];
        $idpuesto=$registro['idpuesto'];
        $fechadeingreso=$registro['fechadeingreso'];

        $fechaInicio= new Datetime($fechadeingreso);
        $fechaFin= new DateTime(date("Y-m-d"));
        $diferencia=date_diff($fechaInicio, $fechaFin);

        print_r($registro);
        
    } catch (Exception $e) {
        // Error en la ejecución de la sentencia
        echo "Ocurrió un error: " . $e->getMessage();
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carta de Recomendacion</title>
</head>
<body>
    <h1>Carta de Recomendación Laboral</h1>
    <br><br>
    22/05/2023
    <br><br>
    Estimado/a a quien pueda interesar:
    <br><br>
    Me complace recomendar sinceramente a <?php echo $nombreCompleto?> para todo. Durante nuestros <?php echo $diferencia->y;?> año/s de colaboracion, he sido testigo de su dedicación y habilidades excepcionales como <?php echo $idpuesto ?>, talento. <?php echo $nombreCompleto?> es un/a diamante en bruto, un individuo con una fuerte ética laboral y una actitud positiva.
    <br>
    Estoy convencido/a de que <?php echo $nombreCompleto?> será un/a activo/a valioso/a para su trabajo. Si necesitas más información, no dudes en contactarme.
    <br><br><br>
Atentamente,
<br><br>
    Ing. Italo Pasalacua
</body>
</html>