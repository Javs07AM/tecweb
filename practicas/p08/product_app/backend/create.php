<?php
    include_once __DIR__.'/database.php';

    // SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
    $producto = file_get_contents('php://input');
    if(!empty($producto)) {
        // SE TRANSFORMA EL STRING DEL JASON A OBJETO
        $jsonOBJ = json_decode($producto);

        $nombre = $jsonOBJ->nombre;
        $marca = $jsonOBJ->marca;
        $modelo = $jsonOBJ->modelo;
        $precio = $jsonOBJ->precio;
        $detalles = $jsonOBJ->detalles;
        $unidades = $jsonOBJ->unidades;
        $imagen = $jsonOBJ->imagen;

        if ( $result = $conexion->query("SELECT * FROM productos WHERE nombre = '{$nombre}' and eliminado = 0") ) {
            if($result->num_rows === 0){
                echo "no toy. Puedo ingresar a la BD\n";
                $sql = "INSERT INTO productos VALUES (null, '{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}', 0)";

                if ( $conexion->query($sql)) {
                    echo "Nuevo registro creado rey\n";
                } else {
                    echo "Error al insertar en la tabla productos: \n" . $link->error;
                }
            }
            else{
                echo "si toy. NO puedo ingresar a la BD :( \n";
            }
            $result->free();

		}

        
        $conexion->close();
        /**
         * SUSTITUYE LA SIGUIENTE LÍNEA POR EL CÓDIGO QUE REALICE
         * LA INSERCIÓN A LA BASE DE DATOS. COMO RESPUESTA REGRESA
         * UN MENSAJE DE ÉXITO O DE ERROR, SEGÚN SEA EL CASO.
         */
        echo '[SERVIDOR] Nombre: '.$jsonOBJ->nombre;
    }
    /*todos los echo los manda al
                console.log(client.responseText);
    del codufo app.js
     */
?>