<?php 
include "empleado.php";

if(isset($_POST)){
    $empleado = new Empleado($_POST['nombre'], $_POST['apellido'], $_POST['dni'], $_POST['genero'], $_POST['legajo'], $_POST['sueldo']);

    if(!$empleado->guardarEnTxt()){
        ?>
        No se pudo guardar el empleado<br>
        <a href="index.html">Volver</a>
        <?php
    }
    else{
        ?>
        El empleado se guardó correctamente<br>
        <a href="mostrar.php">Ver Datos</a> | 
        <a href="index.html">Volver</a>
        <?php
    }
}
?>