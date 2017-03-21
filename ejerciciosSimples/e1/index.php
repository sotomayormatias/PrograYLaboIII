<?php 
//Primer ejercicio
$nombre = "Matías";
echo $nombre."<br>";
echo "Hola " . $nombre . "<br><br>";

$acumulador = 0;
$contador = 1;

while($acumulador <= 1000)
{
    $acumulador += $contador;
    echo $contador . " - ";
    $contador++;
}

echo "<br><br>Resultado total: " . $acumulador;
/*
Bloque comentado
*/
?>