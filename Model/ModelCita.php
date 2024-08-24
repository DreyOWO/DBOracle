<?php
// Incluir la conexión a la base de datos
include_once('D:/XAMPP/htdocs/DBProyecto/config/conne.php');

session_start();

if (isset($_POST['btnAgregarCita'])) {
    // Obtener los datos del formulario
    $placa = $_POST['placa'];
    $fecha = $_POST['fecha'];
    $motivo = $_POST['motivo'];

    // Obtener el ID_CLIENTE desde la sesión
    $id_cliente = $_SESSION['ID_CLIENTE'];

    // Convertir la fecha del formato YYYY-MM-DD a DD/MM/YYYY
    $fecha_formateada = date('d/m/Y', strtotime($fecha));

    // Generar un valor aleatorio de 3 dígitos para ID_CITA
    $id_cita = rand(100, 999);

    // Preparar la llamada al procedimiento almacenado
    $stid = oci_parse($conn, 'BEGIN NuevaCita(:p_Id_cita, :p_Id_cliente, :p_Placa, :p_Fecha, :p_Motivo, :p_Estado, :p_Motivo_cancelacion); END;');

    // Definir los valores predeterminados para los parámetros que no se utilizan
    $estado = 'Pendiente'; // Asignar el valor inicial
    $motivo_cancelacion = null; // Inicializar como NULL

    // Enlazar los parámetros con las variables del formulario y los valores predeterminados
    oci_bind_by_name($stid, ':p_Id_cita', $id_cita);
    oci_bind_by_name($stid, ':p_Id_cliente', $id_cliente);
    oci_bind_by_name($stid, ':p_Placa', $placa);
    oci_bind_by_name($stid, ':p_Fecha', $fecha_formateada);
    oci_bind_by_name($stid, ':p_Motivo', $motivo);
    oci_bind_by_name($stid, ':p_Estado', $estado); // Estado inicial
    oci_bind_by_name($stid, ':p_Motivo_cancelacion', $motivo_cancelacion);

    // Ejecutar el procedimiento
    if (oci_execute($stid)) {
        // Redirigir con un mensaje de éxito
        header('Location: nuevocita.php?mensaje=success');
    } else {
        // Mostrar el error en caso de fallo
        $e = oci_error($stid);
        echo "Error al ejecutar el procedimiento: " . $e['message'];
    }

    // Liberar los recursos
    oci_free_statement($stid);
    oci_close($conn);
}

if (isset($_POST['btnEliminarCita'])) {
    // Obtener el ID_CITA desde el formulario
    $id_cita = $_POST['id_cita'];

    // Preparar la llamada al procedimiento almacenado para actualizar el estado
    $stid = oci_parse($conn, 'BEGIN ActualizarEstadoDeCita(:p_Id_cita, :p_Estado); END;');

    // Enlazar los parámetros
    $estado = 'Cancelada'; // Nuevo estado
    oci_bind_by_name($stid, ':p_Id_cita', $id_cita);
    oci_bind_by_name($stid, ':p_Estado', $estado);

    // Ejecutar el procedimiento
    if (oci_execute($stid)) {
        // Redirigir con un mensaje de éxito
        header('Location: eliminarcita.php?mensaje=success');
    } else {
        // Mostrar el error en caso de fallo
        $e = oci_error($stid);
        echo "Error al ejecutar el procedimiento: " . $e['message'];
    }

    // Liberar los recursos
    oci_free_statement($stid);
    oci_close($conn);
}
?>
