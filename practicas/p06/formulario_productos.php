<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="estilos.css">
    <title>Registro de Productos</title>
</head>
<body>
    <h1>Registro de Productos</h1>
    <form action="set_producto_v2.php" method="POST">
        <label for="nombre">Nombre del Producto:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="marca">Marca:</label>
        <input type="text" id="marca" name="marca" required><br><br>

        <label for="modelo">Modelo:</label>
        <input type="text" id="modelo" name="modelo" required><br><br>

        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" step="0.01" required><br><br>

        <label for="unidades">Unidades:</label>
        <input type="number" id="unidades" name="unidades" required><br><br>

        <label for="detalles">Detalles:</label>
        <textarea id="detalles" name="detalles"></textarea><br><br>

        <label for="imagen">URL de la Imagen:</label>
        <input type="text" id="imagen" name="imagen"><br><br>

        <input type="submit" value="Registrar Producto">
    </form>
</body>
</html>
