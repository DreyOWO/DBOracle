<?php
// Incluir la conexión a la base de datos y el modelo
include_once('D:/XAMPP/htdocs/DBProyecto/config/conne.php');
include_once('./Model/ModelFacturas.php');

// Crear una instancia del modelo
$modelDetallesFactura = new ModelDetallesFactura($conn);

try {
    // Obtener los datos
    $detalles = $modelDetallesFactura->mostrarDetallesFactura();
} catch (Exception $e) {
    echo 'Error: ' . htmlspecialchars($e->getMessage());
    exit;
}

// Cerrar la conexión
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
    <div>
    <div class="subtitle">
        <div class="subtitle-box">
            <h1>Lista de Detalles de Factura</h1>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID Detalle</th>
                <th>ID Factura</th>
                <th>Descripción</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($detalles)): ?>
                <?php foreach ($detalles as $detalle): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($detalle['ID_DETALLE']); ?></td>
                        <td><?php echo htmlspecialchars($detalle['ID_FACTURA']); ?></td>
                        <td><?php echo htmlspecialchars($detalle['DESCRIPCION']); ?></td>
                        <td><?php echo htmlspecialchars($detalle['CANTIDAD']); ?></td>
                        <td><?php echo htmlspecialchars($detalle['PRECIO_UNITARIO']); ?></td>
                        <td><?php echo htmlspecialchars($detalle['SUBTOTAL']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">No hay detalles disponibles.</td>
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
        <a href="login.php">Cerrar Sesion</a>
    </div>
    <div class="footer">
        <p>© 2024 Derechos reservados Grupo#7</p>
    </div>
</body>
</html>
