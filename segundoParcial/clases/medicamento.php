<?php
class medicamento {
	//ATRIBUTOS
	public $id;
	public $nombre;
	public $precio;
	public $laboratorio;

	//METODOS
	public static function TraerTodosLosMedicamentos() {
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("SELECT id, 
															nombre, 
															precio,
															laboratorio 
														FROM medicamentos
                                                        ORDER BY laboratorio");
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_CLASS, "medicamento");		
	}

	public static function TraerUnMedicamento($id) {
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("SELECT id, 
															nombre, 
															precio,
															laboratorio 
														FROM medicamentos
														WHERE id = $id");
		$consulta->execute();
		$medicamentoBuscado= $consulta->fetchObject('medicamento');
		return $medicamentoBuscado;
	}


	public static function GuardarMedicamento($medi){
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO medicamentos(nombre, precio, laboratorio)
														VALUES(:nombre,:precio,:labo)");
		$consulta->bindValue(':nombre', $medi->nombre, PDO::PARAM_STR);
		$consulta->bindValue(':precio', $medi->precio, PDO::PARAM_INT);
		$consulta->bindValue(':labo', $medi->laboratorio, PDO::PARAM_STR);
		$consulta->execute();		
		return $objetoAccesoDato->RetornarUltimoIdInsertado();
	}

	// public function InsertarElMedicamento() {
	// 	$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
	// 	$consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO medicamentos(nombre, precio, laboratorio)
	// 													VALUES(:nombre,:precio,:labo)");
	// 	$consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_INT);
	// 	$consulta->bindValue(':precio', $this->precio, PDO::PARAM_STR);
	// 	$consulta->bindValue(':labo', $this->laboratorio, PDO::PARAM_STR);
	// 	$consulta->execute();		
	// 	return $objetoAccesoDato->RetornarUltimoIdInsertado();
	// }

	public function BorrarMedicamento() {
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("DELETE
														FROM medicamentos 				
														WHERE id=:id");	
		$consulta->bindValue(':id',$this->id, PDO::PARAM_INT);		
		$consulta->execute();
		return $consulta->rowCount();
	}

	public function ModificarMedicamento() {
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("UPDATE medicamentos 
														SET nombre=:nombre,
															precio=:precio,
															laboratorio=:labo
														WHERE id=:id");
		$consulta->bindValue(':id',$this->id, PDO::PARAM_INT);
		$consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_INT);
		$consulta->bindValue(':precio', $this->precio, PDO::PARAM_STR);
		$consulta->bindValue(':labo', $this->laboratorio, PDO::PARAM_STR);
		return $consulta->execute();
	}
}