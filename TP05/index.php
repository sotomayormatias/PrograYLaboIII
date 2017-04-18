<?php 
    const SERVER = "localhost";
    const USUARIO = "root";
    const CONTRASENIA = "";
    const BASEDATOS = "utn";

    $conexion = mysqli_connect(SERVER, USUARIO, CONTRASENIA, BASEDATOS);
    mysqli_set_charset($conexion, "utf8");

    $query = "SELECT pNumero, pNombre, precio, tamanio FROM productos ORDER BY pNombre";

    $result = mysqli_query($conexion, $query);

    // $filas = mysqli_fetch_object($result);
    // var_dump($filas);
    echo "<h1>RESULTADOS:</h1>";
    while($registro = mysqli_fetch_assoc($result)){
        echo $registro['pNumero'] . " - " . $registro['pNombre'] . " - " .$registro['precio'] . " - " .$registro['tamanio'] . "<br>";
    }
?>