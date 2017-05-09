<?php
require_once ("clases/usuario.php");

$accion = isset($_POST['accion']) ? $_POST['accion'] : NULL;

switch($accion){
	case "mostrarGrilla":
	
		$ArrayDeUsuarios = Usuario::TraerTodosLosUsuariosDeTXT();

		$grilla = '<table class="table table-striped table-hover table-bordered">
					<thead >
						<tr>
							<th>  NOMBRE </th>
							<th>  CORREO </th>
							<th>  EDAD   </th>
						</tr> 
					</thead>';   	

		foreach ($ArrayDeUsuarios as $user){
			$usuario = array();
			$usuario["nombre"] = $user->GetNombre();
			$usuario["correo"] = $user->GetCorreo();
			$usuario["edad"] = $user->GetEdad();

			$usuario = json_encode($usuario);
		
			$grilla .= "<tr>
							<td>".$user->GetNombre()."</td>
							<td>".$user->GetCorreo()."</td>
							<td>".$user->GetEdad()."</td>
							<td><input type='button' value='Eliminar' class='btn btn-danger btnEliminar' id='btnEliminar' onclick='eliminarUsuario($usuario)' /></td>
						</tr>";
		}
		
		$grilla .= '</table>';		
		
		echo $grilla;
		
		break;

	case "eliminar":
		$retorno["Exito"] = TRUE;
		$retorno["Mensaje"] = "";
		$obj = isset($_POST['usuario']) ? json_decode(json_encode($_POST['usuario'])) : NULL;
		
		if(!Usuario::EliminarDeTXT($obj->nombre)){
			$retorno["Exito"] = FALSE;
			$retorno["Mensaje"] = "Lamentablemente ocurrio un error y no se pudo escribir en el archivo.";
		}
		else{
			$retorno["Mensaje"] = "El archivo fue escrito correctamente. PRODUCTO eliminado CORRECTAMENTE!!!";
		}
	
		echo json_encode($retorno);
		
		break;

	default:
		echo ":(";
}
?>