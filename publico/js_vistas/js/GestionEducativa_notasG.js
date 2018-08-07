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
        $('#rol_ano').change(function () {
                var ano = $(this).val();
                if (ano === 'Seleccione') {
                        $('#rol_grado').html('');
                        $('#rol_bimestre').html('');
                        $("#bandejaGeneral").html("Ingrese el Bimestre...");
                } else {

                        $.post(url + 'GestionEducativa/comboAnoDir', {
                                ano: ano
                        }, function (data) {
                                $('#rol_grado').html(data);
                        });
                }
        });
        $('#rol_grado').change(function () {
                var ano = $('#rol_ano').val();
                var grado = $(this).val();
                if (grado === '') {
                        $('#rol_bimestre').html('');
                        $("#bandejaGeneral").html("Ingrese el Bimestre...");
                } else {
                        $.post(url + 'GestionEducativa/comboGradoDir', {
                                ano: ano
                        }, function (data) {
                                $('#rol_bimestre').html(data);
                        });
                }
        });
        $('#rol_bimestre').change(function () {
                var bimestre = $(this).val();
                var ano = $('#rol_ano').val();
                var grado = $('#rol_grado').val();
                if (bimestre === '') {
                        $("#bandejaGeneral").html("Ingrese el Bimestre...");
                } else {
                        $("#DIVcargas").dialog('open');
                        $.post(url + 'GestionEducativa/comboBandeGen', {
                                ano: ano,
                                grado: grado,
                                bimestre: bimestre
                        }, function (data) {
                                $("#DIVcargas").dialog('close');
                                $("#bandejaGeneral").html(data);
                        });
                }
        });
});