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
                class="form-control" name="usuario" id="usuario" placeholder="Nombre del usuario">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Contraseña:</label>
              <input type="password"
                class="form-control" name="password" id="password" placeholder="Escriba su contraseña">
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Correo:</label>
              <input type="email"
                class="form-control" name="email" id="email" placeholder="Escriba su correo">
            </div>

            <button type="submit" class="btn btn-success">Agregar</button>
            <a class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../templates/footer.php"); ?>