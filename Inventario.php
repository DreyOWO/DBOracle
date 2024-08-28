<?php
session_start();
include_once('D:/XAMPP/htdocs/DBProyecto/config/conne.php');
include_once('./Model/ModelProductos.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Crear una instancia del modelo de productos
$modeloProductos = new ModelProductos($conn);

// Obtener los artículos
$articulos = $modeloProductos->obtenerArticulos();

// Liberar la conexión
oci_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Productos</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <div class="content">
        <h1>Lista de Productos</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID Producto</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($articulos)): ?>
                    <?php foreach ($articulos as $articulo): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($articulo['ID_PRODUCTO']); ?></td>
                            <td><?php echo htmlspecialchars($articulo['NOMBRE']); ?></td>
                            <td><?php echo htmlspecialchars($articulo['DESCRIPCION']); ?></td>
                            <td><?php echo htmlspecialchars($articulo['CANTIDAD']); ?></td>
                            <td><?php echo htmlspecialchars($articulo['PRECIO']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No se encontraron productos.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <form action="./controllers/controllerVentas.php" method="post">
            <div class="input-group">
                <label for="ID_Producto" class="col-xl-4 col-lg-4 col-md-4 col-sm-5 col-form-label">ID del Producto</label>
                <input name="ID_Producto" type="text" class="form-control validate col-xl-9 col-lg-8 col-md-8 col-sm-7" id="ID_Producto" required>
            </div>
            <div class="input-group mt-3">
                <label for="Cantidad" class="col-xl-4 col-lg-4 col-md-4 col-sm-5 col-form-label">Cantidad de objetos</label>
                <input name="Cantidad" type="text" class="form-control validate" id="Cantidad" required>
            </div>
            <div class="input-group mt-3">
                <button name="btnFactura" type="submit" class="btn btn-primary d-inline-block mx-auto">Facturar</button>
            </div>
        </form>

    </div>
</body>

</html>