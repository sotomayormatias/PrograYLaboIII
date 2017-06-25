<?php
class cd {
	//ATRIBUTOS
	public $id;
	public $titulo;
	public $cantante;
	public $año;

	//METODOS
	public static function TraerTodoLosCds() {
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("SELECT id, 
															titel AS titulo, 
															interpret AS cantante,
															jahr AS año 
														FROM cds");
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_CLASS, "cd");		
	}

	public static function TraerUnCd($id) {
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("SELECT id, 
															titel AS titulo, 
															interpret AS cantante,
															jahr AS año 
														FROM cds 
														WHERE id = $id");
		$consulta->execute();
		$cdBuscado= $consulta->fetchObject('cd');
		return $cdBuscado;
	}

	public function InsertarElCdParametros() {
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO cds(titel,interpret,jahr)
														VALUES(:titulo,:cantante,:anio)");
		$consulta->bindValue(':titulo',$this->titulo, PDO::PARAM_INT);
		$consulta->bindValue(':anio', $this->año, PDO::PARAM_STR);
		$consulta->bindValue(':cantante', $this->cantante, PDO::PARAM_STR);
		$consulta->execute();		
		return $objetoAccesoDato->RetornarUltimoIdInsertado();
	}

	public function BorrarCd() {
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("DELETE
														FROM cds 				
														WHERE id=:id");	
		$consulta->bindValue(':id',$this->id, PDO::PARAM_INT);		
		$consulta->execute();
		return $consulta->rowCount();
	}

	public function ModificarCdParametros() {
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("UPDATE cds 
														SET titel=:titulo,
															interpret=:cantante,
															jahr=:anio
														WHERE id=:id");
		$consulta->bindValue(':id',$this->id, PDO::PARAM_INT);
		$consulta->bindValue(':titulo',$this->titulo, PDO::PARAM_INT);
		$consulta->bindValue(':anio', $this->año, PDO::PARAM_STR);
		$consulta->bindValue(':cantante', $this->cantante, PDO::PARAM_STR);
		return $consulta->execute();
	}

	// public static function BorrarCdPorAnio($año) {
	// 	$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
	// 	$consulta =$objetoAccesoDato->RetornarConsulta("DELETE 
	// 													FROM cds 				
	// 													WHERE jahr=:anio");	
	// 	$consulta->bindValue(':anio',$año, PDO::PARAM_INT);		
	// 	$consulta->execute();
	// 	return $consulta->rowCount();
	// }

	// public function ModificarCd() {
	// 	$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
	// 	$consulta =$objetoAccesoDato->RetornarConsulta("UPDATE cds 
	// 													SET titel='$this->titulo',
	// 														interpret='$this->cantante',
	// 														jahr='$this->año'
	// 													WHERE id='$this->id'");
	// 	return $consulta->execute();
	// }

	// public function InsertarElCd() {
	// 	$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
	// 	$consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO cds(titel,interpret,jahr)
	// 													VALUES('$this->titulo','$this->cantante','$this->año')");
	// 	$consulta->execute();
	// 	return $objetoAccesoDato->RetornarUltimoIdInsertado();
	// }

	// public function GuardarCD() {
	// 	if($this->id>0) {
	// 		$this->ModificarCdParametros();
	// 	}
	// 	else {
	// 		$this->InsertarElCdParametros();
	// 	}
	// }

	// public static function TraerUnCdAnio($id,$anio) {
	// 	$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
	// 	$consulta =$objetoAccesoDato->RetornarConsulta("SELECT titel AS titulo, 
	// 														interpret AS cantante,
	// 														jahr AS año 
	// 													FROM cds 
	// 													WHERE id=? AND jahr=?");
	// 	$consulta->execute(array($id, $anio));
	// 	$cdBuscado= $consulta->fetchObject('cd');
	// 	return $cdBuscado;
	// }

	// public static function TraerUnCdAnioParamNombre($id,$anio) {
	// 	$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
	// 	$consulta =$objetoAccesoDato->RetornarConsulta("SELECT titel AS titulo, 
	// 														interpret AS cantante,
	// 														jahr AS año 
	// 													FROM cds 
	// 													WHERE id=:id AND jahr=:anio");
	// 	$consulta->bindValue(':id', $id, PDO::PARAM_INT);
	// 	$consulta->bindValue(':anio', $anio, PDO::PARAM_STR);
	// 	$consulta->execute();
	// 	$cdBuscado= $consulta->fetchObject('cd');
	// 	return $cdBuscado;
	// }

	// public static function TraerUnCdAnioParamNombreArray($id,$anio) {
	// 	$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
	// 	$consulta =$objetoAccesoDato->RetornarConsulta("SELECT titel AS titulo, 
	// 														interpret AS cantante,
	// 														jahr AS año 
	// 													FROM cds 
	// 													WHERE id=:id AND jahr=:anio");
	// 	$consulta->execute(array(':id'=> $id,':anio'=> $anio));
	// 	$consulta->execute();
	// 	$cdBuscado= $consulta->fetchObject('cd');
	// 	return $cdBuscado;
	// }

	// public function mostrarDatos() {
	// 	return "Metodo mostar:".$this->titulo."  ".$this->cantante."  ".$this->año;
	// }
}