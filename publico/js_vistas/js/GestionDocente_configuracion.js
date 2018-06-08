$('#DIVcargas').dialog({
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


$(document).ready(function () {

    $('#rol_grado').change(function () {
        var grado = $(this).val();
        if (grado === 'Seleccione') {
            $("#bandejaNotas").html("Ingrese el Curso...");
            $("#rol_seccion").html("");
            $("#rol_curso").html("");
            $("#rol_nota").html("");
        } else {
            $.post('comboCursoGradoProf', {
                grado: grado
            }, function (data) {
                $('#rol_seccion').html(data);
                $("#rol_curso").html("");
                $("#bandejaNotas").html("Ingrese el Curso...");
            });
        }

    });

    $('#rol_seccion').change(function () {
        var seccion = $(this).val();
        var grado = $('#rol_grado').val();
        if (seccion === '') {
            $("#bandejaNotas").html("Ingrese el Curso...");
            $("#rol_curso").html("");
            $("#rol_nota").html("");
        } else {
            $.post('comboConfiguracion', {
                grado: grado,
                seccion: seccion
            }, function (data) {
                $('#rol_nota').html(data);
                $("#bandejaNotas").html("Ingrese el Curso...");
            });
        }

    });




    $('#rol_nota').change(function () {
        var nota = $(this).val();
        var inicio = $(this).data("fecini");

        var grado = $('#rol_grado').val();
        var curso = $('#rol_seccion').val();
        if (nota === '') {
            $("#bandejaNotas").html("Ingrese el Bimestre...");
        } else {

            $.ajax({
                type: "POST",
                url: "comboConfiguracionNota",
                data: {
                    nota: nota,
                    curso: curso,
                    grado: grado
                },
                success: function (datos) {
                    $('#bandejaNotas').html(datos);
                    return false;
                }
            });
        }
    });


});