<?php
    use BACKEND\API\Read\Leer as Leer;
    require_once __DIR__.'/API/Read/Leer.php';

    $productos = new Leer('marketzone');
    $productos->list();
    echo $productos->getResponse();
?>