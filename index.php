<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Gestión</title>
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
            position: relative;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-weight: bold;
            z-index: 1000; /* Asegura que el header esté por encima del sidebar */
        }

        .header h1 {
            font-size: 36px;
            font-family: 'Pacifico', cursive;
            margin: 0;
            letter-spacing: 1px;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.2);
            flex: 1;
            text-align: center;
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
            z-index: 1001; /* Asegura que el icono esté por encima del sidebar */
        }

        .subtitle {
            margin: 20px;
            text-align: center;
        }

        .subtitle-box {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .menu-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            padding: 40px 20px;
            text-align: center;
            flex: 1;
        }

        .menu-item {
            background-color: #ffffff;
            padding: 0;
            border-radius: 10px;
            border: 3px solid #007bff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            overflow: hidden;
        }

        .menu-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            margin-bottom: 15px;
        }

        .menu-item h3 {
            margin: 15px 0;
            font-size: 20px;
            color: #333;
        }

        .menu-item button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .menu-item button:hover {
            background-color: #0056b3;
        }

        .menu-item:hover {
            transform: scale(1.05);
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
            z-index: 1000; /* Asegura que el sidebar esté por encima de otros elementos */
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

        .dropdown-menu {
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            min-width: 200px;
        }

        .dropdown-menu a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            display: block;
        }

        .dropdown-menu a:hover {
            background-color: #0056b3;
        }

        @media (max-width: 768px) {
            .menu-icon {
                display: block;
            }

            .header h1 {
                font-size: 24px;
            }

            .menu-container {
                padding: 20px;
            }

            .menu-item img {
                height: 150px;
            }

            .header {
                flex-direction: column;
                text-align: center;
            }

            .header .logo {
                margin-left: 0;
                margin-top: 10px;
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

    <div class="subtitle">
        <div class="subtitle-box">
            <h5>Seleccione una opción:</h5>
        </div>
    </div>

    <div class="menu-container">
        <div class="menu-item">
            <img src="Images/citas.jpeg" alt="Citas">
            <h3>Citas</h3>
            <button onclick="window.location.href='citas.php'">Ir a Citas</button>
        </div>
        <div class="menu-item">
            <img src="Images/vehiculos.jpeg" alt="Vehículos">
            <h3>Vehículos</h3>
            <button onclick="window.location.href='vehiculos.php'">Ir a Vehículos</button>
        </div>
        <div class="menu-item">
            <img src="images/productos.jpeg" alt="Productos">
            <h3>Productos</h3>
            <button onclick="window.location.href='inventario.php'">Ir a Productos</button>
        </div>
    </div>

    <div class="footer">
        <p>© 2024 Derechos reservados Grupo#7</p>
    </div>

    <div class="sidebar">
        <span class="close-btn" onclick="toggleSidebar()">&times;</span>
        <h2>Menú</h2>
        <a href="citas.php">Citas</a>
        <a href="vehiculos.php">Vehículos</a>
        <a href="inventario.php">Productos</a>
        <a href="login.php">Login</a>
    </div>
</body>

</html>
 