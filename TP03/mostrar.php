<?php
include "empleado.php";

$file = fopen("empleados.txt", "r");
while (!feof($file)) {
    $registro = trim(fgets($file));
    if($registro != ""){
        $array = explode(" - ", $registro);
        $empleado = new Empleado($array[0], $array[1], $array[2], $array[3], $array[4], $array[5]);
        $empleado->setPathFoto($array[6]);
       echo $empleado->ToString() . "<br>";
       echo "<img width='200px' src='".$empleado->getPathFoto()."'><br>";
    }
}
?>
<br>
<a href="index.html">Volver</a>