<?php

// Incluir la conexión a la base de datos
include_once('D:/XAMPP/htdocs/DBProyecto/config/conne.php');


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class ModelProductos {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function agregarProducto($id_producto, $nombre, $descripcion, $cantidad, $precio) {
        $stid = oci_parse($this->conn, 'BEGIN InsertarNuevoProducto(:p_ID_PRODUCTO, :p_NOMBRE, :p_DESCRIPCION, :p_CANTIDAD, :p_PRECIO); END;');

        oci_bind_by_name($stid, ':p_ID_PRODUCTO', $id_producto);
        oci_bind_by_name($stid, ':p_NOMBRE', $nombre);
        oci_bind_by_name($stid, ':p_DESCRIPCION', $descripcion);
        oci_bind_by_name($stid, ':p_CANTIDAD', $cantidad);
        oci_bind_by_name($stid, ':p_PRECIO', $precio);

        oci_execute($stid);
        oci_commit($this->conn);
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

    public function agregarStock($id_producto, $cantidad) {
        try {
            // Preparar la llamada al procedimiento almacenado
            $stid = oci_parse($this->conn, 'BEGIN AgregarStock(:id_producto, :cantidad); END;');
            // Enlazar los parámetros del procedimiento
            oci_bind_by_name($stid, ':id_producto', $id_producto, -1, SQLT_INT);
            oci_bind_by_name($stid, ':cantidad', $cantidad, -1, SQLT_INT);
            // Ejecutar el procedimiento
            oci_execute($stid);
            return true;
        } catch (Exception $e) {
            // Manejar errores
            return false;
        }
    }

    public function eliminarProducto($id_producto) {
        try {
            // Preparar la llamada al procedimiento almacenado
            $stid = oci_parse($this->conn, 'BEGIN EliminarProducto(:id_producto); END;');
            // Enlazar el parámetro del procedimiento
            oci_bind_by_name($stid, ':id_producto', $id_producto, -1, SQLT_INT);
            // Ejecutar el procedimiento
            oci_execute($stid);
            return true;
        } catch (Exception $e) {
            // Manejar errores
            return false;
        }
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
        // Paso 1: Obtener la descripción y el precio del producto
        $query = 'SELECT descripcion, precio FROM Inventario WHERE id_producto = :p_Id_producto';
        $stid = oci_parse($this->conn, $query);
        oci_bind_by_name($stid, ':p_Id_producto', $idProducto);
    
        if (!oci_execute($stid)) {
            $error = oci_error($stid);
            echo "Error al obtener los datos del producto: " . $error['message'];
            return false;
        }
    
        $productData = oci_fetch_assoc($stid);
        $descripcion = $productData['DESCRIPCION'];
        $precioUnitario = $productData['PRECIO'];
    
        // Calcular el subtotal
        $subtotal = (float)$cantidad * (float)$precioUnitario;
    
        // Paso 2: Llamar al procedimiento para registrar la venta
        $sql = 'BEGIN RegistrarVenta(:p_Id_usuario, :p_Descripcion, :p_Cantidad, :p_Precio_unitario); END;';
        $stid = oci_parse($this->conn, $sql);
        oci_bind_by_name($stid, ':p_Id_usuario', $idCliente);
        oci_bind_by_name($stid, ':p_Descripcion', $descripcion);
        oci_bind_by_name($stid, ':p_Cantidad', $cantidad);
        oci_bind_by_name($stid, ':p_Precio_unitario', $precioUnitario);
    
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
