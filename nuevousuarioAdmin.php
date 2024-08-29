<?php

include('./config/conne.php');
include('./Model/ModelUsuario.php');

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
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

        .sidebar .close-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 24px;
            cursor: pointer;
            color: #333;
        }

        .sidebar .close-btn:hover {
            color: #007bff;
        }

        .content {
            display: flex;
            justify-content: center;
            align-items: center;
            flex: 1;
            padding: 20px;
        }

        .register-container {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        .register-container h2 {
            font-size: 2rem;
            font-family: 'Pacifico', cursive;
            color: #007bff;
            text-align: center;
            margin-bottom: 1.5rem;
            text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.1);
        }

        .form-group label {
            font-weight: bold;
            color: #333;
        }

        .form-control {
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border: 1px solid #ddd;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 0.75rem;
            width: 100%;
            font-size: 1rem;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .login-link {
            text-align: center;
            margin-top: 1rem;
        }

        .login-link a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .register-container {
                padding: 1.5rem;
                max-width: 90%;
            }

            .register-container h2 {
                font-size: 1.75rem;
            }

            .btn-primary {
                font-size: 0.9rem;
                padding: 0.65rem;
            }
        }

        @media (max-width: 576px) {
            .register-container h2 {
                font-size: 1.5rem;
            }

            .btn-primary {
                font-size: 0.85rem;
                padding: 0.6rem;
            }
        }
    </style>
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
        <a href="citasAdmin.php">Citas</a>
        <a href="vehiculosAdmin.php">Vehículos</a>
        <a href="InventarioAdmin.php">Productos</a>
        <a href="facturasAdmin.php">Facturas</a>
        <a href="login.php">Cerrar Sesion</a>
    </div>

    <div class="content">
        <div class="register-container">
            <h2>Crear Nuevo Administrador</h2>
            <?php
            if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'success') {
                echo '<div class="alert alert-success" role="alert">¡Registro exitoso! Ahora puedes iniciar sesión.</div>';
            }
            ?>
            <form action="./Model/ModelUsuario.php" method="post">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input name="nombre" type="text" class="form-control" id="nombre" required>
                </div>
                <div class="form-group">
                    <label for="apellido1">Primer Apellido</label>
                    <input name="apellido1" type="text" class="form-control" id="apellido1" required>
                </div>
                <div class="form-group">
                    <label for="apellido2">Segundo Apellido</label>
                    <input name="apellido2" type="text" class="form-control" id="apellido2" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input name="email" type="email" class="form-control" id="email" required>
                </div>
                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input name="telefono" type="text" class="form-control" id="telefono">
                </div>
                <div class="form-group">
                    <label for="contrasena">Contraseña</label>
                    <input name="contrasena" type="password" class="form-control" id="contrasena" required>
                </div>
                <div class="form-group">
                    <label for="contacto_emergenciaTe">Contacto de Emergencia</label>
                    <input name="contacto_emergenciaTe" type="text" class="form-control" id="contacto_emergenciaTe" required>
                </div>
                <!-- Campo oculto para enviar ID_ROL automáticamente -->
                <input type="hidden" name="id_rol" value="Administrador">
                <button name="btnregistrar" href="Admin.php" type="submit" class="btn btn-primary">Registrar</button>
            </form>
        </div>
    </div>

    <div class="footer">
        <p>&copy; 2024 derechos reservados grupo#7</p>
    </div>

    <script>
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('show');
        }
    </script>
</body>

</html>
