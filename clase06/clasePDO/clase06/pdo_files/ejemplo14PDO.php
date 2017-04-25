<?php
include_once ("clases/AccesoDatos.php");
include_once ("clases/cd.php");


cd::EliminarCd(4);

?>
<h4>C&oacute;digo</h4>
<div class="well well-sm text-info">
    
cd::EliminarCd(4);<br>

<br>

public static function EliminarCd($id)
{<br>
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();<br><br>

    $consulta =$objetoAccesoDato->RetornarConsulta("DELETE FROM cds WHERE id = :id");<br><br>

    $consulta->bindValue(':id', $id, PDO::PARAM_INT);<br>

    $consulta->execute(); <br>  

}
<br>

</div>