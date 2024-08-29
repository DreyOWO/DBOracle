<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Citas</title>
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
            position: relative;
        }

        .header {
            background: linear-gradient(135deg, #007bff 0%, #00c6ff 100%);
            color: white;
            text-align: center;
            padding: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            z-index: 1000;
        }

        .header h1 {
            font-size: 36px;
            font-family: 'Pacifico', cursive;
            margin: 0;
            letter-spacing: 1px;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.2);
        }

        .header .logo {
            max-width: 80px;
            height: auto;
            opacity: 0.9;
        }

        .menu-icon {
            font-size: 24px;
            color: white;
            cursor: pointer;
            z-index: 1001;
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

        .form-group label {
            font-weight: bold;
            color: #333;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

        .footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 10px;
            font-size: 11px;
            margin-top: auto;
            position: relative;
            width: 100%;
            bottom: 0;
        }

        @media (max-width: 768px) {
            .header h1 {
                font-size: 24px;
            }

            .menu-icon {
                font-size: 20px;
            }

            .sidebar {
                width: 200px;
            }

            .sidebar a {
                font-size: 14px;
            }
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
        <a href="Admin.php">Inicio</a>
        <a href="vehiculosAdmin.php">Vehículos</a>
        <a href="InventarioAdmin.php">Productos</a>
        <a href="login.php">Login</a>
    </div>

    <div class="subtitle">
        <div class="subtitle-box">
            <h1>Gestión de Citas</h1>
        </div>
    </div>

    <div class="container">
        <h2 class="mt-5">Programar Nueva Cita</h2>
        <form action="Model/ModelCita.php" method="post">
            <input type="hidden" name="id_cliente" value="<?php echo $_SESSION['ID_CLIENTE']; ?>">
            <div class="form-group">
                <label for="placa">Placa del Vehículo</label>
                <input type="text" class="form-control" id="placa" name="placa" required>
            </div>
            <div class="form-group">
                <label for="fecha">Fecha</label>
                <input type="date" class="form-control" id="fecha" name="fecha" required>
            </div>
            <div class="form-group">
                <label for="motivo">Motivo</label>
                <input type="text" class="form-control" id="motivo" name="motivo" required>
            </div>
            <button type="submit" name="btnAgregarCita" class="btn btn-primary">Programar Cita</button>
        </form>

        <h2 class="mt-5">Cancelar Cita</h2>
        <form action="Model/ModelEliminarCita.php" method="post">
            <div class="form-group">
                <label for="id_cita">ID Cita</label>
                <input type="text" class="form-control" id="id_cita" name="id_cita" required>
            </div>
            <button type="submit" name="btnEliminarCita" class="btn btn-danger">Cancelar Cita</button>
        </form>
    </div>

    <div class="footer">
        <p>© 2024 Derechos reservados Grupo#7</p>
    </div>
</body>

</html>
 