
function MostrarEjemplo(queMuestro){
	
    var pagina = "./administracion.php";
	
    $.ajax({
        type: 'POST',
        url: pagina,
        dataType: "json",
        data: {
		queMuestro : queMuestro
            },
        async: true
    })
	.done(function (objJson) {
		
            if(!objJson.Exito){
                    alert(objJson.Mensaje);
                    return;
            }

            $("#divEjemplo").html(objJson.Html);

	})
    .fail(function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });    
		
}

function MostrarHtml(queMuestro){
	
    var pagina = "./administracion.php";
	
    $.ajax({
        type: 'POST',
        url: pagina,
        dataType: "html",
        data: {
                queMuestro : queMuestro
            },
        async: true
    })
	.done(function (html) {
		
            $("#divEjemplo").html(html);
		
	})
    .fail(function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });    
		
}