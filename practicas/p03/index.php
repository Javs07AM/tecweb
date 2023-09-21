<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Práctica 3</title>
</head>
<body>
    <h2>Ejercicio 1</h2>
    <p>Determina cuál de las siguientes variables son válidas y explica por qué:</p>
    <p>$_myvar,  $_7var,  myvar,  $myvar,  $var7,  $_element1, $house*5</p>
    <?php
        //AQUI VA MI CÓDIGO PHP
        $_myvar;
        $_7var;
        //myvar;       // Inválida
        $myvar;
        $var7;
        $_element1;
        //$house*5;     // Invalida

        echo '<ul>';
        echo '<li>$_myvar es válida porque inicia con guión bajo.</li>';
        echo '<li>$_7var es válida porque inicia con guión bajo.</li>';
        echo '<li>$myvar es válida porque inicia con una letra.</li>';
        echo '<li>$var7 es válida porque inicia con una letra.</li>';
        echo '<li>$_element1 es válida porque inicia con guión bajo.</li>';
        echo '</ul>';
    ?>

<h2>Ejercicio 2</h2>
    <p>Proporcionar los valores de &#36;a, &#36;b, &#36;c como sigue:</p>
    <p>&#36;a = “ManejadorSQL”; &#36;b = 'MySQL'; &#36;c = &amp;&#36;a</p>
    <?php
        $a = "ManejadorSQL";
        $b = 'MySQL';
        $c = &$a;

        echo '<ul>';
        echo '<li>Este es el valor de la variable $a: </li>' .$a;
        echo '<li>Este es el valor de la variable $b: </li>' .$b;
        echo '<li>Este es el valor de la variable $c: </li>' .$c;
        echo '</ul>';

        echo 'Agrega al código actual las siguientes asignaciones:<br>';

        echo ' $a = "PHP server";, $b = &$a; <br>';
        $a = "PHP server";
        $b = &$a;

        echo '<ul>';
        echo '<li>Este es el valor de la variable $a: </li>' .$a;
        echo '<li>Este es el valor de la variable $b: </li>' .$b;
        echo '<li>Este es el valor de la variable $c: </li>' .$c;
        echo '</ul>';

    ?>
   
<h2>Ejercicio 3</h2>
    <p>Muestra el contenido de cada variable inmediatamente después de cada asignación,
verificar la evolución del tipo de estas variables (imprime todos los componentes de los
arreglo):</p>
<p> |  &#36;a = “PHP5”; | &#36;z[] = &#36;a; | &#36;b = “5a version de PHP”; | &#36;c = &#36;b*10; | &#36;a .= &#36;b; | &#36;b *= &#36;c; | &#36;z[0] = “MySQL”; |</p>
<?php
$a = "PHP5";
echo '<li>Este es el valor de la variable $a: </li>' .$a;
$z[] = &$a;
echo '<li>Este es el valor de la variable $z: </li>' .$z[0];
$b = "5a version de PHP";
echo '<li>Este es el valor de la variable $b: </li>' .$b;
$c = (int)$b*10;
echo '<li>Este es el valor de la variable $c: </li>' .$c;
$a .= $b;
echo '<li>Este es el valor de la variable $a: </li>' .$a;
$b *= $c;
echo '<li>Este es el valor de la variable $b: </li>' .$b;
$z[0] = "MySQL";
echo '<li>Este es el valor de la variable $z: </li>' .$z[0];
?>


<h2>Ejercicio 4</h2>
    <p>Lee y muestra los valores de las variables del ejercicio anterior, pero ahora con la ayuda de 
la matriz &#36;GLOBALS o del modificador global de PHP</p>
    <p> |  &#36;a = “PHP5”; | &#36;z[] = &#36;a; | &#36;b = “5a version de PHP”; | &#36;c = &#36;b*10; | &#36;a .= &#36;b; | &#36;b *= &#36;c; | &#36;z[0] = “MySQL”; |</p>
    <?php
// Incluye aquí el código original que proporcionaste

// Acceder a las variables globales utilizando $GLOBALS
echo '<h1>Accediendo a las variables globales usando $GLOBALS</h1>';
echo '<li>Valor de $GLOBALS["a"]: ' . $GLOBALS["a"] . '</li>';
echo '<li>Valor de $GLOBALS["z"][0]: ' . $GLOBALS["z"][0] . '</li>';
echo '<li>Valor de $GLOBALS["b"]: ' . $GLOBALS["b"] . '</li>';
echo '<li>Valor de $GLOBALS["c"]: ' . $GLOBALS["c"] . '</li>';

// Acceder a las variables globales utilizando la palabra clave global
global $a, $z, $b, $c;
echo '<h1>Accediendo a las variables globales usando la palabra clave "global"</h1>';
echo '<li>Valor de $a: ' . $a . '</li>';
echo '<li>Valor de $z[0]: ' . $z[0] . '</li>';
echo '<li>Valor de $b: ' . $b . '</li>';
echo '<li>Valor de $c: ' . $c . '</li>';
?>

<h2>Ejercicio 5</h2>
    <p>Dar el valor de las variables &#36;a, &#36;b, &#36;c al final del siguiente script</p>
<p>&#36;a = "7 personas"; |  &#36;b = (integer) $a;  |  &#36;a = "9E3";  |   &#36;c = (double) $a;
</p>
<?php
$a = "7 personas";
$b = (integer) $a;
$a = "9E3";
$c = (double) $a;

?>

<h2>Ejercicio 6</h2>
    <p> Dar y comprobar el valor booleano de las variables &#36;a, &#36;b, &#36;c, &#36;d, &#36;e y &#36;f y muéstralas 
usando la función var_dump(&lt;datos&gt;). 
Después investiga una función de PHP que permita transformar el valor booleano de &#36;c y &#36;e 
en uno que se pueda mostrar con un echo:
</p>
<?php
$a = "0";
$b = "TRUE";
$c = FALSE;
$d = ($a OR $b);
$e = ($a AND $c);
$f = ($a XOR $b);

echo '<h1>Valores booleanos de las variables y su representación con var_dump()</h1>';
echo '<li>$a: ';
var_dump((bool)$a);
echo '</li>';
echo '<li>$b: ';
var_dump((bool)$b);
echo '</li>';
echo '<li>$c: ';
var_dump($c);
echo '</li>';
echo '<li>$d: ';
var_dump($d);
echo '</li>';
echo '<li>$e: ';
var_dump($e);
echo '</li>';
echo '<li>$f: ';
var_dump($f);
echo '</li>';

?>


<h2>Ejercicio 7</h2>
    <p>Usando la variable predefinida $_SERVER, determina lo siguiente:
a. La versión de Apache y PHP, 
b. El nombre del sistema operativo (servidor),
c. El idioma del navegador (cliente)
</p>
<?php
$apacheVersion = $_SERVER['SERVER_SOFTWARE'];
$phpVersion = phpversion();
echo "Inciso a<br>";
echo "Versión de Apache: $apacheVersion<br>";
echo "Versión de PHP: $phpVersion<br>";

echo "Inciso b<br>";
$serverOS = php_uname('s');

echo "Sistema operativo del servidor: $serverOS<br>";

echo "Inciso c<br>";
$clientLanguage = $_SERVER['HTTP_ACCEPT_LANGUAGE'];

echo "Idioma del navegador del cliente: $clientLanguage<br>";


?>
<p>
    <a href="http://validator.w3.org/check?uri=referer"><img
      src="http://www.w3.org/Icons/valid-xhtml11" alt="XHTML 1.1 válido" height="31" width="88" /></a>
  </p>

</body>
</html>