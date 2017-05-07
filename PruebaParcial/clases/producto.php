<?php
include_once ("conexion.php");
class Producto
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	private $codBarra;
 	private $nombre;
  	private $pathFoto;
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--GETTERS Y SETTERS
	public function GetCodBarra()
	{
		return $this->codBarra;
	}
	public function GetNombre()
	{
		return $this->nombre;
	}
	public function GetPathFoto()
	{
		return $this->pathFoto;
	}

	public function SetCodBarra($valor)
	{
		$this->codBarra = $valor;
	}
	public function SetNombre($valor)
	{
		$this->nombre = $valor;
	}
	public function SetPathFoto($valor)
	{
		$this->pathFoto = $valor;
	}

//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
	public function __construct($codBarra=NULL, $nombre=NULL, $pathFoto=NULL)
	{
		if($codBarra !== NULL && $nombre !== NULL){
			$this->codBarra = $codBarra;
			$this->nombre = $nombre;
			$this->pathFoto = $pathFoto;
		}
	}

//--------------------------------------------------------------------------------//
//--TOSTRING	
  	public function ToString()
	{
	  	return $this->codBarra." - ".$this->nombre." - ".$this->pathFoto."\r\n";
	}
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--METODOS
	public static function GuardarEnTXT($obj)
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

	public static function TraerTodosLosProductosDeTXT()
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
				$ListaDeProductosLeidos[] = new Producto(trim($productos[0]), trim($productos[1]), trim($productos[2]));
			}
		}
		fclose($archivo);
		
		return $ListaDeProductosLeidos;
		
	}

	public static function ModificarEnTXT($obj)
	{
		$resultado = TRUE;
		
		$ListaDeProductosLeidos = Producto::TraerTodosLosProductosDeTXT();
		$ListaDeProductos = array();
		$imagenParaBorrar = NULL;
		
		for($i=0; $i<count($ListaDeProductosLeidos); $i++){
			if($ListaDeProductosLeidos[$i]->codBarra == $obj->codBarra){//encontre el modificado, lo excluyo
				//$imagenParaBorrar = trim($ListaDeProductosLeidos[$i]->pathFoto);
				continue;
			}
			$ListaDeProductos[$i] = $ListaDeProductosLeidos[$i];
		}

		array_push($ListaDeProductos, $obj);//agrego el producto modificado
		
		//ABRO EL ARCHIVO
		$ar = fopen("archivos/productos.txt", "w");
		
		//ESCRIBO EN EL ARCHIVO
		foreach($ListaDeProductos AS $item){
			$cant = fwrite($ar, $item->ToString());
			
			if($cant < 1)
			{
				$resultado = FALSE;
				break;
			}
		}
		
		//CIERRO EL ARCHIVO
		fclose($ar);
		
		return $resultado;
	}

	public static function EliminarDeTXT($codBarra)
	{
		if($codBarra === NULL)
			return FALSE;
			
		$resultado = TRUE;
		
		$ListaDeProductosLeidos = Producto::TraerTodosLosProductosDeTXT();
		$ListaDeProductos = array();
		$imagenParaBorrar = NULL;
		
		for($i=0; $i<count($ListaDeProductosLeidos); $i++){
			if($ListaDeProductosLeidos[$i]->codBarra == $codBarra){//encontre el borrado, lo excluyo
				$imagenParaBorrar = trim($ListaDeProductosLeidos[$i]->pathFoto);
				continue;
			}
			$ListaDeProductos[$i] = $ListaDeProductosLeidos[$i];
		}

		//BORRO LA IMAGEN ANTERIOR
		unlink("archivos/".$imagenParaBorrar);
		
		//ABRO EL ARCHIVO
		$ar = fopen("archivos/productos.txt", "w");
		
		//ESCRIBO EN EL ARCHIVO
		foreach($ListaDeProductos AS $item){
			$cant = fwrite($ar, $item->ToString());
			
			if($cant < 1)
			{
				$resultado = FALSE;
				break;
			}
		}
		
		//CIERRO EL ARCHIVO
		fclose($ar);
		
		return $resultado;
	}


	public static function GuardarEnBD($obj)
	{
		$resultado = FALSE;
		
		$codBarra = $obj->GetCodBarra();
		$nombre = $obj->GetNombre();
		$pathFoto = $obj->GetPathFoto();

		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("INSERT INTO producto(codigo_barra, nombre, path_foto) VALUES(".$codBarra.", '".$nombre."', '".$pathFoto."')");
		$cant = $consulta->execute();
		
		if($cant > 0)
		{
			$resultado = TRUE;			
		}
		
		return $resultado;
	}

	public static function TraerTodosLosProductosDeBD()
	{
		$ListaDeProductosLeidos = array();

		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("SELECT codigo_barra, nombre, path_foto FROM producto");
		$consulta->execute();
		while($fila = $consulta->fetch(PDO::FETCH_ASSOC))
		{
			$ListaDeProductosLeidos[] = new Producto($fila['codigo_barra'], $fila['nombre'], $fila['path_foto']);
		}
		
		return $ListaDeProductosLeidos;
	}

	public static function TraerProductoDeBDPorCodigo($codBarra)
	{
		$ListaDeProductosLeidos = array();

		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("SELECT codigo_barra, nombre, path_foto FROM producto WHERE codigo_barra = ".$codBarra);
		$consulta->execute();
		$fila = $consulta->fetch(PDO::FETCH_ASSOC);

		$producto = new Producto($fila['codigo_barra'], $fila['nombre'], $fila['path_foto']);
		
		return $producto;
	}

	public static function ModificarEnBD($obj)
	{
		$resultado = TRUE;
		
		$codBarra = $obj->GetCodBarra();
		$nombre = $obj->GetNombre();
		$pathFoto = $obj->GetPathFoto();

		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("UPDATE producto SET nombre = '".$nombre."', path_foto = '".$pathFoto."' WHERE codigo_barra = ".$codBarra);
		$cant = $consulta->execute();
			
		if($cant < 1)
		{
			$resultado = FALSE;
		}
		
		return $resultado;
	}

	public static function EliminarDeBD($codBarra)
	{
		if($codBarra === NULL)
			return FALSE;
			
		$resultado = TRUE;
		
		$producto = Producto::TraerProductoDeBDPorCodigo($codBarra);
		unlink("archivos/".$producto->GetPathFoto());

		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("DELETE FROM producto WHERE codigo_barra = ".$codBarra);
		$cant = $consulta->execute();
		
		if($cant < 1)
		{
			$resultado = FALSE;
		}

		return $resultado;
	}
//--------------------------------------------------------------------------------//
}