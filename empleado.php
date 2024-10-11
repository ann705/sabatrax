<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gaes";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener la lista de empleados
$sql = "SELECT Nombre, Apellido, Telefono FROM usuarios";
$result = $conn->query($sql);

// Manejar la selección de un empleado
$empleado_seleccionado = null;
if (isset($_GET['Telefono'])) {
    $Telefono = $_GET['Telefono'];
    
    // Aquí corregimos el campo `Telefono` en la consulta SQL
    $sql_detalle = "SELECT * FROM usuarios WHERE Telefono='$Telefono'";
    $detalle_result = $conn->query($sql_detalle);
    
    if ($detalle_result->num_rows > 0) {
        $empleado_seleccionado = $detalle_result->fetch_assoc();
    }
}

// Manejar acciones como agregar, modificar, eliminar, bloquear y loguear
if (isset($_POST['accion'])) {
    $accion = $_POST['accion'];
    $telefono = $_POST['telefono']; // Obtenemos el teléfono del empleado seleccionado

    if ($accion == 'modificar') {
        // Lógica para modificar empleado
        // Aquí debes agregar el código para actualizar la información del empleado en la base de datos
        $Nombre = $_POST['nombre'];
        $Apellido = $_POST['apellido'];
        $Actividad = $_POST['Actividad'];
        $Clave = $_POST['clave'];
        
        $update_sql = "UPDATE usuarios SET Nombre='$Nombre', Apellido='$Apellido', Actividad='$Actividad', Clave='$Clave' WHERE Telefono='$telefono'";
        $conn->query($update_sql);
        
    } elseif ($accion == 'eliminar') {
        // Lógica para eliminar empleado
        $delete_sql = "DELETE FROM usuarios WHERE Telefono='$telefono'";
        $conn->query($delete_sql);
        
    } elseif ($accion == 'bloquear') {
        // Lógica para bloquear empleado
        // Podrías implementar un campo de estado en tu base de datos para indicar si está bloqueado o no
    } elseif ($accion == 'loguear') {
        // Lógica para loguear al empleado
        // Aquí puedes manejar el estado de logueo, por ejemplo, estableciendo un campo de sesión o similar
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Empleados</title>
    <link rel="stylesheet" href="empleado.css"> 
</head>

<body>

<div id="menu-lateral">
    <h2>Empleados Registrados</h2>
    <ul>
        <?php
        // Mostrar la lista de empleados en el menú lateral
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<li><a href='?Telefono=" . $row['Telefono'] . "'>" . $row['Nombre'] . " " . $row['Apellido'] . "</a></li>";
            }
        } else {
            echo "<li>No hay empleados registrados</li>";
        }
        ?>
    </ul>
    <button class="btn" onclick="window.location.href='Registros.html.php'">Agregar Empleado</button>
    <button class="btn" onclick="window.location.href='Administrador.html'">Volver</button>
</div>

<div id="contenido">
    <?php if ($empleado_seleccionado) { ?>
        <h2>Información del Empleado</h2>
        <form action="" method="POST">
            <div class="empleado-info">
                <label>Nombre:</label>
                <input type="text" name="nombre" value="<?php echo $empleado_seleccionado['Nombre']; ?>">
            </div>
            <div class="empleado-info">
                <label>Apellido:</label>
                <input type="text" name="apellido" value="<?php echo $empleado_seleccionado['Apellido']; ?>">
            </div>
            <div class="empleado-info">
                <label>Número:</label>
                <input type="text" name="numero" value="<?php echo $empleado_seleccionado['Telefono']; ?>" readonly>
            </div>
            <div class="empleado-info">
                <label>Área de Trabajo:</label>
                <select name="Actividad">
                    <option value="Maquina" <?php if ($empleado_seleccionado['Actividad'] == 'Maquina') echo 'selected'; ?>>Máquina</option>
                    <option value="Corte" <?php if ($empleado_seleccionado['Actividad'] == 'Corte') echo 'selected'; ?>>Corte</option>
                    <option value="Empaque" <?php if ($empleado_seleccionado['Actividad'] == 'Empaque') echo 'selected'; ?>>Empaque</option>
                </select>
            </div>
            <div class="empleado-info">
                <label>Clave:</label>
                <input type="password" name="clave" value="<?php echo $empleado_seleccionado['Clave']; ?>">
            </div>
            <input type="hidden" name="telefono" value="<?php echo $empleado_seleccionado['Telefono']; ?>">
            <button class="btn" type="submit" name="accion" value="modificar">Modificar</button>
            <button class="btn" type="submit" name="accion" value="eliminar">Eliminar</button>
            <button class="btn" type="submit" name="accion" value="desloguear">Desloguear</button>
            <button class="btn" type="submit" name="accion" value="loguear">Loguear</button>
            <button class="btn" type="submit" name="accion" value="actualizar">Actualizar</button>
        </form>
    <?php } else { ?>
        <h2>Selecciona un empleado del menú para ver su información</h2>
    <?php } ?>
</div>

</body>
</html>
