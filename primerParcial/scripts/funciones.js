$(document).on('ready', function () {
    mostrarGrilla();
});

function mostrarGrilla() {
    var pagina = "./administracion.php";

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

function eliminarUsuario(usuario) {

    if (!confirm("Desea ELIMINAR el usuario " + usuario.nombre + " ?")) {
        return;
    }

    var url = "./administracion.php";

    $.ajax({
        type: 'POST',
        url: url,
        dataType: "json",
        data: {
            accion: "eliminar",
            usuario: usuario
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

function validar(objJson) {
    $valido = true;
    if(objJson.codBarra == "" || objJson.nombre == "" || objJson.archivo == ""){
        $valido = false;
    }
    return $valido;
}