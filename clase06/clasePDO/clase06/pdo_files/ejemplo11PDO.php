<?php
include_once ("clases/AccesoDatos.php");
include_once ("clases/cd.php");

$unCd = cd::TraerUnCdAnioParamNombreArray("Beauty", 1990);
echo "<br>";
print_r($unCd->MostrarDatos());

?>
<h4>C&oacute;digo</h4>
<div class="well well-sm text-info">
    
$unCd = cd::TraerUnCdAnioParamNombreArray("Beauty", 1990);<br><br>
print_r($unCd->MostrarDatos());<br>

<br><br>
public static function TraerUnCdAnioParamNombreArray($titulo, $anio)
{<br> 
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();<br><br>

    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT titel AS titulo, interpret AS interprete, 
                                                    jahr AS anio FROM cds WHERE titel = :titulo "
                                                    AND jahr= :anio");<br><br>

    $consulta->execute(array(":titulo" => $titulo, ":anio" => $anio));<br><br>

    $cdBuscado = $consulta->fetchObject('cd');<br>

    return $cdBuscado; <br>
}<br>

</div>