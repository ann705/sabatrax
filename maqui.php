<?php
include("coxecion.php"); // Incluye el archivo de conexión

echo '<link rel="stylesheet" href="maquina.css">';

// Consulta para obtener los registros
$consulta = "SELECT * FROM maquina";
$result = mysqli_query($conexion, $consulta);

if (!$result) {
    die("Error al realizar la consulta: " . mysqli_error($conexion));
}

// Contenedor para el recuadro
echo "<div class='container'>"; // Iniciamos el contenedor

echo "<h2 style='text-align: center; margin-top: 20px;'>Actividades Realizadas</h2>";
echo "<form method='POST'>"; // Abrimos el formulario


echo "<table border='1'>
        <tr>
            <th></th>
            <th>Fecha</th>
            <th>Medidas</th>
            <th>Tipo Sábanas</th>
            <th>Proveedor</th>
            <th>Novedades</th>
            <th>Cantidad</th>
            <th>Evidencia</th>
        </tr>";

// Mostrar los datos de la tabla
while ($colum = mysqli_fetch_assoc($result)) {
    // Convertir el BLOB de la base de datos a formato base64
    $imageData = base64_encode($colum['image']);
    $imageSrc = 'data:image/png;base64,' . $imageData; // Cambia 'png' si el tipo de imagen es diferente
    
    echo "<tr>
            <td><input type='checkbox' name='selected_rows[]' value='" . $colum['id'] . "'></td>
            <td>" . $colum['Fecha'] . "</td>
            <td>" . $colum['Medidas'] . "</td>
            <td>" . $colum['tipoSabanas'] . "</td>
            <td>" . $colum['Proveedor'] . "</td>
            <td>" . $colum['Novedades'] . "</td>
            <td>" . $colum['Cantidad'] . "</td>
            <td><img src='" . $imageSrc . "' width='100' height='100'></td>
        </tr>";
}

echo "</table>";

echo '<input type="button" class="m" value="Agregar Actividad" onclick="window.location.href=\'Ma.html\'">';
echo '<input type="submit" name="submit" class="m" value="Calcular">';
echo '<input type="button" class="m" value="Cerrar Sesión" onclick="window.location.href=\'login.php.php\'">';
echo '<input type="submit" name="delete" value="Eliminar" class="m" onclick="return confirm(\'¿Estás seguro de que deseas eliminar estas filas?\');">';
echo "</form>"; // Cerramos el formulario
echo "</div>"; // Cerramos el contenedor

if (isset($_POST['delete'])) {
    
    echo "Filas eliminadas con éxito.";
}function calcularTrabajo($Cantidad, $tipoSabanas): int {
    // Definimos los valores por tipo de trabajo
    $valores = [
        'Plana' => 400,
        'Caucho' => 400,
        'Fundas' => 50,
        'Cortinas' => 1200
    ];

    // Verificamos que el tipo de sábana exista en el array
    if (array_key_exists($tipoSabanas, $valores)) {
        // Retornamos el cálculo
        return $Cantidad * $valores[$tipoSabanas];
    } else {
        return 0; // Si el tipo no existe, retornamos 0
    }
}

// Procesar el cálculo solo si se envió el formulario
if (isset($_POST['submit'])) {
    if (isset($_POST['selected_rows'])) {
        $totalResultado = 0;

        // Procesar cada fila seleccionada
        foreach ($_POST['selected_rows'] as $id) {
            // Consulta para obtener los datos de la fila seleccionada
            $consultaFila = "SELECT * FROM maquina WHERE id = '$id'";
            $resultadoFila = mysqli_query($conexion, $consultaFila);

            if ($resultadoFila && mysqli_num_rows($resultadoFila) > 0) {
                $colum = mysqli_fetch_assoc($resultadoFila);
                $Cantidad = $colum['Cantidad'];
                $tipoSabanas = $colum['tipoSabanas'];

                // Calcular el trabajo para esta fila
                $resultado = calcularTrabajo($Cantidad, $tipoSabanas);
                $totalResultado += $resultado; // Sumar al total
            }
        }

        // Mostrar el resultado total formateado
        $resultadoFormateado = "$" . number_format($totalResultado, 0, ',', '.');
        echo "<p>Su Salario es de: $resultadoFormateado</p>";
// Verificar si se han enviado las filas seleccionadas
if (isset($_POST['selected_rows']) && !empty($_POST['selected_rows'])) {
    // Botón para generar PDF
    echo '<form action="pdf.php" method="POST">';
    
    // Recorrer las filas seleccionadas y crear inputs ocultos
    foreach ($_POST['selected_rows'] as $id) {
        echo '<input type="hidden" name="selected_rows[]" value="' . $id . '">';
    }
    
    // Incluir el total en el formulario
    echo '<input type="hidden" name="total" value="' . $totalResultado . '">';
    
    // Botón para enviar el formulario y generar el PDF
    echo '<input type="submit" value="Generar PDF">';
    
    echo '</form>'; // Cerramos el formulario de generación de PDF
} else {
    echo 'No se seleccionaron filas.';
}

        

    } else {
        echo "<p>No se seleccionó ninguna fila.</p>";
    }
}

mysqli_close($conexion);
?>