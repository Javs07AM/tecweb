<?php
// Incluir el archivo de conexión a la base de datos
include_once __DIR__.'/database.php';

// Arreglo para almacenar la respuesta
$response = array(
    'status' => 'error',
    'message' => 'Ya existe un producto con ese nombre'
);

if (isset($_POST['nombre'])) {
    // Obtener y sanitizar los datos del formulario
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $marca = mysqli_real_escape_string($conexion, $_POST['marca']);
    $modelo = mysqli_real_escape_string($conexion, $_POST['modelo']);
    $precio = floatval($_POST['precio']);
    $detalles = mysqli_real_escape_string($conexion, $_POST['detalles']);
    $unidades = intval($_POST['unidades']);
    $imagen = mysqli_real_escape_string($conexion, $_POST['imagen']);

    // Validaciones
    if (empty($nombre) || strlen($nombre) > 100) {
        $response['message'] = 'El nombre debe ser requerido y tener 100 caracteres o menos.';
    } elseif (empty($marca)) {
        $response['message'] = 'La marca debe ser requerida.';
    } elseif (empty($modelo)) {
        $response['message'] = 'El modelo debe ser requerido y tener 25 caracteres o menos.';
    } elseif (!is_numeric($precio) || $precio <= 99.99) {
        $response['message'] = 'El precio debe ser requerido y debe ser mayor a 99.99.';
    } elseif (strlen($detalles) > 250) {
        $response['message'] = 'Los detalles deben tener 250 caracteres o menos.';
    } elseif (!is_numeric($unidades) || $unidades < 0) {
        $response['message'] = 'Las unidades deben ser requeridas y el número registrado debe ser mayor o igual a 0.';
    } else {
        // Verificar si ya existe un producto con el mismo nombre
        $sql = "SELECT * FROM productos WHERE nombre = '$nombre' AND eliminado = 0";
        $result = $conexion->query($sql);

        if ($result->num_rows == 0) {
            $conexion->set_charset("utf8");
            $sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen, eliminado) VALUES ('$nombre', '$marca', '$modelo', $precio, '$detalles', $unidades, '$imagen', 0)";

            if ($conexion->query($sql)) {
                $response['status'] = 'success';
                $response['message'] = 'Producto agregado';
            } else {
                $response['message'] = "ERROR: No se ejecutó la consulta SQL. " . mysqli_error($conexion);
            }
        }

        $result->free();
    }
    
    // Cerrar la conexión a la base de datos
    $conexion->close();
}

// Convertir el arreglo de respuesta a JSON
echo json_encode($response, JSON_PRETTY_PRINT);
?>
