<?php 
include("../../db.php");
  if($_POST) {
    $usuario=(isset($_POST["usuario"])?$_POST["usuario"]:"");
    $password=(isset($_POST["password"])?$_POST["password"]:"");
    $email=(isset($_POST["email"])?$_POST["email"]:"");

    $sentencia=$conexion->prepare("INSERT INTO tbl_usuarios(usuario, password, email) VALUES (:usuario, :password, :email)");
    $sentencia->bindParam(":usuario", $usuario);
    $sentencia->bindParam(":password", $password);
    $sentencia->bindParam(":email", $email);
    $sentencia->execute();
    $mensaje="Registro Agregado";
    header("Location: index.php?msg=".$mensaje);
  }
?>
<?php include("../../templates/header.php"); ?>

<br>
<div class="card">
    <div class="card-header">
        Datos del Usuario
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="usuario" class="form-label">Nombre del Usuario:</label>
              <input type="text"
                required class="form-control" name="usuario" id="usuario" placeholder="Nombre del usuario">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Contraseña:</label>
              <input type="password"
                required class="form-control" name="password" id="password" placeholder="Escriba su contraseña">
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Correo:</label>
              <input type="email"
                required class="form-control" name="email" id="email" placeholder="Escriba su correo">
            </div>

            <button type="submit" class="btn btn-success">Agregar</button>
            <a class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../templates/footer.php"); ?>