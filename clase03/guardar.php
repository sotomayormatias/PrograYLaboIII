<?php 
/*
Se ingresara el nombre de la persona y el nombre del archivo guardando el dato en el archivo
Al presionar el boton guardar se verificara si el archivo existe
De ya existir el archivo, se copiara y se movera a la carpeta backup cambiandole el nombre por el nombre mas la fecha
Al presionar el boton leer, si el archivo existe, se mostrara el contenido; de no existir el archivo, se informara que no existe
*/

//var_dump($_POST);

if(isset($_POST['leer'])){
    $file = fopen("archivo.txt", "r");
    $valor = fread($file, filesize("archivo.txt"));
    echo $valor;
    fclose($file);
}
elseif(isset($_POST['guardar'])){
    $nombre = $_POST['nombre'];

    $file = fopen("archivo.txt", "w");
    fwrite($file, $nombre . "\r\n");
    fclose($file);
}
?>

<br>
<a href="formulario.html">VOLVER</a>