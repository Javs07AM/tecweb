<?php
    use BACKEND\API\Productos;
    require_once __DIR__.'/API/Productos.php';

    $productos = new Productos('prime');
    $productos->edit( json_decode( json_encode($_POST) ) );
    echo $productos->getResponse();
?>