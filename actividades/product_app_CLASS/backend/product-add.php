<?php
use BACKEND\API\Productos;
include_once __DIR__.'/API/Productos.php';

    $productos = new Productos('marketzone');
    $productos->add(json_decode(json_encode($_POST)));
    echo $productos->getResponse();

?>
