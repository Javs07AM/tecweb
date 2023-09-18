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
$parqueVehicular = array(
    'ABC1234' => array(
        'Auto' => array(
            'Marca' => 'Nissan',
            'Modelo' => '2023',
            'Tipo' => 'sedan'
        ),
        'Propietario' => array(
            'Nombre' => 'Juan Pérez',
            'Ciudad' => 'Ciudad de México',
            'Dirección' => 'Calle 123, Colonia Reforma'
        )
    ),
    'XYZ4567' => array(
        'Auto' => array(
            'Marca' => 'Ford',
            'Modelo' => '2022',
            'Tipo' => 'hatchback'
        ),
        'Propietario' => array(
            'Nombre' => 'María Gómez',
            'Ciudad' => 'Guadalajara',
            'Dirección' => 'Avenida 456, Colonia Centro'
        )
    ),
    'LMN7890' => array(
        'Auto' => array(
            'Marca' => 'Toyota',
            'Modelo' => '2021',
            'Tipo' => 'camioneta'
        ),
        'Propietario' => array(
            'Nombre' => 'Carlos López',
            'Ciudad' => 'Monterrey',
            'Dirección' => 'Calle 789, Colonia Industrial'
        )
    ),
    'DEF4567' => array(
        'Auto' => array(
            'Marca' => 'Chevrolet',
            'Modelo' => '2020',
            'Tipo' => 'sedan'
        ),
        'Propietario' => array(
            'Nombre' => 'Ana Rodríguez',
            'Ciudad' => 'Tijuana',
            'Dirección' => 'Avenida 4567, Colonia Playas'
        )
    ),
    'JKL0123' => array(
        'Auto' => array(
            'Marca' => 'Honda',
            'Modelo' => '2019',
            'Tipo' => 'hatchback'
        ),
        'Propietario' => array(
            'Nombre' => 'Roberto Sánchez',
            'Ciudad' => 'Puebla',
            'Dirección' => 'Calle 1012, Colonia La Paz'
        )
    ),
    'QWE7890' => array(
        'Auto' => array(
            'Marca' => 'Volkswagen',
            'Modelo' => '2022',
            'Tipo' => 'sedan'
        ),
        'Propietario' => array(
            'Nombre' => 'Laura Martínez',
            'Ciudad' => 'Mérida',
            'Dirección' => 'Avenida 789, Colonia Centro'
        )
    ),
    'ZXC4567' => array(
        'Auto' => array(
            'Marca' => 'Hyundai',
            'Modelo' => '2023',
            'Tipo' => 'hatchback'
        ),
        'Propietario' => array(
            'Nombre' => 'Pedro Gutiérrez',
            'Ciudad' => 'Cancún',
            'Dirección' => 'Calle 456, Colonia Zona Hotelera'
        )
    ),
    'ASD1234' => array(
        'Auto' => array(
            'Marca' => 'Kia',
            'Modelo' => '2021',
            'Tipo' => 'camioneta'
        ),
        'Propietario' => array(
            'Nombre' => 'Isabel López',
            'Ciudad' => 'Acapulco',
            'Dirección' => 'Avenida 123, Colonia Costera'
        )
    ),
    'RTY7890' => array(
        'Auto' => array(
            'Marca' => 'Mazda',
            'Modelo' => '2020',
            'Tipo' => 'sedan'
        ),
        'Propietario' => array(
            'Nombre' => 'Eduardo Soto',
            'Ciudad' => 'Veracruz',
            'Dirección' => 'Calle 7890, Colonia Centro'
        )
    ),
    'UIO4567' => array(
        'Auto' => array(
            'Marca' => 'Subaru',
            'Modelo' => '2019',
            'Tipo' => 'hatchback'
        ),
        'Propietario' => array(
            'Nombre' => 'Luisa Mendoza',
            'Ciudad' => 'Guanajuato',
            'Dirección' => 'Calle 4567, Colonia Cervantes'
        )
     ),
    'JAM1598' => array(
        'Auto' => array(
            'Marca' => 'Omoda',
            'Modelo' => '2022',
            'Tipo' => 'camioneta'
        ),
        'Propietario' => array(
            'Nombre' => 'Romina Jimenez',
            'Ciudad' => 'Oaxaca',
            'Dirección' => 'Avenida San Pancho , Colonia Centro'
        )
    ),
    'KCD0793' => array(
        'Auto' => array(
            'Marca' => 'Chirey',
            'Modelo' => '2023',
            'Tipo' => 'hatchback'
        ),
        'Propietario' => array(
            'Nombre' => 'Camila Cabello',
            'Ciudad' => 'Mexicali',
            'Dirección' => 'Rio Coacaxtla, Colonia Ríos de Mexico'
        )
    ),
    'RSM1464' => array(
        'Auto' => array(
            'Marca' => 'Ford',
            'Modelo' => '1980',
            'Tipo' => 'sedan'
        ),
        'Propietario' => array(
            'Nombre' => 'Jared Borguetti',
            'Ciudad' => 'Cuidad de México',
            'Dirección' => 'Avenida Churubusco, Colonia Nice'
        )
    ),
    'DTP1694' => array(
        'Auto' => array(
            'Marca' => 'Pegout',
            'Modelo' => '2017',
            'Tipo' => 'sedan'
        ),
        'Propietario' => array(
            'Nombre' => 'Patricia Dominguez',
            'Ciudad' => 'Sonora',
            'Dirección' => 'Calle Palafox, Colonia el Cerrito'
        )
    ),
    'VAH4856' => array(
        'Auto' => array(
            'Marca' => 'Lamborghini ',
            'Modelo' => '2018',
            'Tipo' => 'sedan'
        ),
        'Propietario' => array(
            'Nombre' => 'Papritzio Genova',
            'Ciudad' => 'Tabasco',
            'Dirección' => 'Calle Trinchera, Colonia Laugh Tale'
        )
    )
);

