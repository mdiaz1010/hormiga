var url = $("#url").val();
$('#rol').change(function () {
    var seleccion = document.getElementById('rol');
    var valor = seleccion.options[seleccion.selectedIndex].value; //coges el valor
    var texto = seleccion.options[seleccion.selectedIndex].text;
    if (valor == 6) {

        document.getElementById('SoloCliente').style.display = 'block';
        //por el contrario, si no esta seleccionada
    } else {
        //oculta el div con id 'desdeotro'
        document.getElementById('SoloCliente').style.display = 'none';
    }

});


//actualizar bandeja
$(".ver_lista_usuario").click(function () {
    $("#list_usuario").hide();
    $("#bandeja_usuario").show();
    $('#bandejaprincipal').html('<center><i id="puestos-load" class="fa fa-circle-o-notch fa-spin" style="font-size:24px;color:#ec7063"></i></center>');
    $('#bandejaprincipal').load(url + 'Cuenta/vistabandeja');
});


//HORARIO CARGA
$('#DIVcargas').dialog({
    autoOpen: false,
    hide: 'drop',
    width: 360,
    height: 80,
    closeOnEscape: false,
    open: function (event, ui) {
        $(".ui-dialog-titlebar-close").hide();
    },
    modal: true
});
$('#DIVcargas').dialog({
    draggable: false
});
$('#DIVcargas').dialog({
    resizable: false
});
$.validator.methods.email = function (value, element) {
    return this.optional(element) || /[a-zA-Z0-9_.+-]+@[a-z]+\.[a-z]+/.test(value);
}
$.validator.methods.documento = function (value, element) {
    $.post(url + "GestionEducativa/validar_documento", {
        documento: value
    }, function (data) {
        valor = data;
    });
    if (valor == "true")
        return false;
    return true;
}
$.validator.addMethod("valueNotEquals", function (value, element, arg) {
    return arg !== value;
}, "Value must not equal arg.");
$.validator.addMethod("maxDate", function (value, element) {
    var curDate = new Date();
    var inputDate = new Date(value);
    if (inputDate < curDate)
        return true;
    return false;
});
jQuery.validator.setDefaults({
    debug: true,
    success: "valid"
});
var url = $("#url").val();
$("#crearusuario").validate({

    rules: {
        apepat: {
            required: true,
            minlength: 6,
            maxlength: 60
        },
        rol: {
            valueNotEquals: "default"
        },
        gradorol: {
            valueNotEquals: "default"
        },
        seccionrol: {
            valueNotEquals: "default"
        },
        usuario: {
            required: true,
            minlength: 6,
            maxlength: 60
        },
        pass: {
            required: true,
            minlength: 6
        },
        pass_repetida: {
            equalTo: "#pass"
        },
        telefono: {
            required: true,
            minlength: 7,
            maxlength: 9,
            number: true
        },
        documento: {
            required: true,
            number: true,
            minlength: 8,
            maxlength: 12,
            documento: true
        },
        email: {
            required: true,
            email: true
        },
        direccion: {
            required: true,
            maxlength: 220
        },


    },
    messages: {
        apepat: {
            required: "Este campo es obligatorio",
            minlength: "Ingresar apellidos y nombres completos",
            maxlength: "Se ha excedido de la capacidad permitida"
        },
        rol: {
            valueNotEquals: "Debe de seleccionar un rol",
            required: "Este campo es obligatorio"
        },
        gradorol: {
            valueNotEquals: "Debe de seleccionar un rol",
            required: "Este campo es obligatorio"
        },
        seccionrol: {
            valueNotEquals: "Debe de seleccionar un rol",
            required: "Este campo es obligatorio"
        },
        usuario: {
            required: "Este campo es obligatorio",
            minlength: "Ingresar un mínimo de 6 caracteres",
            maxlength: "Se ha excedido de la capacidad permitida"
        },
        pass: {
            required: " Este campo es obligatorio",
            minlength: " La contraseña debe de tener como mínimo 6  dígitos"
        },
        pass_repetida: {
            equalTo: "Las contraseñas no coinciden"
        },
        telefono: {
            required: " Este campo es obligatorio",
            minlength: " El telefóno a ingresar debe de contar como mínimo con 7 dígitos",
            maxlength: " El telefóno a ingresar debe de contar como máximo con 9 dígitos",
            number: " Por favor ingresar solo números"
        },
        documento: {
            required: " Este campo es obligatorio",
            minlength: " El documento a ingresar debe de tener como mínimo 8  dígitos",
            maxlength: " El documento a ingresar debe de tener como máximo 12 dígitos",
            documento: " Este documento ya se encuentra registrado",
            number: "Debe ingresar un valor numérico"
        },
        email: {
            required: " Este campo es obligatorio",
            email: " El correo a ingresar debe de tener el siguiente formato name@dominio.com"
        },
        fecha: {
            required: " Este campo es obligatorio",
            date: " La fecha de nacimiento debe de tener el siguiente formato dd/mm/aaaa",
            maxDate: "Ingresar su fecha de nacimiento"
        },
        direccion: {
            required: " Este campo es obligatorio",
            maxlength: "Solo puede ingresar un máximo de 220 caracteres."
        }


    },
    submitHandler: function (form) {

        $("#DIVcargas").dialog("open");
        $.ajax({
            type: "POST",
            url: url + "Cuenta/crear",
            data: $("#crearusuario").serialize(),
            success: function () {
                $("#DIVcargas").dialog("close");

                $("result_error").html("<font color ='green'>REGISTRO CORRECTO</font>");
                $("#bandejaprincipal").load(url + "Cuenta/vistabandeja");
                $("#crearusuario")[0].reset();
                $('#result_error').html("");

                $.notify("Se registró al usuario satisfactoriamente", {
                    position: 'b l',
                    className: 'success',
                    autoHideDelay: 10 * 1000,
                    clickToHide: true
                });
                return false;

            }
        });
    }


});

