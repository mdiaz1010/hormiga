$(document).ready(function () {
    $("#error").hide();
    $("#exito").hide();
    $(window).load(function () {
        $(':input:visible:enabled:first').focus();
    });
    $('#DIVcargando').dialog({
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
    $('#DIVcargando').dialog({
        draggable: false
    });
    $('#DIVcargando').dialog({
        resizable: false
    });
    $("#btnEnviar").click(function () {
        var usuario = $("#users").val();
        $.ajax({
            data: {
                users: usuario
            },
            type: "POST",
            dataType: 'json',
            url: "enviar_correo_clave",
            beforeSend: function (datos) {
                $("#DIVcargando").dialog("open");
            },
            success: function (datos) {
                if (datos.correcto == 1) {
                    $("#error").hide();
                    $("#exito").show();
                    $("#DIVcargando").dialog("close");

                } else {
                    $("#exito").hide();
                    $("#error").show();
                    $("#DIVcargando").dialog("close");

                }

            }
        });
    });

    $(document).keypress(function (e) {
        if (e.which == 13) {
            var usuario = $("#users").val();

            $.ajax({
                data: {
                    users: usuario
                },
                type: "POST",
                dataType: 'json',
                url: "enviar_correo_clave",
                beforeSend: function (datos) {
                    $("#DIVcargando").dialog("open");
                },
                success: function (datos) {

                    if (datos.correcto == 1) {
                        $("#error").hide();
                        $("#exito").show();
                        $("#DIVcargando").dialog("close");

                    } else {
                        $("#exito").hide();
                        $("#error").show();
                        $("#DIVcargando").dialog("close");

                    }

                }
            });


        }
    });


});