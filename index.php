<?php
include("conexion/conexionbd.php");
if (!empty($_POST)) {
$nombre = mysqli_real_escape_string($conexion,$_POST['nom']);
$numero = mysqli_real_escape_string($conexion,$_POST['num']);

$vercontacto = "SELECT id,nombre,numero 
                    FROM Contacto 
                    WHERE numero = '$numero' ";
    $existecontacto = $conexion->query($vercontacto);
    $filas = $existecontacto->num_rows;
    if ($filas > 0) {
        echo "<script> alert('Contacto existe'); 
        window.location='index.php'; </script>";
    }
    else{
        $sqlcontacto="INSERT INTO Contacto(
            nombre,numero)
            VALUES ('$nombre','$numero')";
            $resultadocontacto=$conexion->query($sqlcontacto);
            if ($resultadocontacto>0) {
                echo "<script> alert('Registro exitoso');
                window.location='index.php';</script>";
            }
            else{
                echo "<script> alert('Error al registrar'); 
                window.location='index.php'; </script>";
            }
    }
}
$contactos = "SELECT id,nombre,numero FROM Contacto";
             $resultadocontacto=$conexion->query($contactos);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap4.5/css/bootstrap.min.css">
    <title>Agenda de Contactos</title>
</head>
<body>
    <div class="container-fluid">
        <main class="jumbotron">
            <h1 class="display-2">Agenda de Contactos</h1>
            <br>
    <form action="<?php $_SERVER['PHP_SELF']?>" method="POST">
        Nombre <input type="text" name="nom" placeholder="Nombre del contacto" required>
        Número <input type="number" name="num" placeholder="Número telefónico" required>
        <input type="submit" class="btn btn-success" name="guardar" value="Guardar">
    </form>
            <table class="table table-hover">
        <thead class="thead-dark">
            <tr>
                <th>NOMBRE</th>
                <th>NÚMERO</th>
                <th>EDITAR</th>
                <th>ELIMINAR</th>
            </tr>
        </thead>
        <tbody class="table table-light">
           <tr>
                <?php
                while ($regcontacto = $resultadocontacto->fetch_array(MYSQLI_BOTH)) {
                    echo 
                    "<tr>
                        <td>".$regcontacto['nombre']."</td>
                        <td>".$regcontacto['numero']."</td>
                        <td><a class='btn btn-primary' href='editarcontacto.php?id=".$regcontacto['id']." '>Editar</a></td>
                        <td><a class='btn btn-danger' href='eliminarcontacto.php?id=".$regcontacto['id']." '>Eliminar</a></td>
                    </tr>";                }
                ?>
           </tr>
        </tbody>
    </table>
        </main>
        <footer class="site-footer">
            Todos los derechos reservados &copy;
        </footer>
    </div>
</body>
</html>