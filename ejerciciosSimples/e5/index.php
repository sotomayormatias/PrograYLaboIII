<?php 
	$number = rand(20, 60);
	$decNumero = substr($number, 0, 1);
	$uniNumero = substr($number, 1, 1);
	$decena = "";
	$unidad = "";

	if($decNumero == "2")
		$decena = "veinte";
	elseif ($decNumero == "3")
		$decena = "treinta";
	elseif ($decNumero == "4")
		$decena = "cuarenta";
	elseif ($decNumero == "5")
		$decena = "cincuenta";
	else
		$decena = "sesenta";

	if($uniNumero == "1")
		$unidad = "uno";
	elseif ($uniNumero == "2")
		$unidad = "dos";
	elseif ($uniNumero == "3")
		$unidad = "tres";
	elseif ($uniNumero == "4")
		$unidad = "cuatro";
	elseif ($uniNumero == "5")
		$unidad = "cinco";
	elseif ($uniNumero == "6")
		$unidad = "seis";
	elseif ($uniNumero == "7")
		$unidad = "siete";
	elseif ($uniNumero == "8")
		$unidad = "ocho";
	elseif ($uniNumero == "9")
		$unidad = "nueve";
	else
		$unidad = "";

	if($unidad == "")
		echo $number . ": " . $decena;
	else	
		echo $number . ": " . $decena . " y " . $unidad;
?>