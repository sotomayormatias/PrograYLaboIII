<?php
require_once ("clases/conteiner.php");
require_once ("clases/archivo.php");

$accion = isset($_POST['accion']) ? $_POST['accion'] : NULL;

switch($accion){
	case "mostrarGrilla":
	
		$ArrayDeConteiner = Conteiner::TraerTodosLosConteinerDeBD();

		$grilla = '<table class="table table-striped table-hover table-bordered">
					<thead >
						<tr>
							<th>  NUMERO </th>
							<th>  DESCRIPCION </th>
							<th>  PAIS   </th>
							<th>  FOTO   </th>
						</tr> 
					</thead>';   	

		foreach ($ArrayDeConteiner as $cont){
			$conteiner = array();
			$conteiner["numero"] = $cont->GetNumero();
			$conteiner["descripcion"] = $cont->GetDescripcion();
			$conteiner["pais"] = $cont->GetPais();
			$conteiner["foto"] = $cont->GetFoto();

			$conteiner = json_encode($conteiner);
		
			$grilla .= "<tr>
							<td>".$cont->GetNumero()."</td>
							<td>".$cont->GetDescripcion()."</td>
							<td>".$cont->GetPais()."</td>
							<td><img src='archivos/".$cont->GetFoto()."' width='100px' height='100px'/></td>
							<td><input type='button' value='Eliminar' class='btn btn-danger btnEliminar' id='btnEliminar' onclick='eliminarConteiner($conteiner)' /></td>
						</tr>";
		}
		
		$grilla .= '</table>';		
		
		echo $grilla;
		
		break;
		
	case "subirFoto":
		
		$res = Archivo::Subir();
		echo json_encode($res);

		break;
		
	case "agregar":
		$retorno["Exito"] = TRUE;
		$retorno["Mensaje"] = "";
		$obj = isset($_POST['conteiner']) ? json_decode(json_encode($_POST['conteiner'])) : NULL;
		
		$p = new Conteiner($obj->numero,$obj->descripcion,$obj->pais,$obj->foto);
		
		if(!Conteiner::GuardarEnBD($p)){
			$retorno["Exito"] = FALSE;
			$retorno["Mensaje"] = "Lamentablemente ocurrio un error y no se pudo escribir en el archivo.";
		}
		else{
			if(!Archivo::Mover("./tmp/".$obj->foto, "./archivos/".$obj->foto)){
				$retorno["Exito"] = FALSE;
				$retorno["Mensaje"] = "Lamentablemente ocurrio un error al mover el archivo del repositorio temporal al repositorio final.";
			}
			else{
				$retorno["Mensaje"] = "El archivo fue escrito correctamente. PRODUCTO agregado CORRECTAMENTE!!!";
			}
		}
	
		echo json_encode($retorno);
		
		break;

	case "eliminar":
		$retorno["Exito"] = TRUE;
		$retorno["Mensaje"] = "";
		$obj = isset($_POST['conteiner']) ? json_decode(json_encode($_POST['conteiner'])) : NULL;
		
		if(!Conteiner::EliminarDeBD($obj->numero)){
			$retorno["Exito"] = FALSE;
			$retorno["Mensaje"] = "Lamentablemente ocurrio un error y no se pudo escribir en el archivo.";
		}
		else{
			$retorno["Mensaje"] = "El archivo fue escrito correctamente. PRODUCTO eliminado CORRECTAMENTE!!!";
		}
	
		echo json_encode($retorno);
		
		break;
	
	case "filtrar":
		
		$pais = isset($_POST['pais']) ? $_POST['pais'] : NULL;
		$ArrayDeConteiner = Conteiner::TraerConteinerDeBDPorPais($pais);
		$grilla = '<table class="table table-striped table-hover table-bordered">
					<thead >
						<tr>
							<th>  NUMERO </th>
							<th>  DESCRIPCION </th>
							<th>  PAIS   </th>
							<th>  FOTO   </th>
						</tr> 
					</thead>';   	
		
		foreach ($ArrayDeConteiner as $cont){
			// $conteiner = array();
			// $conteiner["numero"] = $cont->GetNumero();
			// $conteiner["descripcion"] = $cont->GetDescripcion();
			// $conteiner["pais"] = $cont->GetPais();
			// $conteiner["foto"] = $cont->GetFoto();

			// $conteiner = json_encode($conteiner);
		
			$grilla .= "<tr>
							<td>".$cont->GetNumero()."</td>
							<td>".$cont->GetDescripcion()."</td>
							<td>".$cont->GetPais()."</td>
							<td><img src='archivos/".$cont->GetFoto()."' width='100px' height='100px'/></td>
							
						</tr>";
		}
		
		$grilla .= '</table>';		
		
		echo $grilla;
		
		break;

	default:
		echo ":(";
}
?>