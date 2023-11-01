<?php
// Incluir el archivo de conexión a la base de datos
include_once __DIR__.'/database.php';

// Arreglo para almacenar la respuesta
$response = array();

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    // Realizar la consulta SQL para buscar el producto por ID
    $sql = "SELECT * FROM productos WHERE id = $id";
    $result = $conexion->query($sql);

    if ($result) {
        // Verificar si se encontraron resultados
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Crear un nuevo arreglo para almacenar los datos de respuesta
            $responseData = array();

            // Recorrer las columnas y agregarlas al arreglo de respuesta
            foreach ($row as $key => $value) {
                $responseData[$key] = $value;
            }

            // Agregar el arreglo de respuesta al arreglo principal
            $response = $responseData;
        }

        $result->free();
    } else {
        $response['error'] = 'Error en la consulta: ' . mysqli_error($conexion);
    }

    // Cerrar la conexión a la base de datos
    $conexion->close();
}

// Convertir el arreglo de respuesta a JSON
echo json_encode($response, JSON_PRETTY_PRINT);
?>
