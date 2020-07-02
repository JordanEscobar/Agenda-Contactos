<?php
include("conexion/conexionbd.php");
$ID=$_GET['id'];
$eliminarcontacto="DELETE FROM Contacto
                    WHERE id='$ID'";
$resultado=$conexion->query($eliminarcontacto);
echo "<script>alert('Eliminado exitosamente');
        window.location='index.php';</script>";
$conexion->close();
?>