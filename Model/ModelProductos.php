<?php



ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
    public function actualizarCantidadDeProducto($idProducto, $cantidad) {
        $sql = 'BEGIN ActualizarCantidadDeProducto(:p_Id_producto, :p_Cantidad); END;';
        $stid = oci_parse($this->conn, $sql);
        oci_bind_by_name($stid, ':p_Id_producto', $idProducto);
        oci_bind_by_name($stid, ':p_Cantidad', $cantidad);

        $result = oci_execute($stid);
    
        if (!oci_execute($stid)) {
            $error = oci_error($stid);
            echo "Error en la actualización del producto: " . $error['message'];
            return false;
        }
    
        return true;
    }
    public function registrarVenta($idCliente, $idProducto, $cantidad) {
        $sql = 'BEGIN RegistrarVenta(:p_Id_cliente, :p_Id_producto, :p_Cantidad); END;';
        $stid = oci_parse($this->conn, $sql);
        oci_bind_by_name($stid, ':p_Id_cliente', $idCliente);
        oci_bind_by_name($stid, ':p_Id_producto', $idProducto);
        oci_bind_by_name($stid, ':p_Cantidad', $cantidad);
    
        if (!oci_execute($stid)) {
            $error = oci_error($stid);
            echo "Error al registrar la venta: " . $error['message'];
            return false;
        }
    
        return true;
    }
    
    public function obtenerFactura($idFactura) {
        $query = "SELECT f.ID_FACTURA, f.ID_USUARIO, f.FECHA, SUM(d.SUBTOTAL) AS TOTAL 
                  FROM Facturas f
                  JOIN DetallesFactura d ON f.ID_FACTURA = d.ID_FACTURA
                  WHERE f.ID_FACTURA = :idFactura
                  GROUP BY f.ID_FACTURA, f.ID_USUARIO, f.FECHA";
        
        $stid = oci_parse($this->conn, $query);
        oci_bind_by_name($stid, ':idFactura', $idFactura);
        oci_execute($stid);
        
        $factura = oci_fetch_assoc($stid);
        oci_free_statement($stid);
        
        return $factura;
    }
    
}
