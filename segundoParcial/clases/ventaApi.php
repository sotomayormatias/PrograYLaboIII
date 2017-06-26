<?php
require_once 'venta.php';
require_once 'medicamento.php';
require_once 'IApiUsable.php';

class ventaApi extends venta implements IApiUsable {

	public function TraerUno($request, $response, $args) {
		$id=$args['id'];
		$elCd=cd::TraerUnCd($id);
		$newResponse = $response->withJson($elCd, 200);  
		// $response->getBody()->write("<h1>TraerUno</h1>");
		return $response;
	}

	public function TraerTodos($request, $response, $args) {
		$todosLosCds=cd::TraerTodoLosCds();
		$response = $response->withJson($todosLosCds, 200);  
		return $response;
	}

	public function CargarUno($request, $response, $args) {
		$ArrayDeParametros = $request->getParsedBody();
		$idMedicamento = $ArrayDeParametros['idMedicamento'];
		$nombreCliente = $ArrayDeParametros['nombreCliente'];

        $medicamento = medicamento::TraerUnMedicamento($idMedicamento);
		$nombreFoto = $medicamento->id . "_" . $medicamento->laboratorio;

		$miventa = new venta();
		$miventa->idMedicamento=$idMedicamento;
		$miventa->nombreCliente=$nombreCliente;
		$miventa->nombreFoto=$nombreFoto;

		$archivos = $request->getUploadedFiles();
		$id = venta::GuardarVenta($miventa, $archivos);

        $objDelaRespuesta= new stdclass();
        if($id > 0){
		    $objDelaRespuesta->resultado = "Exito!";
        }
        else {
            $objDelaRespuesta->resultado = "No se pudieron insertar los datos";
        }
        $newResponse = $response->withJson($objDelaRespuesta, 200);  

		return $newResponse;
	}

	public function BorrarUno($request, $response, $args) {
		$id=$args['id'];
		$cd= new cd();
		$cd->id=$id;
		$cantidadDeBorrados=$cd->BorrarCd();

		$objDelaRespuesta= new stdclass();
		$objDelaRespuesta->cantidad=$cantidadDeBorrados;
		if($cantidadDeBorrados>0){
			$objDelaRespuesta->resultado="Borrado exitoso!!!";
		}
		else{
			$objDelaRespuesta->resultado="no Borro nada!!!";
		}
		$newResponse = $response->withJson($objDelaRespuesta, 200);  
		return $newResponse;
	}

	public function ModificarUno($request, $response, $args) {
		$ArrayDeParametros = $request->getParsedBody();

		$miventa = new venta();
		$miventa->idVenta=$ArrayDeParametros['idVenta'];
		$miventa->idMedicamento=$ArrayDeParametros['idMedicamento'];
		$miventa->nombreCliente=$ArrayDeParametros['nombreCliente'];

        $medicamento = medicamento::TraerUnMedicamento($idMedicamento);
		$miventa->$nombreFoto = $medicamento->id . "_" . $medicamento->laboratorio;

		$resultado =$miventa->ModificarVentaParametros();
		$objDelaRespuesta= new stdclass();
		$objDelaRespuesta->resultado=$resultado;
		return $response->withJson($objDelaRespuesta, 200);		
	}
}