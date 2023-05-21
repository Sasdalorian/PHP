<?php 
  include("../../db.php");
  if($_POST) {
    print_r($_POST);
    print_r($_FILES);
    $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : "";
    $apellidos = isset($_POST["apellidos"]) ? $_POST["apellidos"] : "";
    $foto = isset($_FILES["foto"]["name"]) ? $_FILES["foto"]["name"] : "";
    $cv = isset($_FILES["cv"]["name"]) ? $_FILES["cv"]["name"] : "";
    $idpuesto = isset($_POST["idpuesto"]) ? $_POST["idpuesto"] : "";
    $fechaingreso = isset($_POST["fechadeingreso"]) ? $_POST["fechadeingreso"] : "";
    
    $sentencia = $conexion->prepare("INSERT INTO tbl_empleados(nombre, apellidos, foto, cv, idpuesto, fechadeingreso) VALUES (:nombre, :apellidos, :foto, :cv, :idpuesto, :fechadeingreso)");
    $sentencia->bindParam(":nombre", $nombre);
    $sentencia->bindParam(":apellidos", $apellidos);

    // Creando nombre por fecha a la foto
    $fecha= new DateTime();
    $nombreArchivo_foto=($foto!='')?$fecha->getTimestamp()."_".$_FILES["foto"]["name"]:"";
    // crear un archivo temporal para moverlo a un nuevo destino
    $tmp_foto=$_FILES["foto"]['tmp_name'];
    if($tmp_foto!=""){
      move_uploaded_file($tmp_foto, "./".$nombreArchivo_foto);
    }

    $nombreArchivo_cv=($cv!='')?$fecha->getTimestamp()."_".$_FILES["cv"]["name"]:"";
    // crear un archivo temporal para moverlo a un nuevo destino
    $tmp_cv=$_FILES["cv"]['tmp_name'];
    if($tmp_cv!=""){
      move_uploaded_file($tmp_cv, "./".$nombreArchivo_cv);
    }

    $sentencia->bindParam(":foto", $nombreArchivo_foto);
    $sentencia->bindParam(":cv", $nombreArchivo_cv);


    $sentencia->bindParam(":idpuesto", $idpuesto);
    $sentencia->bindParam(":fechadeingreso", $fechaingreso);
    $sentencia->execute();
    header("Location:index.php");
  }

$sentencia = $conexion->prepare("SELECT * FROM tbl_puestos");
$sentencia->execute();
$lista_tbl_puestos= $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
<?php include("../../templates/header.php"); ?>
<br>
<div class="card">
    <div class="card-header">
        Datos del Empleado
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="" class="form-label">Nombre:</label>
              <input required type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre">
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Apellidos:</label>
              <input required type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Apellidos">
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Foto:</label>
              <input required type="file" class="form-control" name="foto" id="foto">
            </div>
            <div class="mb-3">
              <label for="" class="form-label">CV (PDF)</label>
              <input required type="file" class="form-control" name="cv" id="cv">
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
              <input required type="date" class="form-control" name="fechadeingreso" id="fechadeingreso" aria-describedby="emailHelpId" placeholder="Fecha de ingreso a la empresa">
            </div>

            <button type="submit" class="btn btn-success">Agregar Registro</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>
    </div>

    <div class="card-footer text-muted"></div>
</div>

<?php include("../../templates/footer.php"); ?>