<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
</head>
<body>
    <?php
    require_once __DIR__.'/Menu.php';

    // Crear una instancia de la clase Menu
    $menu1= new Menu;
    // Inicializar los arreglos
    $menu1->cargar_opcion("https://facebook.com","Facebook");
    $menu1->cargar_opcion("https://buap.mx","BUAP");
    $menu1->cargar_opcion("https://instagram.com","Instagram");
    // Llamar a la función mostrar
    $menu1->mostrar();

    ?>
</body>
</html>