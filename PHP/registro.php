<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require '../config/db.php';

//se verifica si se ha enviado el formulario
if (isset($_POST['enviar'])) {
    //se obtienen los datos del formulario
    $nombre = $_POST['Nombre'];
    $apellido = $_POST['Apellido'];
    $correo = $_POST['email'];
    $contraseña = $_POST['Contraseña'];
    $fecha_nacimiento = $_POST ['fecha_nacimiento'];	
    $cedula = $_POST ['cedula'];
    $año = $_POST ['Año'];
    $seccion = $_POST ['Sección'];
    $genero = $_POST ['Género'];

// Verificar si el correo o la cédula ya existen
$sql_check = "SELECT * FROM usuarios WHERE email='$correo' OR cedula='$cedula'";
$resultado_check = mysqli_query($conexion, $sql_check);

if (mysqli_num_rows($resultado_check) > 0) {
    echo "El correo o la cédula ya están registrados.";
} else {
    //se prepara la consulta
    $sql = "INSERT INTO usuarios (nombre, apellido, email, contraseña, fecha_nacimiento, cedula, año, seccion, genero) VALUES ('$nombre', '$apellido', '$correo', '$contraseña', '$fecha_nacimiento', '$cedula', '$año', '$seccion', '$genero')";

    $resultado = mysqli_query($conexion, $sql);
        if ($resultado) {
            // Redirigir al usuario al login
            header("Location: ../login.html");
            exit();
        } else {
            echo "No se pudo registrar";
            echo "Error al registrarse: " . $sql . "<br>" . mysqli_error($conexion);
        }
    }
}
?>
?>