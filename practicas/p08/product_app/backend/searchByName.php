<?php
include_once __DIR__.'/database.php';

// Verificar si se recibió el nombre a buscar
if(isset($_POST['nombre'])) {
    $nombre = $conexion->real_escape_string($_POST['nombre']);

    // Realizar la consulta de búsqueda por nombre
    $query = "SELECT * FROM productos WHERE nombre LIKE '%$nombre%'";
    if($result = $conexion->query($query)) {
        $productos = array(); // Crear un array para almacenar los resultados

        if ($result->num_rows > 0) {
            // Utilizar un bucle foreach para agregar los productos al array
            foreach ($result as $row) {
                $productos[] = $row;
            }
        }
        
        // Devolver los resultados en formato JSON
        echo json_encode($productos);
        
        $result->free();
    } else {
        die('Query Error: ' . mysqli_error($conexion));
    }
    $conexion->close();
}
?>
