<?php
require('fpdf/fpdf.php'); // Asegúrate de que esta ruta sea correcta

// Incluir la conexión a la base de datos
include("coxecion.php"); // Asegúrate de que el nombre del archivo de conexión sea correcto

if (isset($_POST['selected_rows'])) {
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Ln(10); // Espacio de línea

    // Título
    $pdf->Cell(0, 10, 'Reporte Actividades', 0, 1, 'C');
    $pdf->Ln(10); // Espacio

    // Agregar datos de las filas seleccionadas
    foreach ($_POST['selected_rows'] as $id) {
        // Obtener datos de la fila seleccionada
        $rowData = getRowData($id); // Función personalizada para obtener datos

        // Asegúrate de que rowData no sea nulo antes de agregar al PDF
        if ($rowData) {
            $pdf->Cell(10, 5, 'ID: ' . $rowData['id']);
            $pdf->Cell(30, 5, 'Fecha: ' . $rowData['Fecha']);
            $pdf->Cell(28, 5, 'Medidas: ' . $rowData['Medidas']);
            $pdf->Cell(22, 5, 'Tipo: ' . $rowData['tipoSabanas']);
            $pdf->Cell(33, 5, 'Proveedor: ' . $rowData['Proveedor']);
            $pdf->Cell(35, 5, 'Novedades: ' . $rowData['Novedades']);
            $pdf->Cell(5, 5, 'Cantidad: ' . $rowData['Cantidad']);
            $pdf->Ln(); // Nueva línea
            
            // Aquí se debe colocar la imagen
            // Asegúrate de que la columna 'image' contenga la ruta correcta de la imagen
            $imageData = 'http://localhost/phpmyadmin/index.php?route=/database/structure&server=1&db=gaes/maquina/image/' . $rowData['image'];

            // Agregar imagen al PDF si existe
            if (file_exists($imageData)) {
                $pdf->Image($imageData, 10, $pdf->GetY(), 30, 30); // Ajusta x, y, ancho, alto según sea necesario
                $pdf->Ln(30); // Espacio para la imagen
            } else {
                $pdf->Cell(0, 10, 'Imagen no encontrada para ID: ' . $id);
                $pdf->Ln();
            }
        } else {
            $pdf->Cell(0, 10, 'No se encontraron datos para el ID: ' . $id);
            $pdf->Ln();
        }
    }

    // Mostrar el total
    $pdf->Ln(10); // Espacio
    $pdf->Cell(0, 10, 'Total: ' . $_POST['total'], 0, 1, 'C');

    $pdf->Output(); // Salida del PDF
} else {
    echo 'No se seleccionaron filas.';
}

// Función para obtener datos de la base de datos
function getRowData($id) {
    global $conexion; // Asegúrate de que la conexión esté disponible
    $consulta = "SELECT * FROM maquina WHERE id = '$id'";
    $resultado = mysqli_query($conexion, $consulta);
    
    if ($resultado) {
        return mysqli_fetch_assoc($resultado); // Retorna la fila como un array asociativo
    } else {
        return null; // En caso de error, retorna nulo
    }
}
?>