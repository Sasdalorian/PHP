<?php 
  include("../../db.php");
  // Recepcionamos ID para mostrar nombre e ID del usuario
  if(isset($_GET['txtID'])){
    $txtID = isset($_GET['txtID']) ?$_GET['txtID']:"";
    try {
      $sentencia = $conexion->prepare("SELECT * FROM tbl_usuarios WHERE id=:id");
      $sentencia->bindParam(":id", $txtID);
      $sentencia->execute();
      $registro=$sentencia->fetch(PDO::FETCH_LAZY);
      $usuario=$registro['usuario'];
      $password=$registro['password'];
      $email=$registro['email'];
    } catch (Exception $e) {
      echo "Ocurrió un error: " . $e->getMessage();
      exit;
    }
  }
  // Recepciona el ID para poder editarlo en la tabla
  if($_POST) {
    $txtID = isset($_POST['txtID']) ? $_POST['txtID'] : "";
    $usuario=(isset($_POST["usuario"])?$_POST["usuario"]:"");
    $password=(isset($_POST["password"])?$_POST["password"]:"");
    $email=(isset($_POST["email"])?$_POST["email"]:"");
    $sentencia=$conexion->prepare("UPDATE tbl_usuarios SET usuario=:usuario, password=:password, email=:email WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->bindParam(":usuario", $usuario);
    $sentencia->bindParam(":password", $password);
    $sentencia->bindParam(":email", $email);
    $sentencia->execute();
    $mensaje="Registro Editado";
    header("Location: index.php?msg=".$mensaje);
}
?>
<?php include("../../templates/header.php"); ?>

<br>
<div class="card">
    <div class="card-header">
        Editar Usuario
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="txtID" class="form-label">ID:</label>
              <input type="text" value="<?php echo $txtID;?>"
                readonly class="form-control" name="txtID" id="txtID" placeholder="ID">
            </div>
            <div class="mb-3">
              <label for="usuario" class="form-label">Nombre del Usuario:</label>
              <input type="text" value="<?php echo $usuario;?>"
                required class="form-control" name="usuario" id="usuario" placeholder="Nombre del usuario">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Contraseña:</label>
              <input type="password" value="<?php echo $password;?>"
                required class="form-control" name="password" id="password" placeholder="Escriba su contraseña">
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Correo:</label>
              <input type="email" value="<?php echo $email;?>"
                required class="form-control" name="email" id="email" placeholder="Escriba su correo">
            </div>

            <button type="submit" class="btn btn-success">Editar usuario</button>
            <a class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../templates/footer.php"); ?>