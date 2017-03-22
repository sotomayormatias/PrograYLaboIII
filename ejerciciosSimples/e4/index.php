<?php 
	$operadores = array("+", "-", "*", "/");

	$op1 = rand(0, 10);
	$op2 = rand(0, 10);

	$operador = $operadores[rand(0, 3)];
	$resultado = 0;

	if($operador == "+")
		$resultado = $op1 + $op2;
	elseif ($operador == "-")
		$resultado = $op1 - $op2;
	elseif ($operador == "*")
		$resultado = $op1 * $op2;
	elseif ($operador == "/" && $op2 != 0)
		$resultado = $op1 / $op2;

	echo $op1 . " " . $operador . " " . $op2 . " = " . $resultado;
?>