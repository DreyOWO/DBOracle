<?php
 
include('./config/conne.php');
include('./Model/ModelUsuario.php');  
 
?>
 
 
<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro de Usuario - Dashboard Admin Template</title>
    <!--
    Template 2108 Dashboard
    http://www.tooplate.com/view/2108-dashboard
    -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600">
    <!-- https://fonts.google.com/specimen/Open+Sans -->
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="css/tooplate.css">
</head>
 
<body class="bg03">
    <div class="container">
        <div class="row tm-mt-big">
            <div class="col-12 mx-auto tm-login-col">
                <div class="bg-white tm-block">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h2 class="tm-block-title mt-3">Registro de Usuario</h2>
                            <?php
                            if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'success') {
                                echo '<div class="alert alert-success" role="alert">¡Registro exitoso! Puedes iniciar sesión.</div>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <form action="./Model/ModelUsuario.php" method="post" class="tm-login-form">
                            <div class="input-group mt-3">
                                    <label for="nombre" class="col-xl-4 col-lg-4 col-md-4 col-sm-5 col-form-label">Nombre</label>
                                    <input name="nombre" type="text" class="form-control validate" id="nombre" required>
                                </div>
                                <div class="input-group mt-3">
                                    <label for="apellido1" class="col-xl-4 col-lg-4 col-md-4 col-sm-5 col-form-label">Apellido1</label>
                                    <input name="apellido1" type="text" class="form-control validate" id="apellido1" required>
                                </div>
                                <div class="input-group mt-3">
                                    <label for="apellido2" class="col-xl-4 col-lg-4 col-md-4 col-sm-5 col-form-label">Apellido2</label>
                                    <input name="apellido2" type="text" class="form-control validate" id="apellido2" required>
                                </div>
                                <div class="input-group mt-3">
                                    <label for="email" class="col-xl-4 col-lg-4 col-md-4 col-sm-5 col-form-label">Email</label>
                                    <input name="email" type="email" class="form-control validate" id="email" required>
                                </div>
                                <div class="input-group mt-3">
                                    <label for="telefono" class="col-xl-4 col-lg-4 col-md-4 col-sm-5 col-form-label">Teléfono</label>
                                    <input name="telefono" type="text" class="form-control validate" id="telefono">
                                </div>
                                <div class="input-group mt-3">
                                    <label for="contrasena" class="col-xl-4 col-lg-4 col-md-4 col-sm-5 col-form-label">Contraseña</label>
                                    <input name="contrasena" type="password" class="form-control validate" id="contrasena" required>
                                </div>
                                <div class="input-group mt-3">
                                    <label for="contacto_emergenciaTe" class="col-xl-4 col-lg-4 col-md-4 col-sm-5 col-form-label">Contacto de emergencia</label>
                                    <input name="contacto_emergenciaTe" type="text" class="form-control validate" id="contacto_emergenciaTe" required>
                                </div>
                                
                                <div class="input-group mt-3">
                                    <button name="btnregistrar" type="submit" class="btn btn-primary d-inline-block mx-auto">Registrar</button>
                                </div>
                            </form>
                            <div class="text-center mt-3">
                                <p class="mb-0">¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
 
</html>