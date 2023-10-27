<?php
// Incluir el archivo de conexión a la base de datos
include_once __DIR__.'/database.php';

// Arreglo para almacenar la respuesta
$response = array(
    'status' => 'error',
    'message' => 'No se encontraron productos con ese nombre',
    'data' => array()
);

if (isset($_POST['nombre'])) {
    // Obtener y sanitizar el nombre del producto
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);

    // Construir la consulta SQL para buscar productos por nombre
    $sql = "SELECT * FROM productos WHERE nombre LIKE '%$nombre%' AND eliminado = 0";

    // Establecer el conjunto de caracteres a UTF-8
    $conexion->set_charset("utf8");

    // Ejecutar la consulta SQL
    if ($result = $conexion->query($sql)) {
        if ($result->num_rows > 0) {
            $response['status'] = 'success';
            $response['message'] = 'Productos encontrados';
            while ($row = $result->fetch_assoc()) {
                $response['data'][] = $row;
            }
        }
        $result->free();
    } else {
        $response['message'] = 'ERROR: No se ejecutó la consulta SQL. ' . mysqli_error($conexion);
    }

    // Cerrar la conexión a la base de datos
    $conexion->close();
}

// Convertir el arreglo de respuesta a JSON
echo json_encode($response, JSON_PRETTY_PRINT);
?>
