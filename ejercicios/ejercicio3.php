<?php 
    if($_GET) {
        //METODO GET MUESTRA LOS DATOS POR URL
        $nombre=$_GET['nombre'];
        echo "Hola ".$nombre;
    }
?>