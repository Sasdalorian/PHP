<?php 
include("../../db.php");

// Eliminar Empleados
if(isset($_GET['txtID'])){
    $txtID = isset($_GET['txtID']) ? $_GET['txtID'] : "";
    try {
        $sentencia=$conexion->prepare("SELECT foto,cv FROM tbl_empleados WHERE id=:id");
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();
        $registroRecuperado=$sentencia->fetch(PDO::FETCH_LAZY);
        if(isset($registroRecuperado["foto"]) && $registroRecuperado["foto"]!=""){
            if(file_exists("./".$registroRecuperado['foto'])){
                unlink("./".$registroRecuperado['foto']);
            };
        };
        if(isset($registroRecuperado["cv"]) && $registroRecuperado["cv"]!=""){
            if(file_exists("./".$registroRecuperado['cv'])){
                unlink("./".$registroRecuperado['cv']);
            };
        };

        $sentencia = $conexion->prepare("DELETE FROM tbl_empleados WHERE id=:id");
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();
        header("Location: index.php");

    } catch (Exception $e) {
        // Error en la ejecución de la sentencia
        echo "Ocurrió un error: " . $e->getMessage();
        exit;
    };
}

// Mostrar Empleados
$sentencia = $conexion->prepare("SELECT * FROM tbl_empleados");
$sentencia->execute();
$lista_tbl_empleados= $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
<?php include("../../templates/header.php"); ?>

<br>
<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar Registro</a>
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table" id="tablaID">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Foto</th>
                        <th scope="col">CV</th>
                        <th scope="col">Puesto</th>
                        <th scope="col">Fecha Ingreso</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($lista_tbl_empleados as $registro) { ?>
                    <tr class="">
                        <td><?php echo $registro['id'] ?></td>
                        <td><?php echo $registro['nombre'], " ", $registro['apellidos'] ?></td>
                        <td>
                            <img width="70" src="<?php echo $registro['foto'];?>" class="img-fluid rounded-top" alt="No se ha podido cargar la foto.">
                        <td><a href="<?php echo $registro['cv'] ?>"><?php echo $registro['cv'] ?></a></td>
                        <td><?php echo $registro['idpuesto'] ?></td>
                        <td><?php echo $registro['fechadeingreso'] ?></td>
                        <td>  <a class="btn btn-primary" href="cartaRecomendacion.php?txtID=<?php echo $registro['id']?>" role="button">Carta</a> 
                            | <a class="btn btn-info" href="editar.php?txtID=<?php echo $registro['id']?>" role="button">Editar</a>
                            | <a class="btn btn-danger" href="index.php?txtID=<?php echo $registro['id']?>" role="button">Eliminar</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        
    </div>
</div>

<?php include("../../templates/footer.php"); ?>
