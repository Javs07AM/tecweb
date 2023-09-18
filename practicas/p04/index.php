<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
=======
    <link rel="stylesheet" href="estilos.css">
    <link rel="icon" href="../../actividades/01-la_web_estatica/img/logoNexGen.png" type="image/x-icon">
>>>>>>> dev
    <title>Práctica 4</title>
</head>
<body>
    <h2>Ejercicio 1</h2>
    <p>Escribir programa para comprobar si un número es un múltiplo de 5 y 7</p>
    <?php
        if(isset($_GET['numero']))
        {
            $num = $_GET['numero'];
            if ($num%5==0 && $num%7==0)
            {
                echo '<h3>R= El número '.$num.' SÍ es múltiplo de 5 y 7.</h3>';
            }
            else
            {
                echo '<h3>R= El número '.$num.' NO es múltiplo de 5 y 7.</h3>';
            }
        }
    ?>
     
    <h2>Ejemplo de POST</h2>
    <form action="http://localhost/tecwebCarlos/practicas/p04/index.php" method="post">
        Name: <input type="text" name="name"><br>
        E-mail: <input type="text" name="email"><br>
        <input type="submit">
    </form>
    <br>
    <?php
        if(isset($_POST["name"]) && isset($_POST["email"]))
        {
            echo $_POST["name"];
            echo '<br>';
            echo $_POST["email"];
        }
    ?> 

    <h2>Ejercicio 2</h2>
    <p>Crea un programa para la generación repetitiva de 3 números aleatorios hasta obtener una secuencia compuesta por impar,  par , impar </p>
    
<?php
function generarNumeroAleatorio() {
    return rand(1, 1000); 
}

$matriz = []; 
$secuenciaEncontrada = false;
$iteraciones = 0; 

while (!$secuenciaEncontrada) {
    $numero1 = generarNumeroAleatorio();
    $numero2 = generarNumeroAleatorio();
    $numero3 = generarNumeroAleatorio();
    echo "\n";

    // Verifica si la secuencia es impar, par, impar
    if ($numero1 % 2 != 0 && $numero2 % 2 == 0 && $numero3 % 2 != 0) {
        $secuenciaEncontrada = true; // Se encontró la secuencia
        echo "Secuencia encontrada: $numero1 (impar), $numero2 (par), $numero3 (impar)\n";
        echo "\n";
    }

    // Agrega los números a la matriz
    $matriz[] = [$numero1, $numero2, $numero3];
    echo "\n";
    $iteraciones++;
}

// Muestra la matriz
echo "Matriz resultante (Mx3):\n";
foreach ($matriz as $fila) {
    echo implode(", ", $fila) . "\n";
}

// Muestra el número de iteraciones y la cantidad de números obtenidos
echo "Números obtenidos "  . ($iteraciones * 3) . " en $iteraciones\n iteraciones";
?>

<h2>Ejercicio 3</h2>
    <p>Utiliza un ciclo while para encontrar el primer número entero obtenido aleatoriamente, 
pero que además sea múltiplo de un número dado.</p>
<h2>Ciclo while</h2>
<?php
$numeroDado = isset($_GET['number']) ; // Obtener el número dado de la solicitud GET
$numeroDado = $_GET['number'];
$encontrado = false;
$primerMultiplo = null;

while (!$encontrado) {
    $numeroAleatorio = rand(1, 1000); // Generar un número aleatorio entre 1 y 100

    if ($numeroAleatorio % $numeroDado == 0) {
        $encontrado = true;
        $primerMultiplo = $numeroAleatorio;
    }
}

echo "El primer número múltiplo de $numeroDado obtenido aleatoriamente es: $primerMultiplo";
?>

<h2>Ciclo do-while</h2>

<?php
$numeroDado1 = isset($_GET['number1']);
$numeroDado1 = $_GET['number1'];
$encontrado1= false;
$primerMultiplo1 = null;

do {
    $numeroAleatorio1 = rand(1, 1000); // Generar un número aleatorio entre 1 y 100

    if ($numeroAleatorio1 % $numeroDado1 == 0) {
        $encontrado1 = true;
        $primerMultiplo1 = $numeroAleatorio1;
    }
} while (!$encontrado1);

echo "El primer número múltiplo de $numeroDado1 obtenido aleatoriamente es: $primerMultiplo1";
?>

<h2>Ejercicio 4</h2>
<p>Crear un arreglo cuyos índices van de 97 a 122 y cuyos valores son las letras de la ‘a’ 
a la ‘z’. Usa la función chr(n) que devuelve el caracter cuyo código ASCII es n para poner 
el valor en cada índice.</p>

<?php
// Crear el arreglo con un ciclo for
$arregloLetras = array();
for ($i = 97; $i <= 122; $i++) {
    $arregloLetras[$i] = chr($i);
}

// Crear una tabla XHTML con un ciclo foreach
echo "<table border='1'>";
echo "<tr><th>Índice</th><th>Valor</th></tr>";

foreach ($arregloLetras as $indice => $valor) {
    echo "<tr>";
    echo "<td>$indice</td>";
    echo "<td>$valor</td>";
    echo "</tr>";
}

echo "</table>";
?>

<<<<<<< HEAD
=======
<h2>Ejercicio 5</h2>

<form method="post" action="procesar.php">
        <label for="edad">Edad:</label>
        <input type="text" name="edad" id="edad"><br><br>
        
        <label for="sexo">Sexo:</label>
        <input type="radio" name="sexo" value="masculino" id="sexo-masculino">Masculino
        <input type="radio" name="sexo" value="femenino" id="sexo-femenino">Femenino<br><br>
        
        <input type="submit" value="Enviar">
    </form>

    <h2>Ejercicio 6</h2>
<h1>Consulta de Parque Vehicular</h1>
    
    <!-- Consulta por matrícula -->
    <form method="post" action="consultar.php">
        <label for="matricula">Consultar por Matrícula:</label>
        <input type="text" name="matricula" id="matricula">
        <input type="submit" value="Consultar">
    </form>

    <br>

    <!-- Consulta de todos los autos registrados -->
    <form method="post" action="consultar.php">
        <input type="hidden" name="consulta_todos" value="true">
        <input type="submit" value="Mostrar Todos los Autos Registrados">
    </form>



>>>>>>> dev

</body>
</html> 