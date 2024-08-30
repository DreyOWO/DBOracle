<?php
// Incluir la conexión a la base de datos
include_once('D:/XAMPP/htdocs/DBProyecto/config/conne.php');

session_start();

class CitasModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function obtenerCitas() {
        // Preparar la llamada al procedimiento almacenado
        $stid = oci_parse($this->conn, 'BEGIN ObtenerCitas(:p_cursor); END;');

        // Crear un nuevo cursor
        $cursor = oci_new_cursor($this->conn);
        oci_bind_by_name($stid, ':p_cursor', $cursor, -1, OCI_B_CURSOR);

        // Ejecutar el procedimiento almacenado
        oci_execute($stid);

        // Ejecutar el cursor
        oci_execute($cursor);

        // Crear un array para almacenar las citas
        $citas = [];

        // Obtener los resultados
        while (($row = oci_fetch_assoc($cursor)) != false) {
            $citas[] = $row;
        }

        // Liberar recursos
        oci_free_statement($stid);
        oci_free_statement($cursor);

        return $citas;
    }
}

if (isset($_POST['btnProgramar'])) {
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

if (isset($_POST['btnCancelar'])) {
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

if (isset($_POST['id_cita']) && isset($_POST['comentario'])) {
    $idCita = $_POST['id_cita'];
    $comentario = $_POST['comentario'];

    // Preparar la llamada al procedimiento almacenado
    $query = "BEGIN AgregarComentarioCita(:id_cita, :comentario); END;";
    $stid = oci_parse($conn, $query);
    oci_bind_by_name($stid, ':id_cita', $idCita);
    oci_bind_by_name($stid, ':comentario', $comentario);
    
    // Ejecutar el procedimiento almacenado
    if (oci_execute($stid)) {
        // Redirigir de vuelta a la página de citas en caso de éxito
        header("Location: citasAdmin.php");
        exit();
    } else {
        $e = oci_error($stid);
        echo "Error al agregar el comentario: " . $e['message'];
    }
}

// Verificar si el botón ha sido presionado
if (isset($_POST['btnEliminar'])) {
    // Verificar si se ha enviado el ID de la cita
    if (isset($_POST['id_cita'])) {
        $idCita = $_POST['id_cita'];

        // Preparar la llamada al procedimiento almacenado
        $query = "BEGIN EliminarCita(:p_Id_cita); END;";
        $stid = oci_parse($conn, $query);
        oci_bind_by_name($stid, ':p_Id_cita', $idCita);
        
        // Ejecutar el procedimiento almacenado
        if (oci_execute($stid)) {
            // Redirigir de vuelta a la página de citas en caso de éxito
            header("Location: citasAdmin.php");
            exit();
        } else {
            $e = oci_error($stid);
            echo "Error al eliminar la cita: " . $e['message'];
        }
    } else {
        echo "ID de cita no proporcionado.";
    }
}

?>
