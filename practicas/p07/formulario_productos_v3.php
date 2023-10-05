<?php
// MySQL Conexion
$link = mysqli_connect("localhost", "root", "19Molletes*eb", "marketzone");
// Chequea conección
if ($link === false) {
    die("ERROR: No pudo conectarse con la DB. " . mysqli_connect_error());
}

// Variables para almacenar los valores existentes en la base de datos
$nombre_existente = "";
$marca_existente = "";
$modelo_existente = "";
$precio_existente = "";
$unidades_existente = "";
$detalles_existente = "";
$imagen_existente = "";

// Verifica si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera los valores del formulario
    $nombre = $_POST["nombre"];
    $marca = $_POST["marca"];
    $modelo = $_POST["modelo"];
    $precio = $_POST["precio"];
    $unidades = $_POST["unidades"];
    $detalles = $_POST["detalles"];
    $imagen = $_POST["imagen"];

    // Aquí debes obtener el ID del registro que deseas editar, ya sea a través de un parámetro en la URL o de alguna otra forma
    $id = $_POST["id"]; // Supongamos que el ID se envía a través de un campo oculto en el formulario

    // Ejecuta la actualización del registro
    $sql = "UPDATE productos SET nombre='$nombre', marca='$marca', modelo='$modelo', precio=$precio, unidades=$unidades, detalles='$detalles', imagen='$imagen' WHERE id=$id";

    if (mysqli_query($link, $sql)) {
        echo "Registro actualizado.";
    } else {
        echo "ERROR: No se ejecutó la consulta. " . mysqli_error($link);
    }
} else {
    // Si el formulario no ha sido enviado y tienes el ID del registro que deseas cargar, obtén los valores existentes del registro
    $id = $_GET["id"]; // Supongamos que el ID se pasa a través de la URL
    $sql = "SELECT nombre, marca, modelo, precio, unidades, detalles, imagen FROM productos WHERE id=$id";
    $result = mysqli_query($link, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            $nombre_existente = $row['nombre'];
            $marca_existente = $row['marca'];
            $modelo_existente = $row['modelo'];
            $precio_existente = $row['precio'];
            $unidades_existente = $row['unidades'];
            $detalles_existente = $row['detalles'];
            $imagen_existente = $row['imagen'];
        }
        mysqli_free_result($result);
    } else {
        echo "ERROR: No se pudo obtener el registro existente. " . mysqli_error($link);
    }
}

// Cierra la conexión
mysqli_close($link);
?>



<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="../p06/estilos.css">
    <title>Actualizar de Productos</title>
</head>
<body>
    <h1>Actualizar de Productos</h1>
    <form action="formulario_productos_v3.php" method="POST" onsubmit="return validarFormulario()">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <label for="nombre">Nombre del Producto:</label>
<input type="text" id="nombre" name="nombre" required value="<?php echo $nombre_existente; ?>"><br><br>

<label for="marca">Marca:</label>
<select id="marca" name="marca" required>
    <option value="">Seleccionar marca</option>
    <option value="Samsung" <?php if ($marca_existente == 'Samsung') echo 'selected'; ?>>Samsung</option>
    <option value="Iphone" <?php if ($marca_existente == 'Iphone') echo 'selected'; ?>>Iphone</option>
    <option value="Huawei" <?php if ($marca_existente == 'Huawei') echo 'selected'; ?>>Huawei</option>
</select><br><br>

<label for="modelo">Modelo:</label>
<input type="text" id="modelo" name="modelo" required value="<?php echo $modelo_existente; ?>"><br><br>

<label for="precio">Precio:</label>
<input type="number" id="precio" name="precio" step="0.01" required value="<?php echo $precio_existente; ?>"><br><br>

<label for="unidades">Unidades:</label>
<input type="number" id="unidades" name="unidades" required value="<?php echo $unidades_existente; ?>"><br><br>

<label for="detalles">Detalles:</label>
<textarea id="detalles" name="detalles" maxlength="250"><?php echo $detalles_existente; ?></textarea><br><br>

<label for="imagen">URL de la Imagen:</label>
<input type="text" id="imagen" name="imagen" value="<?php echo $imagen_existente; ?>"><br><br>

        <input type="submit" value="Actualizar Producto">
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
                document.getElementById("imagen").value = "http://localhost/tecwebCarlos/actividades/01-la_web_estatica/img/img.png";
            }

            return true;
        }
    </script>
</body>
</html>
