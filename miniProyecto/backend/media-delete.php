<?php
    use BACKEND\API\Medios;
    require_once __DIR__.'/API/Medios.php';

    $medios = new Medios('prime');  // Cambiado de 'marketzone' a 'prime'
    $medios->delete($_POST['id']);
    echo $medios->getResponse();
?>
