<?php
// Iniciar sesión
session_start();

// Incluye el archivo de conexión una sola vez
include_once('D:/XAMPP/htdocs/DBProyecto/config/conne.php');

// Verificar si se envió el formulario
if (isset($_POST['btningresar'])) {
    // Obtener los datos del formulario
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    // Preparar la consulta para verificar las credenciales
    $stid = oci_parse($conn, "SELECT ID_USUARIO FROM Usuario WHERE CORREO = :p_Correo AND CONTRASENA = :p_Contrasena");
    
    // Enlazar los parámetros
    oci_bind_by_name($stid, ':p_Correo', $correo);
    oci_bind_by_name($stid, ':p_Contrasena', $contrasena);
    
    // Ejecutar la consulta
    oci_execute($stid);
    
    // Verificar si se encontró un usuario
    $user = oci_fetch_assoc($stid);
    
    if ($user) {
        // Almacenar el ID del usuario en la sesión
        $_SESSION['ID_CLIENTE'] = $user['ID_USUARIO']; // Asegúrate de almacenar el ID en la variable de sesión correcta
        
        // Redirigir al usuario a la página principal o dashboard
        header('Location: index.php');
    } else {
        // Redirigir con un mensaje de error
        header('Location: login.php?mensaje=error');
    }
    
    // Liberar recursos y cerrar conexión
    oci_free_statement($stid);
    oci_close($conn);
}
?>
