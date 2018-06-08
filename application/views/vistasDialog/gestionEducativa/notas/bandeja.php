<?php ?>
<table class="table table-striped table-bordered dt-responsive nowrap  " cellspacing="0" width="100%">
    <thead class="bg-success">
        <tr>
            <th style="border: hidden;color: #3b752e;">
                <center>CODIGO </center>
            </th>
            <th style="border: hidden;color: #3b752e;">
                <center>NOMBRE </center>
            </th>
            <th style="border: hidden;color: #3b752e;">
                <center>DESCRIPCION </center>
            </th>
            <th style="border: hidden;color: #3b752e;">
                <center>PESO </center>
            </th>
            <th style="border: hidden;color: #3b752e;">
                <center>OPCIONES </center>
            </th>
        </tr>
    </thead>
    <tbody>
        <?php  $i=0; foreach ($bodyData->notas as $notas) {
    ?>
        <tr>
            <td>
                <CENTER>NOT000
                    <?=$notas->id  ?>
                </CENTER>
            </td>
            <td>
                <CENTER>
                    <?=$notas->nom_notas  ?>
                </CENTER>
            </td>
            <td>
                <CENTER>
                    <?=$notas->des_notas  ?>
                </CENTER>
            </td>
            <td>
                <CENTER>
                    <?=$notas->pes_notas  ?>
                </CENTER>
            </td>
            <td>
                <CENTER>
                    <a href="javascript:" class="btnEdicionN" data-id="<?=$notas->id?>">Editar</a>
                    <a href="javascript:" class="btnEliminarN" data-ide="<?=$notas->id?>">Eliminar</a>
                </CENTER>
            </td>
        </tr>
        <?php  $i++;
} ?>
    </tbody>
</table>



<div id="DIVELIMINARNOTAS" title="INTRANET EDUCATIVA :: ELIMINAR NOTAS"></div>
<div id="DIVEDITARNOTAS" title="INTRANET EDUCATIVA :: EDITAR   NOTAS"></div>
<script type="text/javascript">
    $(".btnEdicionN").click(function () {
        var id = $(this).data("id");
        $.ajax({
            type: 'POST',
            url: "editarNota",
            data: {
                id: id
            },
            success: function (datos) {
                if (datos.length > 0) {
                    $('#DIVEDITARNOTAS').html(datos);
                    $('#DIVEDITARNOTAS').dialog('open');
                }
                return false;
            }
        });
    });

    $(".btnEliminarN").click(function () {
        var ide = $(this).data("ide");
        $.ajax({
            type: 'POST',
            url: "eliminarBimestre",
            data: {
                ide: ide
            },
            success: function (datos) {
                if (datos.length > 0) {
                    $('#DIVELIMINARNOTAS').html(datos);
                    $('#DIVELIMINARNOTAS').dialog('open');
                }
                return false;
            }
        });
    });


    $("#DIVELIMINARNOTAS").dialog({
        autoOpen: false,
        hide: "drop",
        width: 350,
        height: 150,
        closeOnEscape: false,
        open: function (event, ui) {
            $(this).closest(".ui-dialog").find(".ui-dialog-titlebar-close").hide();
        },
        modal: true,
        buttons: {
            "SI": function () {
                var ide = $("#txtcodigo").val();
                $.ajax({
                    type: 'POST',
                    url: "eliminarNotas",
                    data: {
                        ide: ide
                    },
                    success: function () {
                        $("#DIVNOTAS").load("<?= site_url('GestionEducativa/bandejaNotas/') ?>");
                        //$("#bandejaAula").load("<?= site_url('GestionEducativa/vistabandejaaula/') ?>");                                                                            
                    }
                });

                $(this).dialog("close");
            },

            "NO": function () {
                $(this).dialog("close"); //Se cancela operación

            }
        }
    });

    $("#DIVELIMINARNOTAS").dialog({
        draggable: false
    });
    $("#DIVELIMINARNOTAS").dialog({
        resizable: false
    });


    $("#DIVEDITARNOTAS").dialog({
        autoOpen: false,
        hide: "drop",
        width: 350,
        height: 240,
        closeOnEscape: false,
        open: function (event, ui) {
            $(this).closest(".ui-dialog").find(".ui-dialog-titlebar-close").hide();
        },
        modal: true,
        buttons: {
            "SI": function () {
                $.ajax({
                    type: 'POST',
                    url: "editarNotas",
                    data: $("#editarnotasal").serialize(),
                    success: function () {
                        $("#DIVNOTAS").load("<?= site_url('GestionEducativa/bandejaNotas/') ?>");
                        //$("#bandejaAula").load("<?= site_url('GestionEducativa/vistabandejaaula/') ?>");                                                                            
                    }
                });
                $(this).dialog("close");
            },
            "NO": function () {
                $(this).dialog("close"); //Se cancela operación                              
            }
        }
    });
    $("#DIVEDITARNOTAS").dialog({
        draggable: false
    });
    $("#DIVEDITARNOTAS").dialog({
        resizable: false
    });
</script>