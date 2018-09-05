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
$(document).ready(function () {
    var url = $("#url").val();

    $('#rol_grado').change(function () {
        var fecha = new Date();
        var ano = fecha.getFullYear();
        var grado = $(this).val();
        if (grado === '') {
            $('#rol_seccion').html('');
            $('#rol_curso').html('');
            $('#rol_bimestre').html('');

            $("#bandejaGeneral").html("Ingrese el tipo de mérito...");
        } else {
            $.post(url + 'GestionEducativa/comboGradoDir', {
                grado: grado
            }, function (data) {
                $('#rol_seccion').html(data);
            });
        }
    });
    $('#rol_seccion').change(function () {
        var seccion = $(this).val();
        var grado = $('#rol_grado').val();
        var merito = 1;
        if (seccion === '') {
            $('#rol_curso').html('');
            $('#rol_bimestre').html('');
            $("#bandejaGeneral").html("Ingrese el tipo de mérito...");
        } else {
            $.post(url + 'GestionEducativa/comboGradoDir', {
                merito: merito,
                grado: grado

            }, function (data) {
                $('#rol_curso').html(data);
            });
        }
    });
    $('#rol_curso').change(function () {
        var curso = $(this).val();
        var ano = "20";
        var grado = $('#rol_grado').val();
        if (curso === '') {
            $('#rol_bimestre').html('');
            $("#bandejaGeneral").html("Ingrese el tipo de mérito...");
        } else {
            $.post(url + 'GestionEducativa/comboGradoDir', {
                ano: ano,
                curso: curso,
                grado: grado
            }, function (data) {
                $('#rol_bimestre').html(data);
            });
        }
    });
    $('#rol_bimestre').change(function () {
        var ano = "20";
        var bimestre = $(this).val();
        var curso = $('#rol_curso').val();
        var seccion = $('#rol_seccion').val();
        var grado = $('#rol_grado').val();
        var merito = 1;
        if (bimestre === '') {
            $("#bandejaGeneral").html("Ingrese el Bimestre...");
        } else {
            $("#DIVcargas").dialog('open');
            $.post(url + 'GestionEducativa/comboBandeGen', {
                ano: ano,
                curso: curso,
                grado: grado,
                seccion: seccion,
                bimestre: bimestre,
                merito: merito
            }, function (data) {
                $("#DIVcargas").dialog('close');
                $("#bandejaGeneral").html(data);
            });
        }
    });
});