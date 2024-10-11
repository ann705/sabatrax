<?php
include ("coxecion.php");

// Verificar si los campos han sido enviados y no están vacíos
if (isset($_POST['boton']) && $_POST['Nombre'] != "" && $_POST['Apellido'] != "" && $_POST['Telefono'] != "" && $_POST['Rol'] != "" && $_POST['Actividad'] != "" && $_POST['Clave'] != "") {

    // Capturar los valores del formulario
    $Nombre = $_POST['Nombre'];
    $Apellido = $_POST['Apellido'];
    $Telefono = $_POST['Telefono'];
    $Rol = $_POST['Rol'];
    $Actividad = $_POST['Actividad'];
    $Clave = $_POST['Clave'];

    // Consulta SQL corregida
    $consulta_guardar = "INSERT INTO  usuarios(Nombre, Apellido, Telefono, Rol, Actividad, Clave) 
                         VALUES ('$Nombre', '$Apellido', '$Telefono', '$Rol', '$Actividad', '$Clave')";

    // Ejecutar la consulta y verificar si fue exitosa
    if (mysqli_query($conexion, $consulta_guardar)) {
     
    }
    header("Location: empleado.php");
} 
?>