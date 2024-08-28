<?php

//

include("./config/conne.php");
include("./controllers/controllerLogin.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
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
            box-sizing: border-box;
        }

        .logo {
            max-width: 150px;
            margin-bottom: 2rem;
        }

        .login-container {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 0.625rem;
            box-shadow: 0 0.25rem 0.625rem rgba(0, 0, 0, 0.1);
            max-width: 90vw;
            width: 22rem; 
        }

        .login-container h2 {
            font-size: 1.75rem;
            font-family: 'Pacifico', cursive;
            color: #007bff;
            text-align: center;
            margin-bottom: 1.25rem;
            text-shadow: 0.063rem 0.063rem 0.313rem rgba(0, 0, 0, 0.1); 
        }

        .form-group label {
            font-weight: bold;
            color: #333;
        }

        .form-control {
            border-radius: 0.313rem; 
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.1);
            border: 0.063rem solid #ddd;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 0.625rem; 
            width: 100%;
            font-size: 1rem;
            border-radius: 0.313rem; 
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .register-link {
            text-align: center;
            margin-top: 1rem; 
        }

        .register-link a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <img src="images/logo.png" alt="Logo" class="logo">
    <div class="login-container">
        <h2>Iniciar Sesión</h2>
        <?php
        if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'success') {
            echo '<div class="alert alert-success" role="alert">¡Registro exitoso! Ahora puedes iniciar sesión.</div>';
        }
        ?>
        <form action="" method="post">
            <div class="form-group">
                <label for="correo">Correo</label>
                <input name="correo" type="text" class="form-control" id="correo" required>
            </div>
            <div class="form-group">
                <label for="contrasena">Contraseña</label>
                <input name="contrasena" type="password" class="form-control" id="contrasena" required>
            </div>
            <button name="btningresar" type="submit" class="btn btn-primary">Iniciar Sesión</button>
            <div class="register-link">
                <a href="nuevousuario.php">Regístrate aquí</a>
            </div>
        </form>
    </div>
</body>

</html>
 