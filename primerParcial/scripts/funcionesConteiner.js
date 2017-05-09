$(document).on('ready', function () {
    mostrarGrilla();
});

function mostrarGrilla() {
    var pagina = "./administracionConteiner.php";

    $.ajax({
        type: 'POST',
        url: pagina,
        data: { accion: 'mostrarGrilla' },
        dataType: 'html',
        async: true
    })
        .done(function (grilla) {
            $("#divGrilla").html(grilla);
        })
        .fail(function (peticion, textStatus, errorThrown) {
            alert(peticion.responseText + '?n' + textStatus + '\n' + errorThrown);
        })
}

function subirFoto() {

    var url = "./administracionConteiner.php";
    var foto = $('#archivo').val();

    if (foto === "") {
        return;
    }

    var archivo = $('#archivo')[0];
    var formData = new FormData();
    formData.append("archivo", archivo.files[0]);
    formData.append("accion", "subirFoto");

    $.ajax({
        type: 'POST',
        url: url,
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        async: true
    })
        .done(function (objJson) {
            if (!objJson.Exito) {
                alert(objJson.Mensaje);
                return;
            }
            $("#divFoto").html(objJson.Html);
            $("#hdnArchivoTemp").val(objJson.archivoTmp);
        })
        .fail(function (peticion, textStatus, errorThrown) {
            alert(peticion.responseText + "\n" + textStatus + "\n" + errorThrown);
        });

}

function agregarConteiner() {

    var url = "./administracionConteiner.php";
    var numero = $('#numero').val();
    var descripcion = $('#descripcion').val();
    var pais = $('#pais').val();
    var archivo = $('#hdnArchivoTemp').val();
    
    var conteiner = {};
    conteiner.numero = numero;
    conteiner.descripcion = descripcion;
    conteiner.pais = pais;
    conteiner.foto = archivo;

    if (!validar(conteiner)) {
        alert("Debe completar todos los campos!!!");
        return;
    }

     $.ajax({
        type: 'POST',
        url: url,
        dataType: "json",
        data: {
			accion : "agregar",
			conteiner : conteiner
		},
        async: true
    })
    .done(function (objJson) {

        if (!objJson.Exito) {
            alert(objJson.Mensaje);
            return;
        }

        alert(objJson.Mensaje);

        $("#divFoto").html("");
        $("#numero").val("");
        $("#archivo").val("");
        $("#descripcion").val("");
        $("#pais").val("");
        mostrarGrilla();
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });
}

function eliminarConteiner(conteiner) {

    if (!confirm("Desea ELIMINAR el producto " + conteiner.numero + " ?")) {
        return;
    }

    var url = "./administracionConteiner.php";

    $.ajax({
        type: 'POST',
        url: url,
        dataType: "json",
        data: {
            accion: "eliminar",
            conteiner: conteiner
        },
        async: true
    })
        .done(function (objJson) {

            if (!objJson.Exito) {
                alert(objJson.Mensaje);
                return;
            }

            alert(objJson.Mensaje);

            mostrarGrilla();

        })
        .fail(function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
        });
}


function filtrarConteiner() {

    var url = "./administracionConteiner.php";
    var pais = $('#pais').val();

     $.ajax({
        type: 'POST',
        url: url,
        dataType: "json",
        data: {
			accion : "filtrar",
			pais : pais
		},
        async: true
    })
    .done(function (grilla) {
            $("#divGrilla").html(grilla);
        })
    .fail(function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });
}


function validar(objJson) {
    $valido = true;
    if(objJson.codBarra == "" || objJson.nombre == "" || objJson.archivo == ""){
        $valido = false;
    }
    return $valido;
}

