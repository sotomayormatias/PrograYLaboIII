<?php
require_once 'medicamento.php';
require_once 'IApiUsable.php';

class medicamentoApi extends medicamento implements IApiUsable {

	public function TraerUno($request, $response, $args) {
		$id=$args['id'];
		$elMedi=medicamento::TraerUnMedicamento($id);
		$newResponse = $response->withJson($elMedi, 200);  
		return $response;
	}

	public function TraerTodos($request, $response, $args) {
		$todosLosMedis=medicamento::TraerTodosLosMedicamentos();
		$response = $response->withJson($todosLosMedis, 200);  
		return $response;
	}

	public function CargarUno($request, $response, $args) {
		$ArrayDeParametros = $request->getParsedBody();
		$nombre= $ArrayDeParametros['nombre'];
		$precio= $ArrayDeParametros['precio'];
		$laboratorio= $ArrayDeParametros['laboratorio'];

		$miMedi = new medicamento();
		$miMedi->nombre=$nombre;
		$miMedi->precio=$precio;
		$miMedi->laboratorio=$laboratorio;

		$id = medicamento::GuardarMedicamento($miMedi);
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
		$medicamento= new medicamento();
		$medicamento->id=$id;
		$cantidadDeBorrados = $medicamento->BorrarMedicamento();

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

		$miMedi = new medicamento();
		$miMedi->id=$ArrayDeParametros['id'];
		$miMedi->nombre=$ArrayDeParametros['nombre'];
		$miMedi->precio=$ArrayDeParametros['precio'];
		$miMedi->laboratorio=$ArrayDeParametros['laboratorio'];

		$resultado =$miMedi->ModificarMedicamento();
		$objDelaRespuesta= new stdclass();
        if($resultado){
		    $objDelaRespuesta->resultado = "Modificacion exitosa!";
        }
        else {
            $objDelaRespuesta->resultado = "No se pudieron modificar los datos";
        }
		return $response->withJson($objDelaRespuesta, 200);		
	}
}