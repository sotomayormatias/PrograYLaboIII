<?php
include_once ("conexion.php");
class Conteiner
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	private $numero;
 	private $descripcion;
  	private $pais;
  	private $foto;
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--GETTERS Y SETTERS
	public function GetNumero()
	{
		return $this->numero;
	}
	public function GetDescripcion()
	{
		return $this->descripcion;
	}
	public function GetPais()
	{
		return $this->pais;
	}
	public function GetFoto()
	{
		return $this->foto;
	}

	public function SetNumero($valor)
	{
		$this->numero = $valor;
	}
	public function SetDescripcion($valor)
	{
		$this->descripcion = $valor;
	}
	public function SetPais($valor)
	{
		$this->pais = $valor;
	}
	public function SetFoto($valor)
	{
		$this->foto = $valor;
	}

//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
	public function __construct($numero=NULL, $descripcion=NULL, $pais=NULL, $foto=NULL)
	{
		if($numero != NULL && $descripcion != NULL && $pais != NULL && $foto != NULL){
			$this->numero = $numero;
			$this->descripcion = $descripcion;
			$this->pais = $pais;
			$this->foto = $foto;
		}
	}

//--------------------------------------------------------------------------------//
//--TOSTRING	
  	public function ToString()
	{
	  	return $this->numero." - ".$this->descripcion." - ".$this->pais." - ".$this->foto."\r\n";
	}
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--METODOS
	public static function GuardarEnBD($obj)
	{
		$resultado = FALSE;
		
		$numero = $obj->GetNumero();
		$descripcion = $obj->GetDescripcion();
		$pais = $obj->GetPais();
		$foto = $obj->GetFoto();

		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("INSERT INTO conteiner(numero, descripcion, pais, foto) VALUES(".$numero.", '".$descripcion."', '".$pais."', '".$foto."')");
		$cant = $consulta->execute();
		
		if($cant > 0)
		{
			$resultado = TRUE;			
		}
		
		return $resultado;
	}

	public static function TraerTodosLosConteinerDeBD()
	{
		$ListaDeConteinerLeidos = array();

		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("SELECT numero, descripcion, pais, foto FROM conteiner");
		$consulta->execute();
		while($fila = $consulta->fetch(PDO::FETCH_ASSOC))
		{
			$ListaDeConteinerLeidos[] = new Conteiner($fila['numero'], $fila['descripcion'], $fila['pais'], $fila['foto']);
		}
		
		return $ListaDeConteinerLeidos;
	}

	public static function TraerConteinerDeBDPorNumero($numero)
	{
		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("SELECT numero, descripcion, pais, foto FROM conteiner WHERE numero = ".$numero);
		$consulta->execute();
		$fila = $consulta->fetch(PDO::FETCH_ASSOC);

		$conteiner = new Conteiner($fila['numero'], $fila['descripcion'], $fila['pais'], $fila['foto']);
		
		return $conteiner;
	}

	public static function TraerConteinerDeBDPorPais($pais)
	{
		$ListaDeConteinerLeidos = array();

		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("SELECT numero, descripcion, pais, foto FROM conteiner WHERE pais = '".$pais."'");
		$consulta->execute();
		while($fila = $consulta->fetch(PDO::FETCH_ASSOC))
		{
			$ListaDeConteinerLeidos[] = new Conteiner($fila['numero'], $fila['descripcion'], $fila['pais'], $fila['foto']);
		}
		
		return $ListaDeConteinerLeidos;
	}

	public static function EliminarDeBD($numero)
	{
		if($numero === NULL)
			return FALSE;
			
		$resultado = TRUE;
		
		$conteiner = Conteiner::TraerConteinerDeBDPorNumero($numero);
		unlink("archivos/".$conteiner->GetFoto());

		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("DELETE FROM conteiner WHERE numero = ".$numero);
		$cant = $consulta->execute();
		
		if($cant < 1)
		{
			$resultado = FALSE;
		}

		return $resultado;
	}
//--------------------------------------------------------------------------------//
}