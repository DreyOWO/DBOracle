<?php
// Incluye el archivo de conexión una sola vez
include_once('D:/XAMPP/htdocs/DBProyecto/config/conne.php');

// Verificar si se envió el formulario
if (isset($_POST['btnregistrar'])) {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $apellido1 = $_POST['apellido1'];
    $apellido2 = $_POST['apellido2']; 
    $correo = $_POST['email'];
    $telefono = $_POST['telefono'];
    $contrasena = $_POST['contrasena'];
    $contacto_emergencia = $_POST['contacto_emergenciaTe'];
    $id_rol = $_POST['id_rol']; // Obtener el ID_ROL

    // Preparar la llamada al procedimiento almacenado
    $stid = oci_parse($conn, 'BEGIN NuevoUsuario(:p_Nombre, :p_Apellido_1, :p_Apellido_2, :p_Correo, :p_Telefono, :p_Contrasena, :p_Contacto_emergencia, :p_ID_ROL); END;');

    // Enlazar los parámetros
    oci_bind_by_name($stid, ':p_Nombre', $nombre);
    oci_bind_by_name($stid, ':p_Apellido_1', $apellido1);
    oci_bind_by_name($stid, ':p_Apellido_2', $apellido2);
    oci_bind_by_name($stid, ':p_Correo', $correo);
    oci_bind_by_name($stid, ':p_Telefono', $telefono);
    oci_bind_by_name($stid, ':p_Contrasena', $contrasena);
    oci_bind_by_name($stid, ':p_Contacto_emergencia', $contacto_emergencia);
    oci_bind_by_name($stid, ':p_ID_ROL', $id_rol); // Enlazar el ID_ROL

    // Ejecutar el procedimiento almacenado
    $r = oci_execute($stid);
    
    // Verificar si la ejecución fue exitosa
    if (!$r) {
        $e = oci_error($stid);
        echo "Error ejecutando el procedimiento almacenado: " . htmlentities($e['message']);
    } else {
        echo "Usuario registrado exitosamente.";
    }

    // Liberar recursos y cerrar conexión
    oci_free_statement($stid);
    oci_close($conn);
}
?>
