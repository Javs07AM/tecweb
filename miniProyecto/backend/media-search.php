<?php
    use BACKEND\API\Medios;
    require_once __DIR__.'/API/Medios.php';

    $medios = new Medios('prime');  // Cambiado de 'marketzone' a 'prime'
    $medios->search($_GET['search']);
    echo $medios->getResponse();
?>
