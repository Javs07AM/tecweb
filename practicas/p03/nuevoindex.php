<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Práctica 3</title>
</head>
<body>
    <br><h2>Ejercicio 6</h2>
    <p> Dar y comprobar el valor booleano de las variables $a, $b, $c, $d, $e y $f y muéstralas 
usando la función var_dump(<datos>). 
Después investiga una función de PHP que permita transformar el valor booleano de $c y $e 
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

echo '<h1>Representación con echo de $c y $e usando var_export()</h1>';
echo '<li>$c: ' . var_export($c, true) . '</li>';
echo '<li>$e: ' . var_export($e, true) . '</li>';


?>


<h2>Ejercicio 7</h2>
    <p>Lee y muestra los valores de las variables del ejercicio anterior, pero ahora con la ayuda de 
la matriz $GLOBALS o del modificador global de PHP</p>
<p>$a = "7 personas"; |  $b = (integer) $a;  |  $a = "9E3";  |   $c = (double) $a;
</p>
<?php
$a = "7 personas";
$b = (integer) $a;
$a = "9E3";
$c = (double) $a;

?>


</body>
</html>
