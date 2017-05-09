<?php
class Usuario
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	private $nombre;
 	private $correo;
  	private $edad;
    private $clave;
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--GETTERS Y SETTERS
	public function GetNombre()
	{
		return $this->nombre;
	}
	public function GetCorreo()
	{
		return $this->correo;
	}
    public function GetEdad()
	{
		return $this->edad;
	}
	public function GetClave()
	{
		return $this->clave;
	}

	public function SetNombre($valor)
	{
		$this->nombre = $valor;
	}
	public function SetCorreo($valor)
	{
		$this->correo = $valor;
	}
    public function SetEdad($valor)
	{
		$this->edad = $valor;
	}
	public function SetClave($valor)
	{
		$this->clave = $valor;
	}

//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
	public function __construct($nombre=NULL, $correo=NULL, $edad=NULL, $clave=NULL)
	{
		if($nombre != NULL && $correo != NULL && $edad != NULL && $clave != NULL){
			$this->nombre = $nombre;
			$this->correo = $correo;
            $this->edad = $edad;
			$this->clave = $clave;
		}
	}

//--------------------------------------------------------------------------------//
//--TOSTRING	
  	public function ToString()
	{
	  	return $this->nombre." - ".$this->correo." - ".$this->edad." - ".$this->clave."\r\n";
	}
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--METODOS
	public static function GuardarEnTXT($obj)
	{
		$resultado = FALSE;
		//ABRO EL ARCHIVO
		$ar = fopen("archivos/usuario.txt", "a");
		
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

	public static function TraerTodosLosUsuariosDeTXT()
	{
		$ListaDeUsuariosLeidos = array();

		//leo todos los usuarios del archivo
		$archivo=fopen("archivos/usuario.txt", "r");
		
		while(!feof($archivo))
		{
			$archAux = fgets($archivo);
			$usuarios = explode(" - ", $archAux);
            
			$usuarios[0] = trim($usuarios[0]);
			if($usuarios[0] != ""){
				$ListaDeUsuariosLeidos[] = new Usuario(trim($usuarios[0]), trim($usuarios[1]), trim($usuarios[2]), trim($usuarios[3]));
			}
		}
		fclose($archivo);
		
		return $ListaDeUsuariosLeidos;
		
	}

    public static function ExisteUsuario($correo)
	{
		//leo todos los usuarios del archivo
		$archivo=fopen("archivos/usuario.txt", "r");
		
		while(!feof($archivo))
		{
			$archAux = fgets($archivo);
			$usuarios = explode(" - ", $archAux);
            
			$usuarios[0] = trim($usuarios[0]);
			if($usuarios[0] != ""){
				$usuario = new Usuario(trim($usuarios[0]), trim($usuarios[1]), trim($usuarios[2]), trim($usuarios[3]));
                if($usuario->getCorreo() == $correo){
		            fclose($archivo);
                    return true;
                }
			}
		}
		fclose($archivo);
		
		return false;
	}

	public static function EliminarDeTXT($nombre)
	{
		if($nombre === NULL)
			return FALSE;
			
		$resultado = TRUE;
		
		$ListaDeUsuariosLeidos = Usuario::TraerTodosLosUsuariosDeTXT();
		$ListaDeUsuarios = array();
		
		for($i=0; $i<count($ListaDeUsuariosLeidos); $i++){
			if($ListaDeUsuariosLeidos[$i]->nombre == $nombre){//encontre el borrado, lo excluyo
				continue;
			}
			$ListaDeUsuarios[$i] = $ListaDeUsuariosLeidos[$i];
		}

		//ABRO EL ARCHIVO
		$ar = fopen("archivos/usuario.txt", "w");
		
		//ESCRIBO EN EL ARCHIVO
		foreach($ListaDeUsuarios AS $item){
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
//--------------------------------------------------------------------------------//
}