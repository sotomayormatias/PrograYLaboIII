
function MostrarError()
{
	$.ajax({
		url: "nexoNoExiste.php",
		type: "POST"
	})
	.then(funcionExito, funcionError);

	// alert("error");
	//url:"nexoNoExiste.php",type:"post"
}

function funcionExito(retorno){
	// console.info(retorno);
	$("#principal").html(retorno);
	$("#informe").html("CORRECTO :)");
}

function funcionError(retorno){
	// console.info(retorno);
	$("#informe").html(retorno.responseText);
	$("#principal").html("ERROR :'(");
}

function MostrarSinParametros()
{
	//url:"nexoTexto.php"});
	$.ajax({
		url: "nexoTexto.php",
		type: "POST"
	})
	.then(funcionExito, funcionError);
}

function Mostrar(queMostrar)
{
	// alert(queMostrar);
	//url:"nexo.php",
	//type:"post",

	$.ajax({
		url: "nexo.php",
		type: "POST",
		data: {
			queHacer: queMostrar
		} 
	})
	.then(funcionExito, funcionError);
}

function MostarLogin()
{
		//alert(queMostrar);
	var funcionAjax=$.ajax({
		url:"nexo.php",
		type:"post",
		data:{queHacer:"MostarLogin"}
	});

	// El then es nativo de javascript
	funcionAjax.then(funcionExito, funcionError);

	//el then hace lo mismo que el .done y el .fail, solo que estos dos son de jQuery
	
	// funcionAjax.done(function(retorno){
	// 	$("#principal").html(retorno);
	// 	$("#informe").html("Correcto Form login!!!");	
	// });
	// funcionAjax.fail(function(retorno){
	// 	$("#botonesABM").html(":(");
	// 	$("#informe").html(retorno.responseText);	
	// });
	// funcionAjax.always(function(retorno){
	// 	//alert("siempre "+retorno.statusText);
	// });
}