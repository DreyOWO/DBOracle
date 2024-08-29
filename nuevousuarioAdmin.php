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
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .logo {
            max-width: 150px;
            margin-bottom: 2rem;
        }

        .register-container {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            margin: 1rem;
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
    <img src="images/logo.png" alt="Logo" class="logo">
    <div class="register-container">
        <h2>Registro de Usuario</h2>
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
                <input name="contacto_emergenciaTe" type="text" class="form-control" id="contacto_emergenciaTe"
                    required>
            </div>
            <!-- Campo oculto para enviar ID_ROL automáticamente -->
            <input type="hidden" name="id_rol" value="Administrador">
            <button name="btnregistrar" href="Admin.php" type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>
</body>
</html>