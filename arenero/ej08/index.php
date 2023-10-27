<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operacion</title>
</head>
<body>
    <?php
    require_once __DIR__ . '/Operacion.php';
   
    $sum1 = new Suma;// Se inicaliza valor1 y valor2 con 0
    $sum1->setValor1(10);//Se usa medoto de superclase
    $sum1->setValor2(5);//Se usa medoto de superclase
    $sum1->operar();//Se usa medoto propio
    echo '10 + 5 = ' . $sum1->getResultado();//Se usa medoto de superclase


    $rest1 = new Resta;// Se inicaliza valor1 y valor2 con 0
    $rest1->setValor1(10);//Se usa medoto de superclase
    $rest1->setValor2(5);//Se usa medoto de superclase
    $rest1->operar();//Se usa medoto propio
    echo '10 - 5 = ' . $rest1->getResultado();//Se usa medoto de superclase

    ?>
</body>
</html>