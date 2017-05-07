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

function subirFoto() {

    var url = "./administracion.php";
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

function borrarFoto() {
    var foto = $("#hdnArchivoTemp").val();

    if (foto === "") {
        alert("No hay foto que borrar!!!");
        return;
    }

    $.ajax({
        type: 'POST',
        url: './administracion.php',
        dataType: 'json',
        data: {
            accion: 'borrarFoto',
            foto: foto
        },
        async: true
    })
        .done(function (objJson) {
            if (!objJson.Exito) {
                alert(objJson.Mensaje);
                return;
            }
            $("#divFoto").html("");
            $("#hdnArchivoTemp").val("");
            $("#archivo").val("");

        })
        .fail(function (peticion, textStatus, errorThrown) {
            alert(peticion.responseText + "\n" + textStatus + "\n" + errorThrown);
        });
}



function agregarProducto() {

    var url = "./administracion.php";
    var codBarra = $('#codBarra').val();
    var nombre = $('#nombre').val();
    var archivo = $('#hdnArchivoTemp').val();
    
    var producto = {};
    producto.nombre = nombre;
    producto.codBarra = codBarra;
    producto.archivo = archivo;

    if (!validar(producto)) {
        alert("Debe completar todos los campos!!!");
        return;
    }

     $.ajax({
        type: 'POST',
        url: url,
        dataType: "json",
        data: {
			accion : "agregar",
			producto : producto
		},
        async: true
    })
    .done(function (objJson) {

        if (!objJson.Exito) {
            alert(objJson.Mensaje);
            return;
        }

        alert(objJson.Mensaje);

        // borrarFoto();
        $("#divFoto").html("");
        $("#hdnArchivoTemp").val("");
        $("#archivo").val("");
        $("#codBarra").val("");
        $("#nombre").val("");
        $("#codBarra").removeAttr("readonly");
        mostrarGrilla();
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });
}

function eliminarProducto(producto) {

    if (!confirm("Desea ELIMINAR el producto " + producto.nombre + " ?")) {
        return;
    }

    var url = "./administracion.php";

    $.ajax({
        type: 'POST',
        url: url,
        dataType: "json",
        data: {
            accion: "eliminar",
            producto: producto
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

function editarProducto(prod) {
    var url = "./administracion.php";
    var formData = new FormData();
    formData.append("accion", "cargarDatosAEditar");
    formData.append("pathFoto", prod.pathFoto);

    $("#codBarra").val(prod.codBarra);
    $("#nombre").val(prod.nombre);
    $("#archivo").val("");
    $("#codBarra").attr("readonly", "readonly");

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
        $("#divFoto").html(objJson.HtmlImagen);
        $("#divBotonera").html(objJson.HtmlBotonera);
        $("#hdnArchivoTemp").val(objJson.Path);
        $(".btnEliminar").attr('disabled','disabled');
    })
    .fail(function (peticion, textStatus, errorThrown) {
        alert(peticion.responseText + "\n" + textStatus + "\n" + errorThrown);
    });
}

function cancelarEdicion(path){
    var url = "./administracion.php";
    $("#divFoto").html("");
    $("#hdnArchivoTemp").val("");
    $("#archivo").val("");
    $("#nombre").val("");
    $("#codBarra").val("").removeAttr("readonly");

    $.ajax({
        type: 'POST',
        url: url,
        dataType: "json",
        data: {
            accion: "cancelarEdicion",
            pathFoto: path
        },
        async: true
    })
    .done(function (objJson) {
        $("#divBotonera").html(objJson.Html);
        $(".btnEliminar").removeAttr('disabled');
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });
}

function modificarProducto() {

    var url = "./administracion.php";
    var codBarra = $('#codBarra').val();
    var nombre = $('#nombre').val();
    var archivo = $('#hdnArchivoTemp').val();
    
    var producto = {};
    producto.nombre = nombre;
    producto.codBarra = codBarra;
    producto.archivo = archivo;

    if (!validar(producto)) {
        alert("Debe completar todos los campos!!!");
        return;
    }

     $.ajax({
        type: 'POST',
        url: url,
        dataType: "json",
        data: {
			accion : "modificar",
			producto : producto
		},
        async: true
    })
    .done(function (objJson) {
        if (!objJson.Exito) {
            alert(objJson.Mensaje);
            return;
        }
        alert(objJson.Mensaje);
        // borrarFoto();
        
        $("#divFoto").html("");
        $("#hdnArchivoTemp").val("");
        $("#archivo").val("");
        $("#codBarra").val("");
        $("#nombre").val("");
        $("#codBarra").val("").removeAttr("readonly");
        $("#divBotonera").html(objJson.HtmlBotonera);
        $(".btnEliminar").removeAttr('disabled');

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