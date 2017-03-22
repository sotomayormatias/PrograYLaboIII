<?php 
	$a = rand(1, 15);
	$b = rand(1, 15);
	$c = rand(1, 15);

	$array = array($a, $b, $c);

	var_dump($array);
	echo "<br>";
	array_multisort($array);

	if($array[0] == $array[1] || $array[1] == $array[2])
		echo "No hay valor del medio";
	else
	 	echo "El valor medio es " . $array[1];
?>