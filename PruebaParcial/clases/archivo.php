<?php
class Archivo{

	public static function Subir()
	{
		$retorno["Exito"] = TRUE;
		
		$tipoArchivo = pathinfo($_FILES["archivo"]["name"], PATHINFO_EXTENSION);

		//VERIFICO EL TAMAÑO MAXIMO QUE PERMITO SUBIR
		if ($_FILES["archivo"]["size"] > 1000000) {
			$retorno["Exito"] = FALSE;
			$retorno["Mensaje"] = "El archivo es demasiado grande. Verifique!!!";
			return $retorno;
		}

		//OBTIENE EL TAMAÑO DE UNA IMAGEN, SI EL ARCHIVO NO ES UNA
		//IMAGEN, RETORNA FALSE
		$esImagen = getimagesize($_FILES["archivo"]["tmp_name"]);

		if($esImagen === FALSE) {//NO ES UNA IMAGEN
			$retorno["Exito"] = FALSE;
			$retorno["Mensaje"] = "Solo son permitidas IMAGENES.";
			return $retorno;
		}
		else {// ES UNA IMAGEN

			//SOLO PERMITO CIERTAS EXTENSIONES
			if($tipoArchivo != "jpg" && $tipoArchivo != "jpeg" && $tipoArchivo != "gif"
				&& $tipoArchivo != "png") {
				$retorno["Exito"] = FALSE;
				$retorno["Mensaje"] = "Solo son permitidas imagenes con extension JPG, JPEG, PNG o GIF.";
				return $retorno;
			}
		}
		
		//BORRO TODO EL CONTENIDO DEL DIRECTORIO
		array_map('unlink', glob("tmp/*"));

		//INDICO CUAL SERA EL DESTINO DEL ARCHIVO SUBIDO
		$archivoTmp = date("Ymd_His") . ".jpg";
		$destino = "tmp/" . $archivoTmp;

		if (!move_uploaded_file($_FILES["archivo"]["tmp_name"], $destino)) {

			$retorno["Exito"] = FALSE;
			$retorno["Mensaje"] = "Ocurrio un error al subir el archivo. No pudo guardarse.";
			return $retorno;
		}
		else{
			$retorno["Mensaje"] = "Archivo subido exitosamente!!!"; 
			$retorno["Html"] = "<img src='".$destino."' width='300px' height='300px' class='img-rounded' />";
			$retorno["archivoTmp"] = $archivoTmp;
			
			return $retorno;
		}
	}

	public static function Borrar($path)
	{
		return unlink($path);
	}

	public static function Mover($pathOrigen, $pathDestino)
	{
		return rename($pathOrigen, $pathDestino);
	}
}
?>