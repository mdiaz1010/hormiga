var url = $("#url").val();
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


        $('#rol_grado').change(function () {
                var grado = $(this).val();
                if (grado === 'Seleccione') {
                        $("#bandejaNotas").html("Ingrese el Curso...");
                        $("#rol_seccion").html("");
                        $("#rol_curso").html("");
                } else {
                        $.post(url + 'GestionDocente/comboSeccionProf', {
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
                } else {
                        $.post(url + 'GestionDocente/comboCursoProf', {
                                grado: grado,
                                seccion: seccion
                        }, function (data) {
                                $('#rol_curso').html(data);
                                $("#bandejaNotas").html("Ingrese el Curso...");
                        });
                }

        });

        $('#rol_curso').change(function () {
                var curso = $(this).val();
                var grado = $('#rol_grado').val();
                var seccion = $('#rol_seccion').val();
                if (curso === '') {
                        $("#bandejaNotas").html("Ingrese el Curso...");
                } else {
                        $.post(url + 'GestionDocente/comboBimeProf', {
                                grado: grado,
                                seccion: seccion,
                                curso: curso
                        }, function (data) {
                                $('#rol_bimestre').html(data);
                                $("#bandejaNotas").html("Ingrese el Curso...");
                        });
                }
        });


        $('#rol_bimestre').change(function () {
                var bimestre = $(this).val();
                $("#DIVcargas").dialog('open');
                var inicio = $(this).data("fecini");
                var curso = $('#rol_curso').val();
                var grado = $('#rol_grado').val();
                var seccion = $('#rol_seccion').val();
                if (bimestre === '') {
                        $("#bandejaNotas").html("Ingrese el Bimestre...");
                        $("#DIVcargas").dialog('close');
                } else {

                        $.ajax({
                                type: "POST",
                                url: url + 'GestionDocente/comboBandeNota',
                                data: {
                                        bimestre: bimestre,
                                        curso: curso,
                                        grado: grado,
                                        seccion: seccion
                                },
                                success: function (datos) {
                                        $("#DIVcargas").dialog('close');
                                        $('#bandejaNotas').html(datos);
                                }
                        });
                }
        });


});