<?php 
    include("../../db.php");

    // Recepcionamos ID para mostrar nombre e ID del puesto
    if(isset($_GET['txtID'])){
        $txtID = isset($_GET['txtID']) ? $_GET['txtID'] : "";
        try {
            $sentencia = $conexion->prepare("SELECT * FROM tbl_puestos WHERE id=:id");
            $sentencia->bindParam(":id", $txtID);
            $sentencia->execute();
            $registro=$sentencia->fetch(PDO::FETCH_LAZY);
            $nombredelpuesto=$registro['nombredelpuesto'];
        } catch (Exception $e) {
            // Error en la ejecución de la sentencia
            echo "Ocurrió un error: " . $e->getMessage();
            exit;
        }
    }
    // Recepciona el ID para poder editarlo en la tabla
    if($_POST) {
        $txtID = isset($_POST['txtID']) ? $_POST['txtID'] : "";
        $nombredelpuesto=(isset($_POST["nombredelpuesto"])?$_POST["nombredelpuesto"]:"");
        $sentencia=$conexion->prepare("UPDATE tbl_puestos SET nombredelpuesto=:nombredelpuesto WHERE id=:id");
        $sentencia->bindParam(":nombredelpuesto", $nombredelpuesto);
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();
        header("Location:index.php");
    }
?>
<?php include("../../templates/header.php"); ?>

<br>

<div class="card">
    <div class="card-header">
        Editar Puesto
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">

            <div class="mb-3">
              <label for="txtID" class="form-label">ID: </label>
              <input readonly type="text" value="<?php echo $txtID;?>" 
                class="form-control" name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">
            </div>
            
            <div class="mb-3">
              <label for="nombredelpuesto" class="form-label">Nombre del Puesto:</label>
              <input type="text" value="<?php echo $nombredelpuesto;?>"
                class="form-control" name="nombredelpuesto" id="nombredelpuesto" placeholder="Nombre del puesto">
            </div>

            <button type="submit" class="btn btn-success">Editar</button>
            <a class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../templates/footer.php"); ?>