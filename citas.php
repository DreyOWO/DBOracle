<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Citas</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <div class="sidebar">
        <h2>Menú</h2>
        <a href="index.php">Inicio</a>
        <a href="citas.php">Citas</a>
        <a href="vehiculos.php">Vehículos</a>
    </div>
    <div class="content">
        <h1>Gestión de Citas</h1>
        <!-- Formulario y contenido para la gestión de citas -->
        <!-- Aquí iría el contenido del formulario y la gestión de citas -->
    </div>
    <div class="container">
        <h2 class="mt-5">Programar Nueva Cita</h2>
        <form action="Model/ModelCita.php" method="post">
            <!-- Campo oculto para ID Cliente -->
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
</body>

</html>