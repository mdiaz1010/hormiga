    var nombre1 = $("#nombre").val();
    $(".asistencia").click(function () {
        var url = $("#url").val();
        $("#cuerpo").load(url + "GestionAuxiliar/asistencia");


    });
    $.ajax({
        type: 'POST',
        url: 'consultarGeneralAux',
        data: {
            nombre: nombre1
        },
        beforeSend: function () {
            $("#bandejaAuxiliar").html("cargando...");
        },
        success: function (data) {
            $("#bandejaAuxiliar").html(data);
        }

    });


    $(".asistencia").click(function () {

    });
    $(".inasistencia").click(function () {
        var codigo = $(this).data("codigo");
        $.ajax({
            type: 'POST',
            url: 'inasistencia',
            data: {
                codigo: codigo
            },
            beforeSend: function () {
                $("#bandejaAuxiliar").html("cargando...");
            },
            success: function (data) {
                $("#bandejaAuxiliar").html(data);
            }

        });
    });
    $(".evasion").click(function () {
        var codigo = $(this).data("codigo");

        $.ajax({
            type: 'POST',
            url: 'evasion',
            data: {
                codigo: codigo
            },
            beforeSend: function () {
                $("#bandejaAuxiliar").html("cargando...");
            },
            success: function (data) {
                $("#bandejaAuxiliar").html(data);
            }

        });
    });
    $(".consulta").click(function () {

        var nombre = $("#nombre").val();
        $.ajax({
            type: 'POST',
            data: {
                nombre: nombre
            },
            url: 'consultarGeneralAux',
            beforeSend: function () {
                $("#bandejaAuxiliar").html("cargando...");
            },
            success: function (data) {
                $("#bandejaAuxiliar").html(data);
            }

        });
    });
    var profesores = [];

    $("input[name='profesores[]']").each(function () {
        var value = $(this).val();
        profesores.push(value);
    });

    $("#nombre").autocomplete({
        source: profesores,
        minLength: 5
    });