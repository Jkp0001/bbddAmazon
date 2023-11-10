<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php require 'util.php' ?>
    <?php require 'BaseDeDatos.php' ?>

</head>
<body>
    <?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $temp_usuario = depurar($_POST["usuario"]);
        $temp_nombre = depurar($_POST["nombre"]);
        $temp_apellido = depurar($_POST["apellido"]);
        $temp_edad = depurar($_POST["edad"]);


        #Validación del user
        if(strlen($temp_usuario)==0){ // CONTROLO QUE EL TRING LENGTH
            $err_usuario = "El nombre del usuario es obligatorio";
        }else{
            $regex = "/^[a-zA-Z_][a-zA-Z0-9_]{3,7}$/"; //empieza por 1 letra min o mayusq o _ y despues tiene k tener entre 3 y 7 letras, num o _
            if(!preg_match($regex, $temp_usuario)){ //CONTROLO QUE EL PATRÓN SE CUMPLE
                $err_usuario = "El nombre de usuario debe contener de 4 a 8 caracteres o números o barrabaja";
            }else{
                $usuario = $temp_usuario;
            }
        }


        #Validación del nombre
        if(strlen($temp_nombre)==0){
            $err_nombre = "El nombre del usuario es obligatorio";
        }else{
            $regex ="/^[a-zA-Z\s]{2,20}$/";
            if(!preg_match($regex, $temp_nombre)){
                $err_nombre = "El nombre de usuario debe contener de 2 a 20 caracteres";
            }else{
                $nombre = $temp_nombre;
            }
        }
        #Validación del apellido
        if(strlen($temp_apellido)==0){
            $err_apellido = "El Apellido es obligatorio";
        }else{
            $regex ="/^[a-zA-Z\s]{2,40}$/";
            if(!preg_match($regex, $temp_apellido)){
                $err_apellido = "El Apellido debe contener de 2 a 40 caracteres";
            }else{
                $apellido = $temp_apellido;
            }
        }
        #Validación de la fecha
        
        if(strlen($temp_edad)==0){
            $err_edad = "La fecha es obligatoria";
        }else{
            $fechaActual = date("Y-m-d");
            list($anio_actual, $mes_actual, $dia_actual) = explode('-', $fechaActual);
            list($anio_nacimiento, $mes_nacimiento, $dia_nacimiento) = explode('-', $temp_edad);

            if($anio_actual - $anio_nacimiento <18){
                $err_edad = "No puede ser menor de edad";
            }elseif($anio_actual - $anio_nacimiento == 18){
                if($mes_actual- $mes_nacimiento < 0){
                    $err_edad = "No puede ser menor de edad";
                }elseif($mes_actual - $mes_nacimiento == 0){
                    if($dia_actual - $dia_nacimiento <0){
                        $err_edad = "No puede ser menor de edad";
                    }else{
                        $edad = $tem_edad;
                    }
                }elseif($mes_actual - $mes_nacimiento > 0){
                    $edad = $tem_edad;
                }
            }elseif($anio_actual - $anio_nacimiento >18){
                $edad = $tem_edad;
            }
        }
    }
    ?>
    <form action="" method="post">
        <label>Usuario: </label>
        <input type="text" name="usuario">
        <?php if(isset($err_usuario)) echo $err_usuario ?>
        <br>
        <label>Nombre: </label>
        <input type="text" name="nombre">
        <?php if(isset($err_nombre)) echo $err_nombre ?>
        <br>
        <label>Apellido: </label>
        <input type="text" name="apellido"><br>        
        <?php if(isset($err_apellido)) echo $err_apellido ?>
        <br>
        <label>Fecha de Nacimiento: </label>
        <input type="date" name="edad"><br>        
        <?php if(isset($err_edad)) echo $err_edad ?>
        <br><br>
        <input type="submit" value="Enviar">
    </form>
    <?php if(isset($usuario) && isset($nombre) && isset($apellido) && isset($edad)) {
        echo "<h3>$usuario</h3>";
        echo "<h3>$nombre</h3>";
        echo "<h3>$apellido</h3>";
        echo "<h3>$edad</h3>";
        }
    
        $sql = "INSERT INTO usuarios (usuario,nombre,apellidos) VALUES ('$usuario','$nombre','$apellido')";

        $conexion->query($sql);
    ?>
</body>
</html>