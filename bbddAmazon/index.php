<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <?php require 'bbdd_Amazon.php' ?>

</head>
<body>
    <?php
        session_start();
        if(isset($_SESSION["usuario"])){
            $usuario = $_SESSION["usuario"];
        }else{
            //header ('location: iniciar_sesion.php'); # Si queremos que nos redirija al login
            $_SESSION["usuario"] = "invitado";
            $usuario = $_SESSION["usuario"];
        }
    ?>

        <div class="container">
            <h1>PAGINA PRINCIPAL</h1>
            <h2>Bienvenid@ <?php echo $usuario ?></h2>
        </div>

        <div class="container">
        <h1>Lista de Productos</h1>
        <table class="table table-striped" style="border: 1px solid black">
            <thead class="table table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Descripción</th>
                    <th>Stock</th>
                </tr>
            </thead>
            <tbody>
    <?php
    $sql = "SELECT * FROM productos";
    $resultado = $conexion ->query($sql); /*pa conectarte a la base de datos*/ 

    while($fila = $resultado -> fetch_assoc()){ /*pilla una fila y hace un array (clave = nombre variable y valor = datos)*/ 
        echo "
            <tr>
                <td>".$fila["idProducto"]."</td>
                <td>".$fila["nombreProducto"]."</td>
                <td>".$fila["precio"]."</td>
                <td>".$fila["descripcion"]."</td>
                <td>".$fila["cantidad"]."</td>";

                ?>
               <!--  <td>
                    <img width="50px" height="50px" src="<?php /*echo $fila["imagen"] */?>">
                </td> -->

                <?php
                    echo "</tr>";
                    echo "<br>";
    }
                ?>
    </tbody> 
    </table>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>