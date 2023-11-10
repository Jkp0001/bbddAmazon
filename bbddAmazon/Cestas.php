<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require '../user/util.php' ?>
    <?php require 'bbdd_Amazon.php' ?>
    <title>Cesta</title>
</head>
<body>
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $temp_usuario = depurar($_POST["usuario"]);
            $temp_precioTotal = depurar($_POST["precioTotal"]);
        }
    ?>
    
</body>
</html>