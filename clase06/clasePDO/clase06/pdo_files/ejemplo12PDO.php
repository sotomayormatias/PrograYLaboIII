<?php
include_once ("clases/AccesoDatos.php");
include_once ("clases/cd.php");

$unCd =new cd();
$unCd->titulo = "Nuevo Titulo";
$unCd->anio = date("Y");
$unCd->interprete = "Nuevo cantante";

$unCd->InsertarElCdParametros();

echo "<br>";
print_r($unCd->MostrarDatos());

?>
<h4>C&oacute;digo</h4>
<div class="well well-sm text-info">
    
$unCd =new cd();<br>
$unCd->titulo = "Nuevo Titulo";<br>
$unCd->anio = date("Y");<br>
$unCd->interprete = "Nuevo cantante";<br><br>
print_r($unCd->MostrarDatos());<br>

    public function InsertarElCdParametros()
    {<br>
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();<br><br>
        
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO cds (titel, interpret, jahr)"
                                                    . "VALUES(:titulo, :cantante, :anio)");<br><br>
        
        $consulta->bindValue(':titulo', $this->titulo, PDO::PARAM_INT);<br>
        $consulta->bindValue(':anio', $this->anio, PDO::PARAM_INT);<br>
        $consulta->bindValue(':cantante', $this->interprete, PDO::PARAM_STR);<br>

        $consulta->execute(); <br>  

    }
<br>

</div>