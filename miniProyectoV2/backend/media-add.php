<?php
    use BACKEND\API\Medios;
    require_once __DIR__.'/API/Medios.php';

    $medios = new Medios('prime');
    $medios->add(json_decode(json_encode($_POST)));
    echo $medios->getResponse();
?>
