<?php
include("coxecion.php");


if (isset($_POST['boton']) && $_POST['id'] != "" && $_POST['material'] != "" && $_POST['cantidad'] != "" && $_POST['nombre_proveedor'] != "" && $_POST['fecha_entrada'] != "" && $_POST['fecha_salida'] != "" && $_POST['costo'] != "" && $_POST['novedades'] != "") {

    $id = $_POST['id'];
    $material = $_POST['material'];
    $cantidad = $_POST['cantidad'];
    $nombre_proveedor = $_POST['nombre_proveedor'];
    $fecha_entrada = $_POST['fecha_entrada'];
    $fecha_salida = $_POST['fecha_salida'];
    $costo = $_POST['costo'];
    $novedades = $_POST['novedades'];

    
    $consulta_guardar = "INSERT INTO  inventario(id,material, cantidad, nombre_proveedor, fecha_entrada, fecha_salida, costo, novedades) 
                         VALUES ('$id', $material', '$cantidad', '$nombre_proveedor', '$fecha_entrada', '$fecha_salida', '$costo', '$novedades')";

   
    if (mysqli_query($conexion, $consulta_guardar)) {
        echo '<script>
            alert("Has registrado los datos solicitados");
            
            </script>';
    }
} 
?>

