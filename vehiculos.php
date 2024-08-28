<?php

include_once('D:/XAMPP/htdocs/DBProyecto/config/conne.php');
include_once('./Model/ModelVehiculo.php');


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Vehículos</title>
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

        .subtitle {
            margin: 15px;
            text-align: center;
        }

        .subtitle-box {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }

        .container {
            padding: 10px 20px;
            flex: 1;
            text-align: center;
        }

        .container h2 {
            margin-top: 20px;
            font-size: 28px;
            color: #007bff;
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
            left: -300px;
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
            margin-left: 20px;
            margin-right: 20px;
            padding: 20px;
            flex: 1;
            overflow: hidden;
        }

        .content h1 {
            font-size: 24px;
            text-align: center;
            margin-bottom: 20px;
        }

        .btn-container {
            margin-top: 20px;
        }

        .form-container {
            margin-bottom: 50px;
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

    <div class="sidebar">
        <span class="close-btn" onclick="toggleSidebar()">&times;</span>
        <h2>Menú</h2>
        <a href="index.php">Inicio</a>
        <a href="citas.php">Citas</a>
        <a href="inventario.php">Productos</a>
        <a href="login.php">Login</a>
    </div>

    <div class="content">
        <div class="subtitle">
            <div class="subtitle-box">
                <h1>Gestión de Vehículos</h1>
            </div>
        </div>

        <div class="container">
            <h2>Lista de Vehículos</h2>
            <div class="btn-container">
                <form method="POST" action="vehiculos.php" style="display: inline;">
                    <button type="submit" name="btnCargarVehiculos" class="btn btn-primary">Cargar Vehículos</button>
                </form>
                <form method="POST" action="vehiculos.php" style="display: inline;">
                    <button type="submit" name="btnGuardarVehiculos" class="btn btn-secondary">Guardar Vehículos</button>
                </form>
            </div>

            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>Placa</th>
                        <th>Tipo</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Año</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($vehiculos)): ?>
                        <?php foreach ($vehiculos as $vehiculo): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($vehiculo['PLACA']); ?></td>
                                <td><?php echo htmlspecialchars($vehiculo['TIPO']); ?></td>
                                <td><?php echo htmlspecialchars($vehiculo['MARCA']); ?></td>
                                <td><?php echo htmlspecialchars($vehiculo['MODELO']); ?></td>
                                <td><?php echo htmlspecialchars($vehiculo['AÑO']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">No se encontraron vehículos.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <h2 class="mt-5">Registrar Nuevo Vehículo</h2>
            <form action="Model/ModelVehiculo.php" method="post">
                <input type="hidden" id="id_cliente" name="id_cliente" value="<?php echo $_SESSION['ID_CLIENTE']; ?>">

                <div class="form-group">
                    <label for="placa">Placa</label>
                    <input type="text" class="form-control" id="placa" name="placa" required>
                </div>
                <div class="form-group">
                    <label for="tipo">Tipo</label>
                    <input type="text" class="form-control" id="tipo" name="tipo" required>
                </div>
                <div class="form-group">
                    <label for="marca">Marca</label>
                    <input type="text" class="form-control" id="marca" name="marca" required>
                </div>
                <div class="form-group">
                    <label for="modelo">Modelo</label>
                    <input type="text" class="form-control" id="modelo" name="modelo" required>
                </div>
                <div class="form-group">
                    <label for="año">Año</label>
                    <input type="number" class="form-control" id="año" name="año" required>
                </div>
                <button type="submit" name="btnAgregarVehiculo" class="btn btn-primary">Registrar Vehículo</button>
            </form>

            <h2 class="mt-5">Eliminar Vehículo</h2>
            <div class="form-container">
                <form action="Model/ModelVehiculo.php" method="post">
                    <div class="form-group">
                        <label for="placa">Placa del Vehículo</label>
                        <input type="text" class="form-control" id="placa" name="placa" required>
                    </div>
                    <button type="submit" name="btnEliminarVehiculo" class="btn btn-danger">Eliminar Vehículo</button>
                </form>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>© 2024 Derechos reservados Grupo#7</p>
    </div>
</body>

</html>
 