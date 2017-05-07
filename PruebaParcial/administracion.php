<?php
require_once ("clases/producto.php");
require_once ("clases/archivo.php");

$accion = isset($_POST['accion']) ? $_POST['accion'] : NULL;

switch($accion){

	case "mostrarGrilla":
	
		$ArrayDeProductos = Producto::TraerTodosLosProductosDeTXT();

		$grilla = '<table class="table table-striped table-hover table-bordered">
					<thead >
						<tr>
							<th>  COD. BARRA </th>
							<th>  NOMBRE     </th>
							<th>  FOTO       </th>
							<th>  ACCION     </th>
						</tr> 
					</thead>';   	

		foreach ($ArrayDeProductos as $prod){
			$producto = array();
			$producto["codBarra"] = $prod->GetCodBarra();
			$producto["nombre"] = $prod->GetNombre();
			$producto["pathFoto"] = $prod->GetPathFoto();

			$producto = json_encode($producto);
		
			$grilla .= "<tr>
							<td>".$prod->GetCodBarra()."</td>
							<td>".$prod->GetNombre()."</td>
							<td><img src='archivos/".$prod->GetPathFoto()."' width='100px' height='100px'/></td>
							<td><input type='button' value='Eliminar' class='MiBotonUTN btn btn-danger btnEliminar' id='btnEliminar' onclick='eliminarProducto($producto)' />
								<input type='button' value='Editar' class='MiBotonUTN btn btn-warning' id='btnModificar' onclick='editarProducto($producto)' /></td>
						</tr>";
		}
		
		$grilla .= '</table>';		
		
		echo $grilla;
		
		break;
		
	case "subirFoto":
		
		$res = Archivo::Subir();
		echo json_encode($res);

		break;
	
	case "borrarFoto":
		
		$pathFoto = isset($_POST['foto']) ? $_POST['foto'] : NULL;
		$res["Exito"] = Archivo::Borrar("./tmp/".$pathFoto);
		
		echo json_encode($res);
		
		break;
		
	case "agregar":
		$retorno["Exito"] = TRUE;
		$retorno["Mensaje"] = "";
		$obj = isset($_POST['producto']) ? json_decode(json_encode($_POST['producto'])) : NULL;
		
		$p = new Producto($obj->codBarra,$obj->nombre,$obj->archivo);
		
		if(!Producto::GuardarEnTXT($p)){
			$retorno["Exito"] = FALSE;
			$retorno["Mensaje"] = "Lamentablemente ocurrio un error y no se pudo escribir en el archivo.";
		}
		else{
			if(!Archivo::Mover("./tmp/".$obj->archivo, "./archivos/".$obj->archivo)){
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
		$obj = isset($_POST['producto']) ? json_decode(json_encode($_POST['producto'])) : NULL;
		
		if(!Producto::EliminarDeTXT($obj->codBarra)){
			$retorno["Exito"] = FALSE;
			$retorno["Mensaje"] = "Lamentablemente ocurrio un error y no se pudo escribir en el archivo.";
		}
		else{
			$retorno["Mensaje"] = "El archivo fue escrito correctamente. PRODUCTO eliminado CORRECTAMENTE!!!";
		}
	
		echo json_encode($retorno);
		
		break;
	
	case "cargarDatosAEditar":
		$retorno["Exito"] = TRUE;
		$retorno["Mensaje"] = "";
		
		$path = isset($_POST['pathFoto']) ? $_POST['pathFoto'] : NULL;

		//Borro todo el contenido del directorio temporal
		array_map('unlink', glob("tmp/*"));

		//Envio la imagen a editar al directorio temporal
		Archivo::Mover("archivos/".$path, "tmp/".$path);

		$retorno["HtmlImagen"] = "<img src='tmp/".$path."' width='300px' height='300px' class='img-rounded' />";
		$retorno["Path"] = $path;
		$retorno["HtmlBotonera"] = "<div class='form-group'>
                                    <input type='button' class='miBotonUTN btn btn-warning btn-block' onclick='modificarProducto()' value='Guardar cambios' />
									<input type='button' class='miBotonUTN btn btn-danger btn-block' onclick='cancelarEdicion(\"".$path."\")' value='Cancelar' />
                                    </div>";

		echo json_encode($retorno);

		break;

	case "cancelarEdicion":
		$path = isset($_POST['pathFoto']) ? $_POST['pathFoto'] : NULL;
		
		//Vuelvo la imagen al directorio definitivo
		Archivo::Mover("tmp/".$path, "archivos/".$path);

		$retorno["Html"] = "<div class='form-group'>
                            <input type='button' class='miBotonUTN btn btn-primary btn-block' onclick='agregarProducto()' value='Agregar' />
                            </div>";
		echo json_encode($retorno);

		break;

	case "modificar":
		$retorno["Exito"] = TRUE;
		$retorno["Mensaje"] = "";
		$retorno["HtmlBotonera"] = "<div class='form-group'>
                            	<input type='button' class='miBotonUTN btn btn-primary btn-block' onclick='agregarProducto()' value='Agregar' />
                            	</div>";

		$obj = isset($_POST['producto']) ? json_decode(json_encode($_POST['producto'])) : NULL;
		
		$p = new Producto($obj->codBarra,$obj->nombre,$obj->archivo);
		
		if(!Producto::ModificarEnTXT($p)){
			$retorno["Exito"] = FALSE;
			$retorno["Mensaje"] = "Lamentablemente ocurrio un error y no se pudo escribir en el archivo.";
		}
		else{
			if(!Archivo::Mover("./tmp/".$obj->archivo, "./archivos/".$obj->archivo)){
				$retorno["Exito"] = FALSE;
				$retorno["Mensaje"] = "Lamentablemente ocurrio un error al mover el archivo del repositorio temporal al repositorio final.";
			}
			else{
				$retorno["Mensaje"] = "El archivo fue escrito correctamente. PRODUCTO modificado CORRECTAMENTE!!!";
			}
		}
	
		echo json_encode($retorno);
		
		break;
	default:
		echo ":(";
}
?>