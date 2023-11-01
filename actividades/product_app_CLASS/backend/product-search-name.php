<?php
// Incluir el archivo de conexión a la base de datos
include_once __DIR__ . '/database.php';

// Arreglo para almacenar la respuesta
$response = array(
    'status' => 'success',
    'message' => 'El nombre de producto está disponible'
);

if (isset($_POST['nombre'])) {
    // Obtener y sanitizar el nombre del producto
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    
    // Validar que el nombre no esté vacío
    if (!empty($nombre)) {
        // Construir la consulta SQL para buscar productos por nombre
        $sql = "SELECT * FROM productos WHERE nombre = '$nombre' AND eliminado = 0";

        // Ejecutar la consulta SQL
        if ($result = $conexion->query($sql)) {
            if ($result->num_rows > 0) {
                $response['status'] = 'error';
                $response['message'] = 'El nombre de producto ya existe en la base de datos';
            }
            $result->free();
        } else {
            $response['message'] = 'ERROR: No se ejecutó la consulta SQL. ' . mysqli_error($conexion);
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'El nombre de producto no puede estar vacío';
    }
}

// Cerrar la conexión a la base de datos
$conexion->close();

// Convertir el arreglo de respuesta a JSON
echo json_encode($response, JSON_PRETTY_PRINT);
?>