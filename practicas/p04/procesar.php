<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <link rel="icon" href="../../actividades/01-la_web_estatica/img/logoNexGen.png" type="image/x-icon">
    <title>Práctica 4</title>
</head>
<body>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener valores de $_POST
    $edad = isset($_POST['edad']) ? intval($_POST['edad']) : 0;
    $sexo = isset($_POST['sexo']) ? $_POST['sexo'] : "";

    // Verificar si el sexo es "femenino" y la edad está en el rango de 18 a 35 años
    if ($sexo === "femenino" && $edad >= 18 && $edad <= 35) {
        echo "Bienvenida, usted está en el rango de edad permitido.";
    } else {
        echo "Lo sentimos, no cumple con los criterios de edad y/o sexo permitidos.";
    }
} else {
    echo "Error: Este script debe ser accedido mediante un formulario.";
}
?>
</body>
</html>