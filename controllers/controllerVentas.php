<?php
session_start();
include_once('D:/XAMPP/htdocs/DBProyecto/config/conne.php');
include_once('D:/XAMPP/htdocs/DBProyecto/Model/ModelProductos.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Verificar si se ha enviado el formulario de facturación
if (isset($_POST['btnFactura'])) {
    // Obtener los datos enviados desde el formulario
    $idProducto = $_POST['ID_Producto'];
    $cantidad = $_POST['Cantidad'];
    $idCliente = $_SESSION['ID_CLIENTE']; // Asegúrate de que el ID del cliente esté en la sesión

    if (!isset($idCliente)) {
        echo "Error: ID del cliente no está definido en la sesión.";
        exit;
    }
    // Crear una instancia del modelo de productos
    $modeloProductos = new ModelProductos($conn);

    // Intentar actualizar la cantidad del producto en inventario
    $cantidadActualizada = $modeloProductos->actualizarCantidadDeProducto($idProducto, $cantidad);

    // Verificar si la actualización fue exitosa
    if ($cantidadActualizada) {
        // Intentar registrar la venta en la base de datos
        $ventaRegistrada = $modeloProductos->registrarVenta($idCliente, $idProducto, $cantidad);

        if ($ventaRegistrada) {
            // Redirigir a una página de confirmación o mostrar un mensaje de éxito
            header('Location: confirmacion.php?mensaje=success');
            exit;
        } else {
            // Mostrar un mensaje de error si no se pudo registrar la venta
            echo "Error: No se pudo registrar la venta.";
        }
    } else {
        // Mostrar un mensaje de error si no se pudo actualizar la cantidad del producto
        echo "Error: No se pudo actualizar la cantidad del producto.";
    }

    // Cerrar la conexión
    oci_close($conn);
} else {
    // Redirigir a la página principal si se intenta acceder directamente al controlador
    header('Location: index.php');
    exit;
}
?>