$("#btnMasivo").click(function () {
    var inputimage = document.getElementById('archiMas'),
        formdata = new FormData();
    var i = 0,
        len = inputimage.files.length,
        img, reader, file;
    for (; i < len; i++) {
        file = inputimage.files[i];
        if (formdata)
            formdata.append('images[]', file);
    }
    $.ajax({
        type: 'POST',
        url: url + "Cuenta/import_data",
        data: formdata,
        processData: false,
        contentType: false,
        beforeSend: function () {
            $("#DIVcargas").dialog("open");
        },
        success: function () {
            $("#DIVcargas").dialog("close");
            $("#bandejaprincipal").load(url + "Cuenta/vistabandeja");
            //location.reload();
        }
    });

});


$("#btnMasivoalu").click(function () {
    var inputimage = document.getElementById('archiMasAlu'),
        formdata = new FormData();
    var i = 0,
        len = inputimage.files.length,
        img, reader, file;
    for (; i < len; i++) {
        file = inputimage.files[i];
        if (formdata)
            formdata.append('images[]', file);
    }
    $.ajax({
        type: 'POST',
        url: url + "Cuenta/import_data_alumnos",
        data: formdata,
        processData: false,
        contentType: false,
        beforeSend: function () {
            $("#DIVcargas").dialog("open");
        },
        success: function () {
            $("#DIVcargas").dialog("close");
            $("#bandejaprincipal").load(url + "Cuenta/vistabandeja");
            //location.reload();
        }
    });

});



$(document).ready(function () {
    $('[name="permisosTrigger"]').click(function ($element) {
        var id = $(this).attr("data-id");
        $("#permisosModal").modal("show");
        cargarData(id);
    });

    function cargarData(id) {

        $.ajax({
            url: url + "Cuenta/permisos",
            method: "POST",
            data: {
                id: id
            },
            dataType: "html"
        }).done(function (msg) { //alert("bien");
            var height = $(window).height() * 0.75;
            var width = $(window).width() * 0.90;
            var modal = $("#permisosModal");
            modal.find('.modal-body').html(msg);
            modal.find(".modal-dialog").css("width", "90%");
            modal.find('.modal-body').css({
                "max-height": height
            });
            var htmlHead = modal.find('.modal-body .nombreUsuario').html();
            modal.find('.modal-footer .nombre').prepend('' + htmlHead + '');
        }).fail(function (jqXHR, textStatus) {
            var msj = "Error de Conexion";
            if (jqXHR.status === 401) {
                msj = "Acceso Denegado";
            }
            var modal = $("#permisosModal");
            modal.find('.modal-body').html("<p> " + msj + " </p>");
        });
    }
});

/*LIMPIEZA */
$(document).ready(function () {

    $('#permisosModal').on('hidden.bs.modal', function (e) {
        /*LIMPIAR DISPARADORES */
        $(this).find('button').unbind();
        $(this).find('.modal-body').html('<center><img src="publico/media/ajax-loader2.gif" width="80" height="80" ></center>');
        $(this).find('.modal-footer .nombre').html('');
    });
});