<?php 
    include("../../db.php");
    if(isset($_GET['txtID'])){
        $txtID = isset($_GET['txtID']) ? $_GET['txtID'] : "";
        try {
            $sentencia = $conexion->prepare("SELECT * FROM tbl_empleados WHERE id=:id");
            $sentencia->bindParam(":id", $txtID);
            $sentencia->execute();
            $registro=$sentencia->fetch(PDO::FETCH_LAZY);

            $nombre=$registro['nombre'];
            $apellidos=$registro['apellidos'];
            $foto=$registro['foto'];
            $cv=$registro['cv'];
            $idpuesto=$registro['idpuesto'];
            $fechadeingreso=$registro['fechadeingreso'];
        } catch (Exception $e) {
            // Error en la ejecución de la sentencia
            echo "Ocurrió un error: " . $e->getMessage();
            exit;
        }
    }

    $sentencia = $conexion->prepare("SELECT * FROM tbl_puestos");
    $sentencia->execute();
    $lista_tbl_puestos= $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
<?php include("../../templates/header.php"); ?>

<br>
<div class="card">
    <div class="card-header">
        Editar datos del Empleado
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="" class="form-label">Nombre:</label>
              <input value="<?php echo $nombre?>" required type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre">
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Apellidos:</label>
              <input value="<?php echo $apellidos?>" required type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Apellidos">
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Foto:</label>
              <input required type="file" class="form-control" name="foto" id="foto">
            </div>
            <div class="mb-3">
              <label for="" class="form-label">CV (PDF)</label>
              <input value="<?php echo $cv?>" required type="file" class="form-control" name="cv" id="cv">
            </div>
            <div class="mb-3">
                <label for="idpuesto" class="form-label">Puesto:</label>

                <select required class="form-select form-select-sm" name="idpuesto" id="idpuesto">
                  <option selected>Select One</option>
                  <?php  foreach($lista_tbl_puestos as $registro) { ?>
                    <option value="<?php echo $registro['id']?>"><?php echo $registro['nombredelpuesto']?></option>
                  <?php } ?>
                </select>
            </div>
            <div class="mb-3">
              <label for="fechadeingreso" class="form-label">Fecha de ingreso:</label>
              <input value="<?php echo $fechadeingreso?>" required type="date" class="form-control" name="fechadeingreso" id="fechadeingreso" aria-describedby="emailHelpId" placeholder="Fecha de ingreso a la empresa">
            </div>

            <button type="submit" class="btn btn-success">Agregar Registro</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>
    </div>

    <div class="card-footer text-muted"></div>
</div>

<?php include("../../templates/footer.php"); ?>