//actualizar bandeja

$.ajax({
    type: "POST",
    url: "vistabandejaaulas",
    success: function (datos) {
        $('#bandejaprincipal').html(datos);
        return false;
    }
});



//actualizar bandeja
$.ajax({
    type: "POST",
    url: "vistabandejaaula",
    success: function (datos) {
        $('#bandejaAula').html(datos);
        return false;
    }
});
/*
 * Creacion de Dialog
 *
 *
 */
//POP UP QUE SE MOSTRARA PREVIO A CARGAR EL POP UP PRINCIPAL

$('#DIVcarga').dialog({
    autoOpen: false,
    hide: 'drop',
    width: 300,
    height: 150,
    closeOnEscape: false,
    open: function (event, ui) {
        $(".ui-dialog-titlebar-close").hide();
    },
    modal: true,
    buttons: {
        "CERRAR": function () {
            $(this).dialog("close");
        }
    }
});
$('#DIVcarga').dialog({
    draggable: false
});
$('#DIVcarga').dialog({
    resizable: false
});


//

$('#ContainerProd').dialog({
    autoOpen: false,
    width: 1200,
    height: 600,
    modal: true,
    closeOnEscape: false,
    open: function (event, ui) {
        $(".ui-dialog-titlebar-close").hide();
    },
    buttons: {
        "CERRAR": function () {
            $(this).dialog("close");
        }
    }
});
$('#ContainerProd').dialog({
    draggable: false
});
$('#ContainerProd').dialog({
    resizable: false
});


$('#ContainerGrado').dialog({
    autoOpen: false,
    width: 520,
    height: 500,
    modal: true,
    closeOnEscape: false,
    open: function (event, ui) {
        $(".ui-dialog-titlebar-close").hide();
    },
    buttons: {
        "CERRAR": function () {
            $(this).dialog("close");
        }
    }
});
$('#ContainerGrado').dialog({
    draggable: false
});
$('#ContainerGrado').dialog({
    resizable: false
});

$('#ContainerSeccion').dialog({
    autoOpen: false,
    width: 520,
    height: 500,
    modal: true,
    closeOnEscape: false,
    open: function (event, ui) {
        $(".ui-dialog-titlebar-close").hide();
    },
    buttons: {
        "CERRAR": function () {
            $(this).dialog("close");
        }
    }
});
$('#ContainerSeccion').dialog({
    draggable: false
});
$('#ContainerSeccion').dialog({
    resizable: false
});

$('#ContainerBimestre').dialog({
    autoOpen: false,
    width: 520,
    height: 500,
    modal: true,
    closeOnEscape: false,
    open: function (event, ui) {
        $(".ui-dialog-titlebar-close").hide();
    },
    buttons: {
        "CERRAR": function () {
            $(this).dialog("close");
        }
    }
});
$('#ContainerBimestre').dialog({
    draggable: false
});
$('#ContainerBimestre').dialog({
    resizable: false
});

$('#ContainerNotas').dialog({
    autoOpen: false,
    width: 520,
    height: 500,
    modal: true,
    closeOnEscape: false,
    open: function (event, ui) {
        $(".ui-dialog-titlebar-close").hide();
    },
    buttons: {
        "CERRAR": function () {
            $(this).dialog("close");
        }
    }
});
$('#ContainerNotas').dialog({
    draggable: false
});
$('#ContainerNotas').dialog({
    resizable: false
});

//---------------------------------------------------------

$('#ContainerCurso').dialog({
    autoOpen: false,
    width: 700,
    height: 500,
    modal: true,
    closeOnEscape: true,
    open: function (event, ui) {
        $(".ui-dialog-titlebar-close").hide();
    },
    buttons: {
        "CERRAR": function () {
            $(this).dialog("close");
        }
    }
});
$('#ContainerCurso').dialog({
    draggable: false
});
$('#ContainerCurso').dialog({
    resizable: false
});


