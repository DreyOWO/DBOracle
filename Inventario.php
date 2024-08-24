<?php
session_start();
include_once('D:/XAMPP/htdocs/DBProyecto/config/conne.php');
include_once('./Model/ModelProductos.php');

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
        <div class="input-group">
            <label for="ID" class="col-xl-4 col-lg-4 col-md-4 col-sm-5 col-form-label">Correo</label>
            <input name="correo" type="text" class="form-control validate col-xl-9 col-lg-8 col-md-8 col-sm-7" id="correo">
        </div>
        <div class="input-group mt-3">
            <label for="contrasena" class="col-xl-4 col-lg-4 col-md-4 col-sm-5 col-form-label">Contraseña</label>
            <input name="contrasena" type="password" class="form-control validate" id="contrasena">
        </div>
        <div class="input-group mt-3">
            <button name="btningresar" type="submit" class="btn btn-primary d-inline-block mx-auto">Iniciar Sesión</button>
        </div>
    </div>
</body>

</html>