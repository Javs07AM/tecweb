<?php
// Incluir el archivo de conexión a la base de datos
include_once __DIR__.'/database.php';

// Arreglo para almacenar la respuesta
$response = array(
    'status' => 'error',
    'message' => 'La consulta falló'
);

// Verificar si se ha recibido el ID y los datos del producto
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    // Obtener y sanitizar los datos del formulario
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $marca = mysqli_real_escape_string($conexion, $_POST['marca']);
    $modelo = mysqli_real_escape_string($conexion, $_POST['modelo']);
    $precio = floatval($_POST['precio']);
    $detalles = mysqli_real_escape_string($conexion, $_POST['detalles']);
    $unidades = intval($_POST['unidades']);
    $imagen = mysqli_real_escape_string($conexion, $_POST['imagen']);

    // Construir la consulta SQL de actualización
    $sql = "UPDATE productos SET nombre='$nombre', marca='$marca', modelo='$modelo', precio=$precio, detalles='$detalles', unidades=$unidades, imagen='$imagen' WHERE id=$id";

    // Establecer el conjunto de caracteres a UTF-8
    $conexion->set_charset("utf8");

    // Ejecutar la consulta SQL de actualización
    if ($conexion->query($sql)) {
        $response['status'] = 'success';
        $response['message'] = 'Producto actualizado';
    } else {
        $response['message'] = 'ERROR: No se ejecutó la consulta SQL. ' . mysqli_error($conexion);
    }

    // Cerrar la conexión a la base de datos
    $conexion->close();
}

// Convertir el arreglo de respuesta a JSON
echo json_encode($response, JSON_PRETTY_PRINT);
?>
