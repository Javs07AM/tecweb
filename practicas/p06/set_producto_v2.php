<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validación de datos
    $nombre = $_POST['nombre'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $precio = $_POST['precio'];
    $unidades = $_POST['unidades'];
    $detalles = $_POST['detalles'];
    $imagen = $_POST['imagen'];

    // Verificar que ningún dato esté vacío
    if (empty($nombre) || empty($marca) || empty($modelo) || empty($precio) || empty($unidades)) {
        die('Todos los campos son obligatorios.');
    }

    // Validar el formato del precio
    if (!is_numeric($precio) || strpos($precio, '.') === false) {
        die('El precio debe ser un número con punto decimal.');
    }

    // Conectar a la base de datos
    $mysqli = new mysqli('localhost', 'root', '19Molletes*eb', 'marketzone');

    // Verificar errores de conexión
    if ($mysqli->connect_errno) {
        die('Error en la conexión a la base de datos: ' . $mysqli->connect_error);
    }

    // Insertar el nuevo producto en la base de datos
    $query = "INSERT INTO productos (nombre, marca, modelo, precio, unidades, detalles, imagen, eliminado) 
              VALUES ('$nombre', '$marca', '$modelo', $precio, $unidades, '$detalles', '$imagen', 0)";

    if ($mysqli->query($query)) {
        echo 'Producto registrado con éxito:';
        echo '<ul>';
        echo "<li>Nombre: $nombre</li>";
        echo "<li>Marca: $marca</li>";
        echo "<li>Modelo: $modelo</li>";
        echo "<li>Precio: $precio</li>";
        echo "<li>Unidades: $unidades</li>";
        echo "<li>Detalles: $detalles</li>";
        echo "<li>Imagen: <img src='$imagen' alt='$nombre' /></li>";
        echo '</ul>';
    } else {
        echo 'Error al registrar el producto: ' . $mysqli->error;
    }

    // Cerrar la conexión a la base de datos
    $mysqli->close();
} else {
    echo 'Acceso no permitido.';
}
?>
