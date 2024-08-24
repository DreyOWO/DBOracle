<?php

session_start();


// Incluir la conexión a la base de datos
include_once('D:/XAMPP/htdocs/DBProyecto/config/conne.php');
include_once('./Model/ModelVehiculo.php');


$vehiculos = [];

if (isset($_POST['btnAgregarVehiculo'])) {
    // Obtener los demás datos del formulario
    $placa = $_POST['placa'];
    $tipo = $_POST['tipo'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $año = (int)$_POST['año'];  // Asegurarse de que sea un número

    // Obtener el ID_CLIENTE desde la sesión
    $id_cliente = $_SESSION['ID_CLIENTE'];

    // Preparar la llamada al procedimiento almacenado
    $stid = oci_parse($conn, 'BEGIN NuevoVehiculo(:p_Placa, :p_Id_cliente, :p_Tipo, :p_Marca, :p_Modelo, :p_Ano); END;');

    // Enlazar los parámetros con los valores del formulario y el ID_CLIENTE de la sesión
    oci_bind_by_name($stid, ':p_Placa', $placa);
    oci_bind_by_name($stid, ':p_Id_cliente', $id_cliente);
    oci_bind_by_name($stid, ':p_Tipo', $tipo);
    oci_bind_by_name($stid, ':p_Marca', $marca);
    oci_bind_by_name($stid, ':p_Modelo', $modelo);
    oci_bind_by_name($stid, ':p_Ano', $año);  // Usar `Ano` en lugar de `Año` debido a que los caracteres especiales pueden causar problemas

    // Ejecutar el procedimiento
    if (oci_execute($stid)) {
        // Redirigir con un mensaje de éxito
        header('Location: nuevovehiculo.php?mensaje=success');
    } else {
        // Mostrar el error en caso de fallo
        $e = oci_error($stid);
        echo "Error al ejecutar el procedimiento: " . $e['message'];
    }

    // Liberar los recursos
    oci_free_statement($stid);
    oci_close($conn);
}


if (isset($_POST['btnEliminarVehiculo'])) {
    // Obtener la placa del vehículo desde el formulario
    $placa = $_POST['placa'];

    // Preparar la llamada al procedimiento almacenado
    $stid = oci_parse($conn, 'BEGIN EliminarVehiculo(:p_Placa); END;');

    // Enlazar el parámetro con el valor de la placa
    oci_bind_by_name($stid, ':p_Placa', $placa);

    // Ejecutar el procedimiento
    if (oci_execute($stid)) {
        // Redirigir con un mensaje de éxito
        header('Location: eliminarvehiculo.php?mensaje=success');
    } else {
        // Mostrar el error en caso de fallo
        $e = oci_error($stid);
        echo "Error al ejecutar el procedimiento: " . $e['message'];
    }

    // Liberar los recursos
    oci_free_statement($stid);
    oci_close($conn);
}

if (isset($_SESSION['ID_CLIENTE'])) {
    $id_cliente = $_SESSION['ID_CLIENTE'];

    // Preparar la llamada al procedimiento almacenado
    $stid = oci_parse($conn, 'BEGIN ObtenerVehiculosPorCliente(:p_Id_cliente, :p_ResultSet); END;');

    // Enlazar el parámetro de entrada
    oci_bind_by_name($stid, ':p_Id_cliente', $id_cliente);

    // Enlazar el cursor de salida
    $cursor = oci_new_cursor($conn);
    oci_bind_by_name($stid, ':p_ResultSet', $cursor, -1, OCI_B_CURSOR);

    // Ejecutar el procedimiento almacenado
    oci_execute($stid);

    // Ejecutar el cursor
    oci_execute($cursor);

    // Crear un array para almacenar los vehículos
    $vehiculos = [];

    // Obtener los resultados
    while (($row = oci_fetch_assoc($cursor)) != false) {
        $vehiculos[] = $row;
    }

    // Liberar recursos
    oci_free_statement($stid);
    oci_free_statement($cursor);
    oci_close($conn);
} else {
    header('Location: login.php');
    exit();
}
