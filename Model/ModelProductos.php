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
        
        // Paso 2: Insertar la factura y obtener el ID generado
        $sql = 'BEGIN :p_Id_factura := RegistrarVenta(:p_Id_usuario, :p_Descripcion, :p_Cantidad, :p_Precio_unitario); END;';
        $stid = oci_parse($this->conn, $sql);
        oci_bind_by_name($stid, ':p_Id_usuario', $idCliente);
        oci_bind_by_name($stid, ':p_Descripcion', $descripcion);
        oci_bind_by_name($stid, ':p_Cantidad', $cantidad);
        oci_bind_by_name($stid, ':p_Precio_unitario', $precioUnitario);
        oci_bind_by_name($stid, ':p_Id_factura', $idFactura, 32); // Asegúrate de capturar el ID
        
        if (!oci_execute($stid)) {
            $error = oci_error($stid);
            echo "Error al registrar la venta: " . $error['message'];
            return false;
        }
        
        // Paso 3: Insertar los detalles de la venta en la tabla detallesfactura
        $sql = 'BEGIN INSERT INTO detallesfactura (ID_DETALLE, ID_FACTURA, DESCRIPCION, CANTIDAD, PRECIO_UNITARIO, SUBTOTAL) 
                VALUES (detallesfactura_seq.NEXTVAL, :p_Id_factura, :p_Descripcion, :p_Cantidad, :p_PrecioUnitario, :p_Subtotal); END;';
        $stid = oci_parse($this->conn, $sql);
        oci_bind_by_name($stid, ':p_Id_factura', $idFactura);
        oci_bind_by_name($stid, ':p_Descripcion', $descripcion);
        oci_bind_by_name($stid, ':p_Cantidad', $cantidad);
        oci_bind_by_name($stid, ':p_PrecioUnitario', $precioUnitario);
        oci_bind_by_name($stid, ':p_Subtotal', $subtotal);
        
        if (!oci_execute($stid)) {
            $error = oci_error($stid);
            echo "Error al registrar los detalles de la venta: " . $error['message'];
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
