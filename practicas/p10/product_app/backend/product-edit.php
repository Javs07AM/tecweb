<?php
    use BACKEND\API\Update\Actualizar as Actualizar;
    require_once __DIR__.'/API/Update/Actualizar.php';

    $productos = new Actualizar('marketzone');
    $productos->edit( json_decode( json_encode($_POST) ) );
    echo $productos->getResponse();
?>