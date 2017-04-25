<?php
include_once ("clases/AccesoDatos.php");
include_once ("clases/cd.php");

$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

//PREPARO LA CONSULTA CON PARAMETRO 'POSICIONAL'
$consulta = $objetoAccesoDato->RetornarConsulta("SELECT id, titel AS titulo, interpret AS interprete, jahr AS anio "
                                              . "FROM cds WHERE id > ?");	
//ENLAZO EL PARAMETRO
$consulta->bindParam(1, $valor);

//EJECUTO LA SENTENCIA
if($consulta->execute())
{
    //ENLAZO LAS COLUMNAS A PARAMETROS, UTILIZO EL FETCH_BOUND
    $consulta->bindColumn(1, $id, PDO::PARAM_INT, 20);
    $consulta->bindColumn(3, $interprete, PDO::PARAM_STR, 256);
    $consulta->bindColumn(4, $anio, PDO::PARAM_STR, 256);
    $consulta->bindColumn(2, $titulo, PDO::PARAM_STR, 256);

    echo "<table border='1'>";
    echo "<tr><td>Id</td><td>Int&eacute;rprete</td><td>A&ntilde;o</td><td>T&iacute;tulo</td></tr>";

    while($consulta->fetch(PDO::FETCH_BOUND)){
        echo "<tr><td>".$id."</td><td>".$interprete."</td><td>".$anio."</td><td>".$titulo."</td></tr>";		
    }

    echo "</table>";

    //CIERRO LA CONEXION
    $objetoAccesoDato = NULL;
}
else
{ 
    echo "No se ejecut&oacute;";
}	
?>
<h4>C&oacute;digo</h4>
<div class="well well-sm text-info">
$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();<br>
<br>
//PREPARO LA CONSULTA CON PARAMETRO 'POSICIONAL'<br>
$consulta = $objetoAccesoDato->RetornarConsulta("SELECT id, titel AS titulo, interpret AS interprete, jahr AS anio FROM cds WHERE id > ?");
<br>                                              
//ENLAZO EL PARAMETRO<br>
$consulta->bindParam(1, $valor);
<br>
//EJECUTO LA SENTENCIA<br>
<br>
if($consulta->execute())
{<br>
    //ENLAZO LAS COLUMNAS A PARAMETROS, UTILIZO EL FETCH_BOUND<br>
    $consulta->bindColumn(1, $id, PDO::PARAM_INT, 20);<br>
    $consulta->bindColumn(3, $interprete, PDO::PARAM_STR, 256);<br>
    $consulta->bindColumn(4, $anio, PDO::PARAM_STR, 256);<br>
    $consulta->bindColumn(2, $titulo, PDO::PARAM_STR, 256);<br>
<br>


    while($consulta->fetch(PDO::FETCH_BOUND)){<br>
        echo ".$id $interprete $anio $titulo;<br>
    }<br>

<br>
    //CIERRO LA CONEXION<br>
    $objetoAccesoDato = NULL;
</div>
