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
                    <tr class="">
                        <td scope="row">Sas</td>
                        <td>Imagen.png</td>
                        <td>CV.pdf</td>
                        <td>Programador Jr.</td>
                        <td>17/05/2023</td>
                        <td>  <a class="btn btn-primary" href="crear.php" role="button">Carta</a> 
                            | <a class="btn btn-info" href="editar.php" role="button">Editar</a> 
                            | <a class="btn btn-danger" href=".php" role="button">Eliminar</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
    </div>
</div>

<?php include("../../templates/footer.php"); ?>
