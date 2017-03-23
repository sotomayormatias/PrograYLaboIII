<?php 
	$number = rand(20, 60);
	$decNumero = substr($number, 0, 1);
	$uniNumero = substr($number, 1, 1);
	$decenas = array("veinte", "treinta", "cuarenta", "cincuenta", "sesenta");
	$unidades = array("", "uno", "dos", "tres", "cuatro", "cinco", "seis", "siete", "ocho", "nueve");

	$decena = $decenas[$decNumero - 2];
	$unidad = $unidades[$uniNumero];

	if($unidad == "")
		echo $number . ": " . $decena;
	else	
		echo $number . ": " . $decena . " y " . $unidad;
?>