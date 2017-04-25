<?php
include_once ("clases/AccesoDatos.php");
include_once ("clases/cd.php");

$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

//PREPARO LA CONSULTA CON PARAMETRO 'NOMBRADO'
$consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM cds WHERE id = :idCd");

//ENLAZO EL PARAMETRO
$consulta->bindValue(":idCd", $valor, PDO::PARAM_INT);//SE ENLAZA AL VALOR (LITERAL, NUNCA CAMBIA)
//$consulta->bindParam(":idCd", $valor, PDO::PARAM_INT);//SE ENLAZA AL PARAMETRO (VALOR DEL PARAMETRO)

//EJECUTO LA SENTENCIA
$consulta->execute();

$fila = $consulta->fetchall();//FETCHALL -> RETORNA UNA ARRAY IDEXADO Y ASOCIATIVO

echo "Valor = " . $valor . "<br/>";
var_dump($fila)."<br/>";

//CAMBIO EL VALOR DEL PARAMETRO
$valor = 4;
echo "<br/><br/>Valor = " . $valor . "<br/>";

//EJECUTO LA SENTENCIA
$consulta->execute();

$fila = $consulta->fetchall(); 
var_dump($fila)."<br/><br/>";

//CIERRO LA CONEXION
$objetoAccesoDato = NULL;

?>
<h4>C&oacute;digo</h4>
<div class="well well-sm text-info">
$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();<br>
<br>
//PREPARO LA CONSULTA CON PARAMETRO 'POSICIONAL'<br>
$consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM cds WHERE id = :idCd");
<br>                                              
//ENLAZO EL PARAMETRO<br>
$consulta->bindValue(":idCd", $valor, PDO::PARAM_INT);
<br>
//EJECUTO LA SENTENCIA<br>
<br>
$consulta->execute();
<br>
echo "Valor = " . $valor;<br/>
var_dump($fila);<br/>

//CAMBIO EL VALOR DEL PARAMETRO
<br/>$valor = 4;<br/>
echo "Valor = " . $valor;<br/>

//EJECUTO LA SENTENCIA<br/>
$consulta->execute();<br/>

$fila = $consulta->fetchall();<br/> 
var_dump($fila);<br/>
<br>

//CIERRO LA CONEXION<br>
$objetoAccesoDato = NULL;
</div>
