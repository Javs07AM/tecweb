<?php
use BACKEND\API\Productos;
include_once __DIR__.'/API/Productos.php';

    $productos = new Productos('marketzone');
    $productos->delete($_POST['id']);
    echo $productos->getResponse();

?>