echo "<pre>"; // Iniciar la etiqueta pre para formatear la salida

print_r($parqueVehicular);

echo "</pre>"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['matricula'])) {
        $matricula = strtoupper($_POST['matricula']); // Convertir la matrícula a mayúsculas

        if (array_key_exists($matricula, $parqueVehicular)) {
            // Se encontró la matrícula, mostrar información del auto
            $auto = $parqueVehicular[$matricula]['Auto'];
            $propietario = $parqueVehicular[$matricula]['Propietario'];

            echo "<h2>Información del Auto con Matrícula $matricula</h2>";
            echo "Marca: " . $auto['Marca'] . "<br>";
            echo "Modelo: " . $auto['Modelo'] . "<br>";
            echo "Tipo: " . $auto['Tipo'] . "<br>";
            echo "Propietario: " . $propietario['Nombre'] . "<br>";
            echo "Ciudad: " . $propietario['Ciudad'] . "<br>";
            echo "Dirección: " . $propietario['Dirección'] . "<br>";
        } else {
            // Matrícula no encontrada
            echo "Matrícula $matricula no encontrada en el registro.";
        }
    } elseif (isset($_POST['consulta_todos'])) {
        // Mostrar información de todos los autos registrados
        echo "<h2>Información de Todos los Autos Registrados</h2>";

        foreach ($parqueVehicular as $matricula => $datos) {
            $auto = $datos['Auto'];
            $propietario = $datos['Propietario'];

            echo "<h3>Matrícula: $matricula</h3>";
            echo "Marca: " . $auto['Marca'] . "<br>";
            echo "Modelo: " . $auto['Modelo'] . "<br>";
            echo "Tipo: " . $auto['Tipo'] . "<br>";
            echo "Propietario: " . $propietario['Nombre'] . "<br>";
            echo "Ciudad: " . $propietario['Ciudad'] . "<br>";
            echo "Dirección: " . $propietario['Dirección'] . "<br>";
            echo "<hr>";
        }
    }
}
?>
</body>
</html>