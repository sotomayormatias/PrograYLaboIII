<?php
require_once 'medicamento.php';

class venta {
	//ATRIBUTOS
	public $idVenta;
	public $idMedicamento;
	public $nombreCliente;
    public $nombreFoto;

	//METODOS
	public static function TraerTodasLasVentas() {
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("SELECT idVenta, 
															idMedicamento,
                                                            nombreCliente,
                                                            nombreFoto
														FROM ventas");
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_CLASS, "venta");		
	}

	public static function TraerUnaVenta($id) {
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("SELECT idVenta, 
															idMedicamento,
                                                            nombreCliente,
                                                            nombreFoto
														FROM ventas
														WHERE idVenta = $id");
		$consulta->execute();
		$ventaBuscada= $consulta->fetchObject('venta');
		return $ventaBuscada;
	}


	public static function GuardarVenta($venta, $archivos){
		$id = $venta->InsertarLaVentaParametros();
        // $medicamento = medicamento::TraerUnMedicamento($venta->id);
		$foto = $archivos['foto'];
		$foto->moveTo("fotos/" . $venta->nombreFoto . ".jpg");

        return $id;
	}

	public function InsertarLaVentaParametros() {
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO ventas(idMedicamento, nombreCliente, nombreFoto)
														VALUES(:idMedicamento,:nombreCliente,:nombreFoto)");
		$consulta->bindValue(':idMedicamento',$this->idMedicamento, PDO::PARAM_INT);
		$consulta->bindValue(':nombreCliente', $this->nombreCliente, PDO::PARAM_STR);
		$consulta->bindValue(':nombreFoto', $this->nombreFoto, PDO::PARAM_STR);
		$consulta->execute();		
		return $objetoAccesoDato->RetornarUltimoIdInsertado();
	}

	public function BorrarVenta() {
		// $path = "fotos/".$this->id.".jpg";
		// if(file_exists($path)){
		// 	unlink($path);
		// }
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("DELETE
														FROM ventas 				
														WHERE id=:id");	
		$consulta->bindValue(':id',$this->id, PDO::PARAM_INT);		
		$consulta->execute();
		return $consulta->rowCount();
	}

	public function ModificarVenta() {
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $medicamento = medicamento::traerUnMedicamento($this->id);
		$consulta =$objetoAccesoDato->RetornarConsulta("UPDATE ventas 
														SET idMedicamento=:idMedicamento,
															nombreCliente=:nombreCliente,
															nombreFoto=:nombreFoto
														WHERE id=:idVenta");
		$consulta->bindValue(':idVenta',$this->idVenta, PDO::PARAM_INT);
		$consulta->bindValue(':idMedicamento',$this->idMedicamento, PDO::PARAM_INT);
		$consulta->bindValue(':nombreCliente',$this->nombreCliente, PDO::PARAM_STR);
		$consulta->bindValue(':nombreFoto', $this->nombreFoto, PDO::PARAM_STR);
		return $consulta->execute();
	}
}