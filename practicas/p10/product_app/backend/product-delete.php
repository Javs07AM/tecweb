<?php
    use BACKEND\API\Delete\Eliminar as Eliminar;
    require_once __DIR__.'/API/Delete/Eliminar.php';

    $productos = new Eliminar('marketzone');
    $productos->delete( $_POST['id'] );
    echo $productos->getResponse();
?>