<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
</head>
<body>
    <h1>Factura</h1>

    <?php if ($factura): ?>
        <p><strong>ID Factura:</strong> <?php echo htmlspecialchars($factura['ID_FACTURA']); ?></p>
        <p><strong>ID Usuario:</strong> <?php echo htmlspecialchars($factura['ID_USUARIO']); ?></p>
        <p><strong>Fecha:</strong> <?php echo htmlspecialchars($factura['FECHA']); ?></p>
        <p><strong>Total:</strong> <?php echo htmlspecialchars($factura['TOTAL']); ?></p>
    <?php else: ?>
        <p>No se encontró la factura.</p>
    <?php endif; ?>

    <a href="index.php">Volver</a>
</body>
</html>
