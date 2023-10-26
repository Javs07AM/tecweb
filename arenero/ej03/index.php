<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cabecera</title>
</head>
<body>
    <?php
    require_once __DIR__.'/Cabecera.php';
    use EJEMPLOS\POO\Cabecera2 as Cabecera;
    // Crear una instancia de la clase Cabecera
    $cab1= new Cabecera(
        'En manada somos mas fuertes', ' center', 'https://buap.mx'
    );
    
    // Llamar a la función graficar
    $cab1->graficar();

    

    ?>
</body>
</html>