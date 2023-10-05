<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="../p06/estilos.css">
    <title>Registro de Productos</title>
</head>
<body>
    <h1>Registro de Productos</h1>
    <form action="../p06/set_producto_v2.php" method="POST" onsubmit="return validarFormulario()">
        <label for="nombre">Nombre del Producto:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="marca">Marca:</label>
        <select id="marca" name="marca" required>
            <option value="">Seleccionar marca</option>
            <option value="Marca1">Samsung</option>
            <option value="Marca2">Iphone</option>
            <option value="Marca3">Huawei</option>
        </select><br><br>

        <label for="modelo">Modelo:</label>
        <input type="text" id="modelo" name="modelo" required><br><br>

        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" step="0.01" required><br><br>

        <label for="unidades">Unidades:</label>
        <input type="number" id="unidades" name="unidades" required><br><br>

        <label for="detalles">Detalles:</label>
        <textarea id="detalles" name="detalles" maxlength="250"></textarea><br><br>

        <label for="imagen">URL de la Imagen:</label>
        <input type="text" id="imagen" name="imagen"><br><br>

        <input type="submit" value="Registrar Producto">
    </form>

    <script>
        function validarFormulario() {
            var nombre = document.getElementById("nombre").value;
            var marca = document.getElementById("marca").value;
            var modelo = document.getElementById("modelo").value;
            var precio = parseFloat(document.getElementById("precio").value);
            var unidades = parseInt(document.getElementById("unidades").value);
            var detalles = document.getElementById("detalles").value;
            var imagen = document.getElementById("imagen").value;

            if (nombre.length === 0 || nombre.length > 100) {
                alert("El nombre debe ser requerido y tener 100 caracteres o menos.");
                return false;
            }

            if (marca === "") {
                alert("Debe seleccionar una marca.");
                return false;
            }

            if (modelo.length === 0 || modelo.length > 25 || !/^[a-zA-Z0-9\s]+$/.test(modelo)) {
                alert("El modelo debe ser requerido, alfanumérico y tener 25 caracteres o menos.");
                return false;
            }

            if (isNaN(precio) || precio <= 99.99) {
                alert("El precio debe ser requerido y mayor a 99.99.");
                return false;
            }

            if (unidades < 0) {
                alert("Las unidades deben ser un número mayor o igual a 0.");
                return false;
            }

            if (detalles.length > 250) {
                alert("Los detalles deben tener 250 caracteres o menos.");
                return false;
            }

            if (imagen.length === 0) {
                // Usar la ruta de imagen por defecto si no se proporciona una
                document.getElementById("imagen").value = "ruta_por_defecto.jpg";
            }

            return true;
        }
    </script>
</body>
</html>
