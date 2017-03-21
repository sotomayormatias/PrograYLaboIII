<?php 
    //Se define a inicializa el array
    //$miArray = array(rand(0, 10), rand(0, 10), rand(0, 10), rand(0, 10), rand(0, 10));
    
    //Se define el array y se le cargan valores indexandolo
    $miArray = array();
    // for($i = 0; $i < 5; $i++)
    // {
    //     $miArray[$i] = rand(0, 10);
    // }

    // Se carga el array con el meodo push
    for($i = 0; $i < 5; $i++)
    {
        array_push($miArray, rand(0, 10));
    }
    
    //var_dump($miArray);
    $acumulador = 0;

    foreach ($miArray as $value) {
        $acumulador += $value;
    }

    $resultado = $acumulador / count($miArray);

    if($resultado < 6)
        echo "El promedio es menor a 6";
    else if($resultado == 6)
        echo "El promedio es igual a 6";
    else
        echo "El promedio es mayor a 6";
?>