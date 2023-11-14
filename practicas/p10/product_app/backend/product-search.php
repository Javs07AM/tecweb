<?php
    use BACKEND\API\Read\Leer as Leer;
    require_once __DIR__.'/API/Read/Leer.php';

    $productos = new Leer('marketzone');
    $productos->search( $_GET['search'] );
    echo $productos->getResponse();
?>