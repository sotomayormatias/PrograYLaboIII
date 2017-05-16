function validarLogin()
{
	var varUsuario=$("#correo").val();
	var varClave=$("#clave").val();
	var recordar=$("#recordarme").is(':checked');

	$("#informe").html("<img src='imagenes/ajax-loader.gif' style='width: 30px;'/>");

	$.ajax({
		url:"php/validarUsuario.php",
		type:"POST",
		data: {
			usuario: varUsuario,
			clave: varClave,
			recordarme: recordar
		}
	})
	.then(loginSuccess, loginFail);


	//	url:"php/validarUsuario.php",
	//	type:"post",
	
		// si esta logeado le habilito los botones 
		//if(????????){	
			//MostarBotones();
		//	MostarLogin();

		//	$("#BotonLogin").html("Ir a salir<br>-Sesión-");
		//	$("#BotonLogin").addClass("btn btn-danger");				
		//	$("#usuario").val("usuario: "+retorno);
		//}else
		//{
		//	$("#informe").html("usuario o clave incorrecta");	
		//	$("#formLogin").addClass("animated bounceInLeft");
	//	}
	//error de ajax muestro lo siguiente
	//	$("#botonesABM").html(":(");
	//	$("#informe").html(retorno.responseText);	

	
}

function loginSuccess(retorno){
	if(retorno == "ingreso") {	
		MostarBotones();
		MostarLogin();

		$("#BotonLogin").html("Ir a salir<br>-Sesión-");
		$("#BotonLogin").addClass("btn btn-danger");				
		$("#usuario").val("usuario: " + retorno);
	} 
	else {
		$("#informe").html("usuario o clave incorrecta");	
		$("#formLogin").addClass("animated bounceInLeft");
	}
}

function loginFail(retorno){
	alert(retorno.responseText);
}

function deslogear()
{	
	$.ajax({
		url:"php/deslogearUsuario.php",
		type:"POST"
	})
	.done(function(){
		MostarBotones();
		MostarLogin();
	});
	
	//	url:"php/deslogearUsuario.php",
	//	type:"post"		

}
function MostarBotones()
{	
	$.ajax({
		url:"nexo.php",
		type:"POST",
		data:{
			queHacer:"MostarBotones"
		}
	})
	.done(function(retorno){
		$("#botonesABM").html(retorno);
	});

	//	url:"nexo.php",
	//	type:"post",
	//	data:{queHacer:"MostarBotones"}
}
