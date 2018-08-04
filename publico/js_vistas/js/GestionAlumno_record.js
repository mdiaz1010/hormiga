$('#DIVcargas').dialog({
    autoOpen: false,
    hide: 'drop',
    width: 360,
    height: 80,
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
$('#DIVcargas').dialog({
    draggable: false
});
$('#DIVcargas').dialog({
    resizable: false
});

$(document).ready(function () {
    var url = $("#url").val();
    $('#rol_ano').change(function () {
        var ano = $(this).val();
        if (ano === 'Seleccione') {
            $("#rol_curso").html("");
            $("#bandejaNotasRecord").html("Ingrese el Curso...");
        } else {
            $.post(url + 'GestionAlumno/comboCursoRecord', {
                ano: ano
            }, function (data) {
                $('#rol_curso').html(data);
                $("#bandejaNotasRecord").html("Ingrese el Curso...");
            });
        }
    });

    $('#rol_curso').change(function () {
        var curso = $(this).val();
        var ano = $("#rol_ano").val();

        if (curso === '') {
            $("#bandejaNotasRecord").html("Ingrese el Curso...");
        } else {

            $("#DIVcargas").dialog('open');
            $.post(url + 'GestionAlumno/bandejaNotaRecod', {
                curso: curso,
                ano: ano
            }, function (data) {
                $("#DIVcargas").dialog('close');
                $("#bandejaNotasRecord").html(data);
            });
        }
    });
});