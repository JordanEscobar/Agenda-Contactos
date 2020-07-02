<?php
include("conexion/conexionbd.php");
$ID=$_GET['id'];
$contactos = "SELECT id,nombre,numero
             FROM Contacto WHERE id='$ID'";
$resultadocontacto=$conexion->query($contactos);
$filas=$resultadocontacto->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap4.5/css/bootstrap.min.css">
    <title>Editar Contacto</title>
</head>
<body>
    <br>
    <br>
    <div class="container navbar navbar-dark bg-primary">
            <a class="btn btn-success" href="index.php">volver</a>
        </div>
    
    <div class="container jumbotron text-center">
        <h3 class="display-2">Modificar Contacto</h3>
    <br>
    <br>
    <br>
<form action="<?php $_SERVER['PHP_SELF']?>" method="POST">
    Nombre <input type="text" name="nom" value="<?php echo $filas['nombre'];?>"  required>
    Número <input type="number" name="num" value="<?php echo $filas['numero'];?>"  required>
    <input type="hidden" name="ID" value="<?php echo $ID;?>"  required>
     <input type="submit" class="btn btn-danger" name="editar" value="Modificar">
    </form>
    </div>

    <?php
    if (isset($_POST['editar'])) {
        $nombre=$_POST['nom'];
        $numero=$_POST['num'];
        $id=$_POST['ID'];
        $sqlModificar= "UPDATE Contacto SET
                        nombre='$nombre',
                        numero='$numero'
                        WHERE id='$id'";
        $modificado=$conexion->query($sqlModificar);
        if ($modificado>0) {
            echo "<script>alert('Modificación realizada con éxito');
            window.location='index.php';</script>";
        }else{
            echo "<script>alert('Error al modificar');
            window.location='editarcontacto.php';</script>";
        }
    }
    ?>
</body>
</html>