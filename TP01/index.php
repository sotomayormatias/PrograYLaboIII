<?php 
include "fabrica.php";

$empleado1 = new Empleado("Matias", "Sotomayor", "34374176", "Masculino", 123456, 45616);
$empleado2 = new Empleado("Diego", "Maradona", "12354955", "Masculino", 321654, 45616);
$empleado3 = new Empleado("Carlos", "Tevez", "32654960", "Masculino", 987654, 45616);

// echo $empleado1->ToString();

$fabrica = new Fabrica("fabrica SA");

$fabrica->agregarEmpleado($empleado1);
$fabrica->agregarEmpleado($empleado2);
$fabrica->agregarEmpleado($empleado3);

echo $fabrica->ToString();

// $fabrica->eliminarEmpleado($empleado1);

$fabrica->guardarEnTxt();

?>