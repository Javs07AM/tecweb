<?php
include_once __DIR__.'/database.php';

// SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
$producto = file_get_contents('php://input');
$data = array(
    'status'  => 'error',
    'message' => 'No se pudo editar el producto'
);

if (!empty($producto)) {
    // SE TRANSFORMA EL JSON STRING A OBJETO
    $jsonOBJ = json_decode($producto);

    // SE ASUME QUE LOS DATOS YA FUERON VALIDADOS ANTES DE ENVIARSE

    // Verificar si el producto existe antes de actualizarlo
    $sql = "SELECT * FROM productos WHERE id = {$jsonOBJ->id} AND eliminado = 0";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        $conexion->set_charset("utf8");

        // Realiza la actualización del producto en la base de datos
        $sql = "UPDATE productos SET 
            nombre = '{$jsonOBJ->nombre}',
            marca = '{$jsonOBJ->marca}',
            modelo = '{$jsonOBJ->modelo}',
            precio = {$jsonOBJ->precio},
            detalles = '{$jsonOBJ->detalles}',
            unidades = {$jsonOBJ->unidades},
            imagen = '{$jsonOBJ->imagen}'
            WHERE id = {$jsonOBJ->id}";
        
        if ($conexion->query($sql)) {
            $data['status'] =  "success";
            $data['message'] =  "Producto actualizado";
        } else {
            $data['message'] = "ERROR: No se ejecutó $sql. " . mysqli_error($conexion);
        }
    }

    $result->free();
    // Cierra la conexión
    $conexion->close();
}

// SE HACE LA CONVERSIÓN DE ARRAY A JSON
echo json_encode($data, JSON_PRETTY_PRINT);
?>
