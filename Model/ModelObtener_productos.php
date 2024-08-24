<?php
include_once('D:/XAMPP/htdocs/DBProyecto/config/conne.php');
include_once('./Model/ModelProductos.php');

// Crear una instancia del modelo de productos
$modeloProductos = new ModelProductos($conn);

// Obtener los artículos
$articulos = $modeloProductos->obtenerArticulos();

// Liberar la conexión
oci_close($conn);

// Enviar los datos como JSON
echo json_encode($articulos);
?>
