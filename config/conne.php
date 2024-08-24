<?php
// Detalles de conexión
$host = 'localhost'; // Cambia esto por la IP o hostname de tu servidor Oracle
$port = '1521'; // Puerto por defecto de Oracle
$sid = 'orcl'; // El SID de tu base de datos Oracle
$username = 'C##proyecto'; // Tu usuario de Oracle
$password = 'Amigos1342'; // La contraseña de tu usuario

// Cadena de conexión
$connection_string = "(DESCRIPTION =
    (ADDRESS = (PROTOCOL = TCP)(HOST = $host)(PORT = $port))
    (CONNECT_DATA = (SID = $sid))
)";

// Conectar a la base de datos
$conn = oci_connect($username, $password, $connection_string);

// Verificar si la conexión fue exitosa
if (!$conn) {
    $e = oci_error();
    echo "Error al conectar a la base de datos: " . $e['message'];
    exit;
} else {
    echo "Conexión exitosa a la base de datos Oracle!";
}

// Aquí puedes ejecutar consultas a la base de datos
?>
