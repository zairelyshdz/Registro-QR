<?php

require '../config/db.php';

if(isset($_POST['login'])) {

    $correo = $_POST['email'];
    $contraseña = $_POST['contraseña'];


    $sql = "SELECT * FROM usuarios WHERE correo = '$correo'";
    $resultado = mysqli_query($conexion, $sql);
    $numero_registros = mysqli_num_rows($resultado);

    if($numero_registros !=0) {
        echo "inicio de sesión exitoso" . $usuario . "!";
    } else {
        echo "Usuario no encontrado. Por favor, verifique su correo y contraseña." . "<br>";
        echo "Error al iniciar sesión" . $sql . "<br>" . mysqli_error($conexion);

        if(password_verify($contraseña, $usuario['contraseña'])) {
            session_start();
            $_SESSION['usuario'] = $usuario;
            header('Location: ../index.php');
        } else {
            echo "Contraseña incorrecta";
        }
    }
}
?>