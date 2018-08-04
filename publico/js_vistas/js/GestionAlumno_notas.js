$('#DIVcargas').dialog({
    autoOpen: false,
    hide: 'drop',
    width: 360,
    height: 80,
    closeOnEscape: true,
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

        var ano = $(this).val();

        if (ano === 'Seleccione' || ano === '') {
            $("#bandejaNotasAlu").html("Ingrese el Curso...");
            $('#id_bimestre').html('');
        } else {
            $.post(url + 'GestionAlumno/comboBimeProf', {
                ano: ano,

            }, function (data) {
                $('#id_bimestre').html(data);
                $("#bandejaNotasAlu").html("Ingrese el Curso...");
            });
        }






    });


    $('#id_bimestre').change(function () {
        var ano = $("#rol_grado").val();
        var id_bimestre = $(this).val();
        $("#DIVcargas").dialog("open");
        if (ano === 'Seleccione') {
            $("#bandejaNotasAlu").html("Ingrese el Curso...");
        } else {
            $("#DIVcargas").dialog('open');
            $.post(url + 'GestionAlumno/bandejaNota', {
                ano: ano,
                id_bimestre: id_bimestre
            }, function (data) {
                $("#DIVcargas").dialog('close');
                $("#bandejaNotasAlu").html(data);


            });
        }
    });


});