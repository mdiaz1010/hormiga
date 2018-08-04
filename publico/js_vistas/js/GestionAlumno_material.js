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
    $('#rol_curso').change(function () {
        if ($(this).val() === '') {
            $("#bandejaMaterialAlumno").html("Ingrese el bimestre...");
            $("#rol_bimestre").html("");
        } else {
            $.post(url + 'GestionAlumno/comboBimeAlu', {}, function (data) {
                $('#rol_bimestre').html(data);
                $("#bandejaMaterialAlumno").html("Ingrese el bimestre...");
            });

        }
    });
    $('#rol_bimestre').change(function () {
        var grado = $("#txtgrado").val();
        var seccion = $("#txtseccion").val();
        var curso = $("#rol_curso").val();
        var bimestre = $(this).val();

        if (curso !== 'Seleccione') {
            $.post(url + 'GestionAlumno/comboBandeMate', {
                curso: curso,
                grado: grado,
                seccion: seccion,
                bimestre: bimestre
            }, function (data) {
                if (bimestre.length > 0) {
                    $("#bandejaMaterialAlumno").html(data);

                } else {
                    $("#bandejaMaterialAlumno").html("Ingrese el bimestre...");

                }
            });
        } else {
            document.getElementById('materialAlumno').style.display = 'none';
        }


    });
});