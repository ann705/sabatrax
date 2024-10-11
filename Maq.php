<?php

$host = "localhost";  // O el host de tu base de datos
$user = "root";       // Usuario de la base de datos
$pass = "";           // Contraseña (deja en blanco si no tienes)
$db   = "gaes";  // Nombre de tu base de datos

// Crear la conexión
$conn = new mysqli($host, $user, $pass, $db);

// Verificar si la conexión ha fallado
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si los campos han sido enviados y no están vacíos
if (isset($_POST['id']) && $_POST['Fecha'] != "" && $_POST['Medidas'] != "" && $_POST['tipoSabanas'] != "" && $_POST['Proveedor'] != "" && $_POST['Novedades'] != "" && $_POST['Cantidad'] != "" && $_POST['imageData'] != "") {

    // Capturar los valores del formulario
    $id = $_POST['id'];
    $Fecha = $_POST['Fecha'];
    $Medidas = $_POST['Medidas'];
    $tipoSabanas = $_POST['tipoSabanas'];
    $Proveedor = $_POST['Proveedor'];
    $Novedades = $_POST['Novedades'];
    $Cantidad = $_POST['Cantidad'];
    $image = $_POST['imageData'];

    // Procesar la imagen capturada
    $imageData = str_replace('data:image/png;base64,', '', $image);
    $imageData = str_replace(' ', '+', $imageData);
    $imageBlob = base64_decode($imageData);

    // Preparar la consulta SQL
    if ($conn) { // Validar que la conexión esté definida
        $stmt = $conn->prepare("INSERT INTO maquina (id, Fecha, Medidas, tipoSabanas, Proveedor, Novedades, Cantidad, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

        // Vincular los parámetros
        $stmt->bind_param('ssssssis', $id, $Fecha, $Medidas, $tipoSabanas, $Proveedor, $Novedades, $Cantidad, $imageBlob);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            $stmt->close();
        }

    } 
    header("Location: maqui.php");
}
?>