<?php
// Incluir la conexión a la base de datos
include_once('D:/XAMPP/htdocs/DBProyecto/config/conne.php');
class ModelDetallesFactura {
    private $conn;

    // Constructor para recibir la conexión de la base de datos
    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Método para ejecutar el procedimiento almacenado
    public function mostrarDetallesFactura() {
        $result = [];

        // Preparar la llamada al procedimiento almacenado
        $stid = oci_parse($this->conn, 'BEGIN MostrarDetallesFactura; END;');

        // Ejecutar el procedimiento almacenado
        if (oci_execute($stid)) {
            // Obtener resultados
            $query = oci_parse($this->conn, 'SELECT * FROM detallesfactura');
            oci_execute($query);

            while (($row = oci_fetch_assoc($query)) != false) {
                $result[] = $row;
            }
        } else {
            $e = oci_error($stid);
            throw new Exception('Error al ejecutar el procedimiento: ' . $e['message']);
        }

        return $result;
    }
}

?>
