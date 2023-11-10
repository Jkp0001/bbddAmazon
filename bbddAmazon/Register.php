<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <?php require '../user/util.php' ?>
    <?php require 'bbdd_Amazon.php' ?>
</head>
<body>
    <?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $temp_usuario = depurar($_POST["usuario"]);
        $temp_contrasena = depurar($_POST["contrasena"]);
        $temp_edad = depurar($_POST["edad"]);

        #Validación del usuario
        if(strlen($temp_usuario)==0){ // CONTROLO QUE EL STRING LENGTH no sea 0
            $err_usuario = "Usuario vacío";
        }else{
            $regex = '/^[a-zA-Z_]+$/'; // se permite letras y _
            if(!preg_match($regex, $temp_usuario)){ //CONTROLO QUE EL PATRÓN SE CUMPLE
                $err_usuario = "El nombre del producto debe contener mínimo 4 carácteres y un máximo de 12 carácteres.";
            }else{
                $usuario = $temp_usuario;
            }
        }

        #Validación del contraseña
        echo $temp_contrasena;
        if(strlen($temp_contrasena)==0 || strlen($temp_contrasena)>255){
            $err_contrasena = "La contraseña no puede estar vacía ni ocupar más de 255 caractéres";
        }else{
            $contrasena = password_hash($temp_contrasena,PASSWORD_DEFAULT);
        }
        
        #Validación de la edad
        if(strlen($temp_edad)==0){
            $err_edad = "La fecha es obligatoria";
        }else{
            $fechaActual = date("Y-m-d");
            list($anio_actual, $mes_actual, $dia_actual) = explode('-', $fechaActual);
            list($anio_nacimiento, $mes_nacimiento, $dia_nacimiento) = explode('-', $temp_edad);

            if(($anio_actual - $anio_nacimiento <12) || ($anio_actual - $anio_nacimiento >120)){
                $err_edad = "No puede ser menor de 12 años o mayor de 120 años";
            }elseif($anio_actual - $anio_nacimiento == 12){
                if($mes_actual- $mes_nacimiento < 0){
                    $err_edad = "No puede ser menor de edad";
                }elseif($mes_actual - $mes_nacimiento == 0){
                    if($dia_actual - $dia_nacimiento <0){
                        $err_edad = "No puede ser menor de edad";
                    }else{
                        $edad = $temp_edad;
                    }
                }elseif($mes_actual - $mes_nacimiento > 0){
                    $edad = $temp_edad;
                }
            }elseif(($anio_actual - $anio_nacimiento >12) || ($anio_actual - $anio_nacimiento <120)){
                $edad = $temp_edad;
            }
        }

    }
    ?>

    <form action="" method="post">
        <label>Usuario: </label>
        <input type="text" name="usuario">
        <?php if(isset($err_usuario)) echo $err_usuario ?>
        <br>
        <label>Contraseña: </label>
        <input type="password" name="contrasena">
        <?php if(isset($err_contrasena)) echo $err_contrasena; ?>
        <br>
        <label>Año de Nacimiento: </label>
        <input type="date" name="edad"><br>        
        <?php if(isset($err_edad)) echo $err_edad ?>
        <br><br>

        <input type="submit" value="Enviar">
    </form>

    <?php 
        if(isset($usuario) && isset($contrasena) && isset($edad)) {
            echo "<h3>$usuario</h3>";
            echo "<h3>$contrasena</h3>";
            echo "<h3>$edad</h3>";
            
        
            $sql_Usuario = "INSERT INTO Usuarios (usuario,contrasena,fechaNacimiento) VALUES ('$usuario','$contrasena','$edad')";
            $sql_Cestas = "INSERT INTO Cestas (usuario,precioTotal) VALUES ('$usuario',0)";
            $conexion->query($sql_Usuario);
            $conexion->query($sql_Cestas);
        }
    ?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>