//popup usuario
$('[name="cuentaEditorTrigger"]').click(function ($element) {
    var id = $(this).attr("data-id");
    enviarData(id);
});

function enviarData(id) {
    $('#ContainerProd').html('Cargando...');
    $.ajax({
        type: "POST",
        url: 'registrarEmpresa/' + id,
        data: $("#crearcliente").serialize(),
        beforeSend: function (datos) {
            $('#DIVcarga').dialog('open');
        },
        success: function (datos) {
            $('#DIVcarga').dialog('close');
            $('#ContainerProd').html(datos);
            if (datos.length > 0) {
                $('#ContainerProd').dialog('open');
            }
            return false;
        }
    });
}

//tablas
$('#dataTables-example').dataTable();

//boton GRADO
$("#btn_grado").click(function () {
    $('#ContainerGrado').html('Cargando...');
    $.ajax({
        type: "POST",
        url: 'mostrarGrado/',
        beforeSend: function (datos) {
            $('#DIVcarga').dialog('open');
        },
        success: function (datos) {
            $('#DIVcarga').dialog('close');
            $('#ContainerGrado').html(datos);
            $('#ContainerGrado').dialog('open');

            return false;
        }
    });
});
// boton SECCION
$("#btn_seccion").click(function () {
    $('#ContainerSeccion').html('Cargando...');
    $.ajax({
        type: "POST",
        url: 'mostrarSeccion/',
        beforeSend: function (datos) {
            $('#DIVcarga').dialog('open');
        },
        success: function (datos) {
            $('#DIVcarga').dialog('close');
            $('#ContainerSeccion').html(datos);
            $('#ContainerSeccion').dialog('open');

            return false;
        }
    });
});

// boton curso

$("#btn_cursos").click(function () {
    $('#ContainerCurso').html('Cargando...');
    $.ajax({
        type: "POST",
        url: 'mostrarCurso/',
        beforeSend: function (datos) {
            $('#DIVcarga').dialog('open');
        },
        success: function (datos) {
            $('#DIVcarga').dialog('close');
            $('#ContainerCurso').html(datos);
            $('#ContainerCurso').dialog('open');

            return false;
        }
    });
});
$("#btn_bimestre").click(function () {
    $('#ContainerBimestre').html('Cargando...');
    $.ajax({
        type: "POST",
        url: 'mostrarBimestre/',
        beforeSend: function (datos) {
            $('#DIVcarga').dialog('open');
        },
        success: function (datos) {
            $('#DIVcarga').dialog('close');
            $('#ContainerBimestre').html(datos);
            $('#ContainerBimestre').dialog('open');

            return false;
        }
    });
});
$("#btn_notas").click(function () {
    $('#ContainerNotas').html('Cargando...');
    $.ajax({
        type: "POST",
        url: 'mostrarNotas/',
        beforeSend: function (datos) {
            $('#DIVcarga').dialog('open');
        },
        success: function (datos) {
            $('#DIVcarga').dialog('close');
            $('#ContainerNotas').html(datos);
            $('#ContainerNotas').dialog('open');

            return false;
        }
    });
});

$(".registrar_aulas").click(function () {

    var profesor = $("#profesor").val();
    if (profesor == '') {
        $('#result_errors').show();
        return true;
    } else {
        $.ajax({
            type: 'POST',
            data: $("#registraraula").serialize(),
            url: "registrarAula",
            beforeSend: function (datos) {
                $('#DIVcarga').dialog('open');
            },
            success: function (datos) {
                if (datos == '"success"') {

                    $('#result_success').show();
                    $('#result_errors').hide();
                    $('#DIVcarga').dialog('close');
                    //   location.reload();
                    $("#bandejaAula").load("vistabandejaaula");
                    $("#bandejaprincipal").load("vistabandejaaulas");
                    return false;
                } else {
                    $('#result_errors').show();
                    $('#result_success').hide();
                    $('#DIVcarga').dialog('close');
                }
            }


        });

    }
});