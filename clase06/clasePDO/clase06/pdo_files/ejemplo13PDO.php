<?php
include_once ("clases/AccesoDatos.php");
include_once ("clases/cd.php");


cd::ModificarCd(1, "Titulo modificado", 1991, "Cantante modificado");

?>
<h4>C&oacute;digo</h4>
<div class="well well-sm text-info">
    
cd::ModificarCd(1, "Titulo modificado", 1991, "Cantante modificado");<br>

<br>

public static function ModificarCd($id, $titulo, $anio, $cantante)
{<br>
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();<br><br>

    $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE cds SET titel = :titulo, interpret = :cantante, 
                                                    jahr = :anio WHERE id = :id");<br><br>

    $consulta->bindValue(':id', $id, PDO::PARAM_INT);<br>
    $consulta->bindValue(':titulo', $titulo, PDO::PARAM_INT);<br>
    $consulta->bindValue(':anio', $anio, PDO::PARAM_INT);<br>
    $consulta->bindValue(':cantante', $cantante, PDO::PARAM_STR);<br>

    $consulta->execute(); <br>  

}
<br>

</div>