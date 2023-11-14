<?php
    use BACKEND\API\Create\Crear as Crear;
    require_once __DIR__.'/API/Create/Crear.php';

    $productos = new Crear('marketzone');
    $productos->add( json_decode( json_encode($_POST) ) );
    echo $productos->getResponse();
?>