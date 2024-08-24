<?php

include_once('D:/XAMPP/htdocs/DBProyecto/config/conne.php');
include_once('./Model/ModelVehiculo.php');

?>

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
        <h1>Gestión de Vehículos</h1>
        <!-- Formulario y contenido para la gestión de vehículos -->
        <!-- Aquí iría el contenido del formulario y la gestión de vehículos -->
    </div>

    <h2 class="mt-5">Lista de Vehículos</h2>
<!-- Formulario para cargar los vehículos -->
<form method="POST" action="vehiculos.php">
            <button type="submit" name="btnCargarVehiculos" class="btn btn-primary">Cargar Vehículos</button>
        </form>

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
                            <td><?php echo htmlspecialchars($vehiculo['ID_CLIENTE']) ?></td>
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
        <!-- Campo oculto para enviar el ID del cliente -->
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
    <form action="Model/ModelVehiculo.php" method="post">
        <div class="form-group">
            <label for="placa">Placa del Vehículo</label>
            <input type="text" class="form-control" id="placa" name="placa" required>
        </div>
        <button type="submit" name="btnEliminarVehiculo" class="btn btn-danger">Eliminar Vehículo</button>
    </form>
</body>

</html>
