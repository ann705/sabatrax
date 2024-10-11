<?php
include("coxecion.php");

$Nombre = $_POST['Nombre'];
$Clave = $_POST['Clave'];

// Verificar si el usuario y contraseña coinciden
$validar_login = mysqli_query($conexion, "SELECT * FROM usuarios WHERE Nombre ='$Nombre' AND Clave ='$Clave'");

if (mysqli_num_rows($validar_login) > 0) {
    // Obtener los datos del usuario
    $datos_usuario = mysqli_fetch_assoc($validar_login);

    // Guardar el usuario en la sesión
    $_SESSION['Nombre'] = $Nombre;
    $_SESSION['Rol'] = $datos_usuario['Rol'];
    }

else {
    // Si el usuario no existe o los datos son incorrectos
    echo '
    <script>
    alert("Usuario o contraseña incorrectos. Por favor, verifique los datos introducidos.");
    window.location = "login.php.php";
    </script>
    ';
   
    exit;
}
    ?>