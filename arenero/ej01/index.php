<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persona</title>
</head>
<body>
    <?php
    require_once __DIR__.'/Persona.php';

    // Crear una instancia de la clase Persona
    $per1= new Persona;
    // Inicializar el nombre
    $per1->inicializar("Perengano");
    // Llamar a la función mostrar
    $per1->mostrar();

    $per2= new Persona;
    // Inicializar el nombre
    $per2->inicializar("Fulano");
    // Llamar a la función mostrar
    $per2->mostrar();

    $per3= new Persona;
    // Inicializar el nombre
    $per3->inicializar("Sutano");
    // Llamar a la función mostrar
    $per3->mostrar();

    ?>
</body>
</html>