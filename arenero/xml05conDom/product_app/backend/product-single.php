<?php
    use BACKEND\API\Productos;
    require_once __DIR__.'/API/Productos.php';

    $productos = new Productos('prime');
    $productos->single( $_POST['id'] );
    echo $productos->getResponse();
?>