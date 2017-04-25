<?php
class Producto
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	private $codigo_barra;
 	private $nombre;
  	private $path_foto;
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--GETTERS Y SETTERS
	public function GetcodBarra()
	{
		return $this->codigo_barra;
	}
	public function GetNombre()
	{
		return $this->nombre;
	}
	public function GetpathFoto()
	{
		return $this->path_foto;
	}

	public function SetCodBarra($valor)
	{
		$this->codigo_barra = $valor;
	}
	public function SetNombre($valor)
	{
		$this->nombre = $valor;
	}
	public function SetpathFoto($valor)
	{
		$this->path_foto = $valor;
	}

//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
	public function __construct($codigo_barra=NULL, $nombre=NULL, $path_foto=NULL)
	{
		if($codigo_barra !== NULL && $nombre !== NULL && $path_foto !== NULL){
			$this->codigo_barra = $codigo_barra;
			$this->nombre = $nombre;
			$this->path_foto = $path_foto;
		}
	}

//--------------------------------------------------------------------------------//
//--TOSTRING	
  	public function ToString()
	{
	  	return $this->codigo_barra." - ".$this->nombre." - ".$this->path_foto."\r\n";
	}
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--METODOS DE CLASE
	public static function Guardar($obj)
	{
		$resultado = FALSE;
		
		//ABRO EL ARCHIVO
		$ar = fopen("archivos/productos.txt", "a");
		
		//ESCRIBO EN EL ARCHIVO
		$cant = fwrite($ar, $obj->ToString());
		
		if($cant > 0)
		{
			$resultado = TRUE;			
		}
		//CIERRO EL ARCHIVO
		fclose($ar);
		
		return $resultado;
	}
	public static function TraerTodosLosProductos()
	{

		$ListaDeProductosLeidos = array();

		//leo todos los productos del archivo
		$archivo=fopen("archivos/productos.txt", "r");
		
		while(!feof($archivo))
		{
			$archAux = fgets($archivo);
			$productos = explode(" - ", $archAux);
			//http://www.w3schools.com/php/func_string_explode.asp
			$productos[0] = trim($productos[0]);
			if($productos[0] != ""){
				$ListaDeProductosLeidos[] = new Producto($productos[0], $productos[1],$productos[2]);
			}
		}
		fclose($archivo);
		
		return $ListaDeProductosLeidos;
		
	}

	public static function TraerTodosLosProductosDeBD()
	{
		$objConexion = AccesoDatos::dameUnObjetoAcceso();
		
		$consulta = $objConexion->RetornarConsulta("SELECT codigo_barra, nombre, path_foto FROM producto");
		$consulta->execute();
		return $consulta->fetchAll(PDO::FETCH_CLASS, "Producto");
	}
//--------------------------------------------------------------------------------//
}