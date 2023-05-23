<?php 
    include("../../db.php");
    if(isset($_GET['txtID'])){
        $txtID = isset($_GET['txtID']) ? $_GET['txtID'] : "";
        try {
            $sentencia = $conexion->prepare("SELECT * FROM tbl_empleados WHERE id=:id");
            $sentencia->bindParam(":id", $txtID);
            $sentencia->execute();
            $registro=$sentencia->fetch(PDO::FETCH_LAZY);

            $sentencia->bindParam(":nombre", $nombre);
            $sentencia->bindParam(":apellidos", $apellidos);
            $sentencia->bindParam(":foto", $nombreArchivo_foto);
            $sentencia->bindParam(":cv", $nombreArchivo_cv);
            $sentencia->bindParam(":idpuesto", $idpuesto);
            $sentencia->bindParam(":fechadeingreso", $fechaingreso);

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

    if($_POST) {
      $txtID = isset($_POST['txtID']) ? $_POST['txtID'] : "";
      $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : "";
      $apellidos = isset($_POST["apellidos"]) ? $_POST["apellidos"] : "";
      $idpuesto = isset($_POST["idpuesto"]) ? $_POST["idpuesto"] : "";
      $fechaingreso = isset($_POST["fechadeingreso"]) ? $_POST["fechadeingreso"] : "";
      
      $sentencia = $conexion->prepare("
      UPDATE tbl_Empleados 
      SET
        nombre=:nombre,
        apellidos=:apellidos,
        idpuesto=:idpuesto,
        fechadeingreso=:fechadeingreso
      WHERE 
        id=:txtID
      ");
      
      $sentencia->bindParam(":txtID", $txtID);
      $sentencia->bindParam(":nombre", $nombre);
      $sentencia->bindParam(":apellidos", $apellidos);  
      $sentencia->bindParam(":idpuesto", $idpuesto);
      $sentencia->bindParam(":fechadeingreso", $fechaingreso);
      $sentencia->execute();


      $foto = isset($_FILES["foto"]["name"]) ? $_FILES["foto"]["name"] : "";
      $fecha= new DateTime();
      $nombreArchivo_foto=($foto!='')?$fecha->getTimestamp()."_".$_FILES["foto"]["name"]:"";
      $tmp_foto=$_FILES["foto"]['tmp_name'];
      if($tmp_foto!=""){
        move_uploaded_file($tmp_foto, "./".$nombreArchivo_foto);

        // ELIMINAR FOTO ANTERIOR de DB
        $sentencia=$conexion->prepare("SELECT foto FROM tbl_empleados WHERE id=:id");
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();
        $registroRecuperado=$sentencia->fetch(PDO::FETCH_LAZY);
        if(isset($registroRecuperado["foto"]) && $registroRecuperado["foto"]!=""){
            if(file_exists("./".$registroRecuperado['foto'])){
                unlink("./".$registroRecuperado['foto']);
            };
        };
        
        // SUBIR NUEVA FOTO a DB
        $sentencia = $conexion->prepare("UPDATE tbl_Empleados SET foto=:foto WHERE id=:id");
        $sentencia->bindParam(":foto", $nombreArchivo_foto);
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();
      }

      $cv = isset($_FILES["cv"]["name"]) ? $_FILES["cv"]["name"] : "";
      $nombreArchivo_cv=($cv!='')?$fecha->getTimestamp()."_".$_FILES["cv"]["name"]:"";
      $tmp_cv=$_FILES["cv"]['tmp_name'];
      if($tmp_cv!=""){
        move_uploaded_file($tmp_cv, "./".$nombreArchivo_cv);
        
        // Buscar archivo relacionado con empleado
        $sentencia=$conexion->prepare("SELECT cv FROM tbl_empleados WHERE id=:id");
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();
        $registroRecuperado=$sentencia->fetch(PDO::FETCH_LAZY);

        if(isset($registroRecuperado["cv"]) && $registroRecuperado["cv"]!=""){
          if(file_exists("./".$registroRecuperado['cv'])){
              unlink("./".$registroRecuperado['cv']);
          };
        };
      };
        // Actualizar CV solo si se seleccionó un archivo en el formulario
        if ($cv != "") {
          // Actualizar el nombre del CV en la base de datos
          $sentencia = $conexion->prepare("UPDATE tbl_empleados SET cv=:cv WHERE id=:id");
          $sentencia->bindParam(":cv", $nombreArchivo_cv);
          $sentencia->bindParam(":id", $txtID);
          $sentencia->execute();
        }
        $mensaje="Registro Editado";
        header("Location: index.php?msg=".$mensaje);
    }     
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
              <label for="txtID" class="form-label">ID: </label>
              <input readonly type="text" value="<?php echo $txtID;?>" class="form-control" name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Nombre:</label>
              <input value="<?php echo $nombre?>" type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre">
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Apellidos:</label>
              <input value="<?php echo $apellidos?>" type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Apellidos">
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Foto:</label><br>
              <img style="padding-bottom:.5rem" width="200" src="<?php echo $registro['foto'];?>" class="img-fluid rounded-top" alt="No se ha podido cargar la foto.">
              <input type="file" class="form-control" name="foto" id="foto">
            </div>
            <div class="mb-3">
              <label for="" class="form-label">CV (PDF):</label>
              <a target="_blank" href="<?php echo $cv;?>"><?php echo $cv;?></a>
              <input type="file" class="form-control" name="cv" id="cv">
            </div>
            <div class="mb-3">
                <label for="idpuesto" class="form-label">Puesto:</label>
                <select class="form-select form-select-sm" name="idpuesto" id="idpuesto">
                    <?php  foreach($lista_tbl_puestos as $registro) { ?>
                  <option <?php echo ($idpuesto== $registro['id'])?"selected":"";?> value="<?php echo $registro['id']?>">
                  <?php echo $registro['nombredelpuesto']?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
              <label for="fechadeingreso" class="form-label">Fecha de ingreso:</label>
              <input value="<?php echo $fechadeingreso?>" type="date" class="form-control" name="fechadeingreso" id="fechadeingreso" aria-describedby="emailHelpId" placeholder="Fecha de ingreso a la empresa">
            </div>

            <button type="submit" class="btn btn-success">Editar Empleado</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>
    </div>

    <div class="card-footer text-muted"></div>
</div>

<?php include("../../templates/footer.php"); ?>