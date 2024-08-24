<?php

class ModelProductos {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function obtenerArticulos() {
        // Preparar la llamada al procedimiento almacenado
        $stid = oci_parse($this->conn, 'BEGIN ObtenerArticulos(:p_ResultSet); END;');

        // Crear un nuevo cursor
        $cursor = oci_new_cursor($this->conn);
        oci_bind_by_name($stid, ':p_ResultSet', $cursor, -1, OCI_B_CURSOR);

        // Ejecutar el procedimiento almacenado
        oci_execute($stid);

        // Ejecutar el cursor
        oci_execute($cursor);

        // Crear un array para almacenar los artículos
        $articulos = [];

        // Obtener los resultados
        while (($row = oci_fetch_assoc($cursor)) != false) {
            $articulos[] = $row;
        }

        // Liberar recursos
        oci_free_statement($stid);
        oci_free_statement($cursor);

        return $articulos;
    }
}
