<?php
    $conexion = @mysqli_connect(
        'localhost',
        'root',
        '19Molletes*eb',
        'marketzone'
    );

    /**
     * NOTA: si la conexión falló $conexion contendrá false
     **/
    if(!$conexion) {
        die('¡Base de datos NO conextada!');
    }
?>