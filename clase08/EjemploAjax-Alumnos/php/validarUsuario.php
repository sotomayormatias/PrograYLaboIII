<?php 
	// sin esto no funciona session_start();
	session_start();
	$usuario=$_POST['usuario'];
	$clave=$_POST['clave'];
	$recordar=$_POST['recordarme'];
	$retorno;

	if($usuario == "octavio@admin.com.ar" && $clave == "1234") {
		// creo la variable de $_SESSION
		$_SESSION['registrado'] = $usuario;

		if($recordar == "true") {
			//creo la cookie del usuario - el parametro '/' es para que ande en localhost desde el chrome
			setcookie("usuario", $usuario, time() + 3600, "/");
		}
		else {
			//borro la cookie del usuario
			setcookie("usuario", "", time() + 3600, "/");
		}
		
		$retorno = "ingreso";
	}
	else {
		$retorno = "No-esta";
	}

	echo $retorno;
?>