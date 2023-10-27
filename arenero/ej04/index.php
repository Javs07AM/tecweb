<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        require_once __DIR__. '/Tabla.php';

        $table1 = new Tabla(2,3,'border: 1px solid');
        
        $table1->cargar(0,0,'A');
        $table1->cargar(0,1,'B');
        $table1->cargar(0,2,'C');

        $table1->cargar(1,0,'D');
        $table1->cargar(1,1,'E');
        $table1->cargar(1,2,'F');

        $table1->graficar();
    ?>
</body>
</html>