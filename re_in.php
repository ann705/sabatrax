<?php
include("coxecion.php");

echo '<link rel="stylesheet" href="rgInv.css">';

// Consulta para obtener los registros
$consulta = "SELECT * FROM inventario";
$result = mysqli_query($conexion, $consulta);

if (!$result) {
    die("Error al realizar la consulta: " . mysqli_error($conexion));
}

// Contenedor para el recuadro
echo "<div class='container'>"; // Iniciamos el contenedor

echo "<h2 style='text-align: center; margin-top: 20px;'>Material Agregado</h2>";

if ($result->num_rows > 0) {
    echo "<form method='POST' action=''>";
    echo "<table border='1'>
            <tr>
                <th></th>
                <th>Material</th>
                <th>Cantidad</th>
                <th>Nombre Proveedor</th>
                <th>Fecha Entrada</th>
                <th>Fecha Salida</th>
                <th>Costo</th>
                <th>Novedades</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td><input type='checkbox' name='selected_rows[]' value='" . $row['id'] . "'></td>
                <td>".$row["material"]."</td>
                <td>".$row["Cantidad"]."</td>
                <td>".$row["nombre_proveedor"]."</td>
                <td>".$row["fecha_entrada"]."</td>
                <td>".$row["fecha_salida"]."</td>
                <td>".$row["costo"]."</td>
                <td>".$row["novedades"]."</td>
              </tr>";
    }
    echo "</table>";
    echo '<input type="button" class="m" value="Volver" onclick="window.location.href=\'Administrador.html\'">';
    
    echo '<input type="submit" name="delete" value="Eliminar" class="m" onclick="return confirm(\'¿Estás seguro de que deseas eliminar estas filas?\');">';
    echo "</form>";
} else {
    echo "0 resultados";
}

// Verificamos si se ha hecho clic en el botón de eliminar
if (isset($_POST['delete'])) {
    if (!empty($_POST['selected_rows'])) {
        $ids_to_delete = $_POST['selected_rows'];
        $ids_to_delete_str = implode(",", $ids_to_delete); // Convertimos los IDs seleccionados en una cadena separada por comas

        // Realizamos la eliminación en la base de datos
        $delete_query = "DELETE FROM inventario WHERE id IN ($ids_to_delete_str)";
        $delete_result = mysqli_query($conexion, $delete_query);

        if ($delete_result) {
            echo "Filas eliminadas con éxito.";
            // Recargamos la página para que los cambios sean visibles
            echo "<meta http-equiv='refresh' content='0'>";
        } else {
            echo "Error al eliminar las filas: " . mysqli_error($conexion);
        }
    } else {
        echo "No has seleccionado ninguna fila para eliminar.";
    }
}
?>
