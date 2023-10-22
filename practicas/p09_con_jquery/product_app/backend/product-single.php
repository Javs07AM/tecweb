<?php
// Incluye el archivo de conexión a la base de datos
include 'database.php';

// Verifica si se recibió un ID válido
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    
    // Realiza una consulta SQL para obtener los datos del producto con el ID proporcionado
    $query = "SELECT * FROM productos WHERE id = $id";
    $result = mysqli_query($conexion, $query);
    
    // Verifica si se encontró un producto con el ID proporcionado
    if (mysqli_num_rows($result) > 0) {
        // Obtiene los datos del producto como un arreglo asociativo
        $producto = mysqli_fetch_assoc($result);

        // Cierra la conexión a la base de datos
        mysqli_close($conexion);

        // Responde con los datos del producto en formato JSON de manera ordenada
        echo json_encode($producto, JSON_PRETTY_PRINT);
    } else {
        // Producto no encontrado, responde con un mensaje de error
        echo json_encode(array("status" => "error", "message" => "Producto no encontrado"), JSON_PRETTY_PRINT);
    }
} else {
    // ID no válido, responde con un mensaje de error
    echo json_encode(array("status" => "error", "message" => "ID de producto no válido"), JSON_PRETTY_PRINT);
}
?>
