<?php
    include_once __DIR__.'/database.php';

    // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
    $data = array();
    // SE VERIFICA HABER RECIBIDO EL ID
    if( isset($_POST['id']) ) {
        $coincidencia = $_POST['id'];
        // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
        if ( $result = $conexion->query("SELECT * FROM productos WHERE id = '{$coincidencia}' OR nombre LIKE '%{$coincidencia}%' or 
        marca like '%{$coincidencia}%' or detalles like '%{$coincidencia}%'") ) {
            // SE OBTIENEN solo un resltado
			//$row = $result->fetch_array(MYSQLI_ASSOC);
            
            /*
            if(!is_null($row)) {
                // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                foreach($row as $key => $value) {
                    $data[$key] = utf8_encode($value);
                }
            }
            */
            
            /*en row se le pasan las filas, o registros, luego con el foreach va iterando de forma columna y valor y se le pasa al
            arreglo registro. data tengdra en cada casilla un nuevo registro pasado por utf8 */
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $registro = array();
                // Iteramos a través de las columnas del registro y aplicamos utf8_encode
                foreach($row as $key => $value) {
                    $registro[$key] = utf8_encode($value);
                }
                // Agregamos el registro al arreglo de resultados
                if(!is_null($registro)) {
                    $data[] = $registro;
                }
            }

			$result->free();
		} else {
            die('Query Error: '.mysqli_error($conexion));
        }
		$conexion->close();
    } 
    echo json_encode($data, JSON_PRETTY_PRINT);

?>