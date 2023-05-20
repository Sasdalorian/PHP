<?php 
include("../../db.php");

// Eliminar Empleados
if(isset($_GET['txtID'])){
    $txtID = isset($_GET['txtID']) ? $_GET['txtID'] : "";

    try {
        $sentencia = $conexion->prepare("DELETE FROM tbl_empleados WHERE id=:id");
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();
        header("Location: index.php");
    } catch (Exception $e) {
        // Error en la ejecución de la sentencia
        echo "Ocurrió un error: " . $e->getMessage();
        exit;
    }
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
            <table class="table">
                <thead>
                    <tr>
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
                        <td scope="row"><?php echo $registro['nombre'], " ", $registro['apellidos'] ?></td>
                        <td><?php echo $registro['foto'] ?></td>
                        <td><?php echo $registro['cv'] ?></td>
                        <td><?php echo $registro['idpuesto'] ?></td>
                        <td><?php echo $registro['fechadeingreso'] ?></td>
                        <td>  <a class="btn btn-primary" href="crear.php" role="button">Carta</a> 
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
