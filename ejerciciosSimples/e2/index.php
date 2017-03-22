<?php 
    date_default_timezone_set("America/Buenos_Aires");
    $fecha = date("d/m/Y   H:i:s");
    echo $fecha . "<br>";

    $mes = date("m");
    $dia = date("d");
    if($mes == "12" && $dia > "21")
    	echo "es verano";
    else if($mes <= "01" && $dia > "20" || $mes <= "03" && $dia <= "20")
    	echo "es verano";
    else if($mes >= "03" && $dia > "20" || $mes <= "06" && $dia <= "20")
    	echo "es otoño";
    else if($mes >= "06" && $dia > "20" || $mes <= "09" && $dia <= "20")
    	echo "es invierno";
    else
    	echo "es primavera";
?>