
-- 1. Contar el número de usuarios
CREATE OR REPLACE FUNCTION contar_usuarios RETURN NUMBER IS
  v_count NUMBER;
BEGIN
  SELECT COUNT(*) INTO v_count FROM Usuario;
  RETURN v_count;
END;
/
--Ejecutar--
SET SERVEROUTPUT ON;
DECLARE
  v_count NUMBER;
BEGIN
  v_count := contar_usuarios();
  DBMS_OUTPUT.PUT_LINE('Número de usuarios: ' || v_count);
END;
/

-- 2. Obtener el nombre completo de un usuario dado su ID
CREATE OR REPLACE FUNCTION obtener_nombre_usuario(p_id_usuario INT) RETURN VARCHAR2 IS
  v_nombre_completo VARCHAR2(100);
BEGIN
  SELECT Nombre || ' ' || Apellido_1 || ' ' || Apellido_2
  INTO v_nombre_completo
  FROM Usuario
  WHERE Id_usuario = p_id_usuario;
  
  RETURN v_nombre_completo;
EXCEPTION
  WHEN NO_DATA_FOUND THEN
    RETURN 'Usuario no encontrado';
END;
/
--Ejecutar--
SET SERVEROUTPUT ON;
DECLARE
  v_nombre_completo VARCHAR2(100);
BEGIN
  v_nombre_completo := obtener_nombre_usuario(1); <---editar
  DBMS_OUTPUT.PUT_LINE('Nombre completo del usuario: ' || v_nombre_completo);
END;
/


-- 3. Obtener la cantidad total de productos en el inventario
CREATE OR REPLACE FUNCTION total_producto_inventario RETURN NUMBER IS
  v_total NUMBER;
BEGIN
  SELECT SUM(Cantidad) INTO v_total FROM Inventario;
  RETURN v_total;
END;
/

-- 4. Calcular el total de ventas de un producto específico
CREATE OR REPLACE FUNCTION total_ventas_producto(p_id_producto INT) RETURN DECIMAL IS
  v_total_ventas DECIMAL(10, 2);
BEGIN
  SELECT SUM(Cantidad * Precio)
  INTO v_total_ventas
  FROM Ventas v
  JOIN Inventario i ON v.Id_producto = i.Id_producto
  WHERE v.Id_producto = p_id_producto;
  
  RETURN v_total_ventas;
EXCEPTION
  WHEN NO_DATA_FOUND THEN
    RETURN 0;
END;
/

-- 5. Obtener el promedio de precios de los productos
CREATE OR REPLACE FUNCTION promedio_precios RETURN DECIMAL IS
  v_promedio DECIMAL(10, 2);
BEGIN
  SELECT AVG(Precio) INTO v_promedio FROM Inventario;
  RETURN v_promedio;
END;
/

-- 6. Contar el número de citas para un cliente
CREATE OR REPLACE FUNCTION contar_citas_cliente(p_id_cliente INT) RETURN NUMBER IS
  v_count NUMBER;
BEGIN
  SELECT COUNT(*) INTO v_count FROM Citas WHERE Id_cliente = p_id_cliente;
  RETURN v_count;
END;
/

-- 7. Obtener las citas pendientes de un cliente
CREATE OR REPLACE FUNCTION citas_pendientes_cliente(p_id_cliente INT) RETURN SYS_REFCURSOR IS
  v_cursor SYS_REFCURSOR;
BEGIN
  OPEN v_cursor FOR
    SELECT * FROM Citas
    WHERE Id_cliente = p_id_cliente AND Estado = 'Pendiente';
  
  RETURN v_cursor;
END;
/

-- 8. Obtener el total de facturas de un usuario específico
CREATE OR REPLACE FUNCTION total_facturas_usuario(p_id_usuario INT) RETURN DECIMAL IS
  v_total DECIMAL(10, 2);
BEGIN
  SELECT SUM(Total) INTO v_total FROM Facturas WHERE Id_usuario = p_id_usuario;
  RETURN v_total;
END;
/

-- 9. Obtener el detalle de una factura específica
CREATE OR REPLACE FUNCTION detalles_factura(p_id_factura INT) RETURN SYS_REFCURSOR IS
  v_cursor SYS_REFCURSOR;
BEGIN
  OPEN v_cursor FOR
    SELECT * FROM DetallesFactura
    WHERE Id_factura = p_id_factura;
  
  RETURN v_cursor;
END;
/

-- 10. Obtener los vehículos de un cliente específico
CREATE OR REPLACE FUNCTION vehiculos_cliente(p_id_cliente INT) RETURN SYS_REFCURSOR IS
  v_cursor SYS_REFCURSOR;
BEGIN
  OPEN v_cursor FOR
    SELECT * FROM Vehiculos
    WHERE Id_cliente = p_id_cliente;
  
  RETURN v_cursor;
END;
/
