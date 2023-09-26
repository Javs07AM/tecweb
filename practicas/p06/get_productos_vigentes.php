<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
    
<?php
// Verifica si se ha proporcionado el parámetro 'tope' en la URL
if (isset($_GET['tope'])) {
    // Obtén el valor del parámetro 'tope'
    $tope = intval($_GET['tope']); // Convierte a entero

    $mysqli = new mysqli ('localhost', 'root', '19Molletes*eb', 'marketzone');

    // Verifica si hay errores de conexión
    if ($mysqli->connect_errno) {
        die('Error en la conexión a la base de datos: ' . $mysqli->connect_error);
    }

    // Realiza una consulta para obtener los productos con unidades menores o iguales a $tope
    $query = "SELECT * FROM productos WHERE unidades <= $tope AND eliminado=0";
    $result = $mysqli->query($query);

    // Comienza a generar la salida XHTML
    echo '<?xml version="1.0" encoding="UTF-8"?>';
    echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">';
    echo '<html xmlns="http://www.w3.org/1999/xhtml">';
    echo '<head>';
    echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
    echo '<title>Productos</title>';
    echo '</head>';
    echo '<body>';
    echo '<h3>Productos con unidades menores o iguales a ' . $tope . '</h3>';

    // Verifica si se encontraron productos
    if ($result && $result->num_rows > 0) {
        echo '<table class="table">';
		echo '		<thead class="thead-dark">';
			echo		'<tr>';
				echo	'<th scope="col">#</th>';
					echo '<th scope="col">Nombre</th>';
					echo '<th scope="col">Marca</th>';
					echo '<th scope="col">Modelo</th>';
					echo '<th scope="col">Precio</th>';
					echo '<th scope="col">Unidades</th>';
					echo '<th scope="col">Detalles</th>';
					echo '<th scope="col">Imagen</th>';
					echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';

        // Recorre los resultados de la consulta y muestra los productos
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . $row['nombre'] . '</td>';
            echo '<td>' . $row['marca'] . '</td>';
            echo '<td>' . $row['modelo'] . '</td>';
            echo '<td>' . $row['precio'] . '</td>';
            echo '<td>' . $row['unidades'] . '</td>';
            echo '<td>' . $row['detalles'] . '</td>';
            echo '<td><img src="' . $row['imagen'] . '" alt="' . $row['nombre'] . '" /></td>';
            echo '</tr>';
            echo '</tbody>';
        }

        echo '</table>';
        $result->free();
    } else {
        echo '<p>No se encontraron productos con unidades menores o iguales a ' . $tope . '</p>';
    }

    // Cierra la conexión a la base de datos
    $mysqli->close();

    // Cierra el documento XHTML
    echo '</body>';
    echo '</html>';
} else {
    // Si no se proporciona el parámetro 'tope', muestra un mensaje de error
    echo 'Parámetro "tope" no proporcionado.';
}
?>
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Producto</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	</head>
	<body>

    </body>
</html>