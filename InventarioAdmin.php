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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
            background-color: #f1f5f9;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .header {
            background: linear-gradient(135deg, #007bff 0%, #00c6ff 100%);
            color: white;
            text-align: center;
            padding: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            font-weight: bold;
        }

        .header h1 {
            font-size: 28px;
            font-family: 'Pacifico', cursive;
            margin: 0;
            letter-spacing: 1px;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.2);
            flex: 1;
        }

        .header .logo {
            max-width: 80px;
            height: auto;
            opacity: 0.9;
        }

        .menu-icon {
            font-size: 24px;
            cursor: pointer;
            color: white;
            margin-right: 20px;
        }

        .footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 10px;
            font-size: 12px;
            margin-top: auto;
            width: 100%;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: -250px;
            width: 250px;
            height: 100%;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            transition: left 0.3s ease;
            z-index: 1000;
            overflow-y: auto;
        }

        .sidebar.show {
            left: 0;
        }

        .sidebar h2 {
            margin-top: 0;
            color: #333;
        }

        .sidebar a {
            display: block;
            padding: 10px;
            color: #333;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 10px;
            background-color: #f8f9fa;
            font-size: 14px;
        }

        .sidebar a:hover {
            background-color: #e9ecef;
        }

        .content {
            margin: 20px;
            flex: 1;
        }

        .card {
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #007bff;
            color: white;
            font-size: 18px;
            font-weight: bold;
            border-bottom: 1px solid #ddd;
            border-radius: 10px 10px 0 0;
            padding: 15px;
        }

        .card-body {
            padding: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .close-btn {
            position: absolute;
            right: 15px;
            top: 10px;
            font-size: 20px;
            cursor: pointer;
        }

        .sidebar .close-btn:hover {
            color: #007bff;
        }
    </style>
    <script>
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('show');
        }
    </script>
</head>

<body>
    <div class="header">
        <span class="menu-icon" onclick="toggleSidebar()">&#9776;</span>
        <h1>Taller Enderezado y Pintura Burgos</h1>
        <img src="images/logo.png" alt="Logo" class="logo">
    </div>

    <div class="content">
        <div class="card">
            <div class="card-header">
                Agregar Producto
            </div>
            <div class="card-body">
                <form action="./controllers/controllerVentas.php" method="post">
                    <div class="form-group">
                        <label for="ID_PRODUCTO">ID Producto:</label>
                        <input type="number" id="ID_PRODUCTO" name="ID_PRODUCTO" required>
                    </div>
                    <div class="form-group">
                        <label for="NOMBRE">Nombre:</label>
                        <input type="text" id="NOMBRE" name="NOMBRE" required>
                    </div>
                    <div class="form-group">
                        <label for="DESCRIPCION">Descripción:</label>
                        <input type="text" id="DESCRIPCION" name="DESCRIPCION">
                    </div>
                    <div class="form-group">
                        <label for="CANTIDAD">Cantidad:</label>
                        <input type="number" id="CANTIDAD" name="CANTIDAD" required>
                    </div>
                    <div class="form-group">
                        <label for="PRECIO">Precio:</label>
                        <input type="number" step="0.01" id="PRECIO" name="PRECIO" required>
                    </div>
                    <button type="submit" name="btnAgregarProducto" class="btn btn-primary">Agregar Producto</button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                Eliminar Producto
            </div>
            <div class="card-body">
                <form action="controllers/controllerVentas.php" method="post">
                    <div class="form-group">
                        <label for="id_producto_eliminar">ID del Producto:</label>
                        <input type="number" id="id_producto_eliminar" name="id_producto" required>
                    </div>
                    <input type="hidden" name="action" value="eliminar_producto">
                    <button type="submit" name="btnEliminarProducto" class="btn btn-primary">Eliminar Producto</button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                Agregar Producto al Stock
            </div>
            <div class="card-body">
                <form action="controllers/controllerVentas.php" method="post">
                    <div class="form-group">
                        <label for="id_producto_stock">ID del Producto:</label>
                        <input type="number" id="id_producto_stock" name="id_producto" required>
                    </div>
                    <div class="form-group">
                        <label for="cantidad_stock">Cantidad:</label>
                        <input type="number" id="cantidad_stock" name="cantidad" required>
                    </div>
                    <input type="hidden" name="action" value="agregar_stock">
                    <button type="submit" name="btnAgregarStock" class="btn btn-primary">Agregar al Stock</button>
                </form>
            </div>
        </div>

        <div class="subtitle">
            <div class="subtitle-box">
                <h1>Lista de Productos</h1>
            </div>
        </div>
        <table class="table table-striped">
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
                        <td colspan="5">No hay productos disponibles.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="sidebar">
        <span class="close-btn" onclick="toggleSidebar()">&times;</span>
        <h2>Menú</h2>
        <a href="Admin.php">Inicio</a>
        <a href="citasAdmin.php">Citas</a>
        <a href="vehiculosAdmin.php">Vehículos</a>
        <a href="facturasAdmin.php">Facturas</a>
        <a href="login.php">Cerrar Sesion</a>
    </div>

    <div class="footer">
        <p>© 2024 Derechos reservados Grupo#7</p>
    </div>
</body>
</html>