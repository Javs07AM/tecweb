<?php
use BACKEND\API\Productos;
require_once __DIR__.'/API/Productos.php';

    $productos = new Productos('marketzone');
    $productos->searchname( $_POST['nombre'] );
    echo $productos->getResponse();

?>
