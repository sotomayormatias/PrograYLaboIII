<?php
require_once 'cd.php';
require_once 'IApiUsable.php';

class cdApi extends cd implements IApiUsable {

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
		//var_dump($ArrayDeParametros);
		$titulo= $ArrayDeParametros['titulo'];
		$cantante= $ArrayDeParametros['cantante'];
		$año= $ArrayDeParametros['anio'];

		$micd = new cd();
		$micd->titulo=$titulo;
		$micd->cantante=$cantante;
		$micd->año=$año;
		// $micd->InsertarElCdParametros();

		$archivos = $request->getUploadedFiles();
		cd::GuardarCd($micd, $archivos);
		// $foto = $archivos['foto'];

		// $foto->moveTo("fotos/" . $titulo . ".jpg");

		return $response;

		// $archivos = $request->getUploadedFiles();
		// $destino="/fotos/";
		// //var_dump($archivos);
		// //var_dump($archivos['foto']);

		// $nombreAnterior=$archivos['foto']->getClientFilename();
		// $extension= explode(".", $nombreAnterior)  ;
		// //var_dump($nombreAnterior);
		// $extension=array_reverse($extension);

		// $archivos['foto']->moveTo($destino.$titulo.".".$extension[0]);
		// $response->getBody()->write("se guardo el cd");

		// return $response;
	}

	public function BorrarUno($request, $response, $args) {
		// $ArrayDeParametros = $request->getParsedBody();
		// $id=$ArrayDeParametros['id'];
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

		$micd = new cd();
		$micd->id=$ArrayDeParametros['id'];
		$micd->titulo=$ArrayDeParametros['titulo'];
		$micd->cantante=$ArrayDeParametros['cantante'];
		$micd->año=$ArrayDeParametros['anio'];

		$resultado =$micd->ModificarCdParametros();
		$objDelaRespuesta= new stdclass();
		$objDelaRespuesta->resultado=$resultado;
		return $response->withJson($objDelaRespuesta, 200);		
	}
}