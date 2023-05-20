<?php 
include("../../db.php");
if($_POST) {
    // Recolectar los datos de POST
    $nombredelpuesto=(isset($_POST["nombredelpuesto"])?$_POST["nombredelpuesto"]:"");
    // Preparar la inseccion de datos
    $sentencia=$conexion->prepare("INSERT INTO tbl_puestos(nombredelpuesto) VALUES (:nombredelpuesto)");
    // Asignando valores que vienen de POST
    $sentencia->bindParam(":nombredelpuesto", $nombredelpuesto);
    $sentencia->execute();
    header("Location:index.php");
}   

?>
<?php include("../../templates/header.php"); ?>
<br>

<div class="card">
    <div class="card-header">
        Puesto
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="nombredelpuesto" class="form-label">Nombre del Puesto:</label>
              <input type="text"
                required class="form-control" name="nombredelpuesto" id="nombredelpuesto" placeholder="Nombre del puesto">
            </div>

            <button type="submit" class="btn btn-success">Agregar</button>
            <a class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../templates/footer.php"); ?>