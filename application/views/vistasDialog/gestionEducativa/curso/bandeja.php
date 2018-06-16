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
                <center>CANT. HORAS </center>
            </th>
            <th style="border: hidden;color: #3b752e;">
                <center>CANT. CAPACIDADES</center>
            </th>
            <th style="border: hidden;color: #3b752e;">
                <center>OPCIONES </center>
            </th>
        </tr>
    </thead>
    <tbody>
        <?php  $i=0; foreach ($bodyData->cursos as $curso) {
    ?>
        <tr>
            <td>
                <CENTER>CUR000
                    <?=$curso->id  ?>
                </CENTER>
            </td>
            <td>
                <CENTER>
                    <?=$curso->nom_cursos  ?>
                </CENTER>
            </td>
            <td>
                <CENTER>
                    <?=$curso->des_cursos  ?>
                </CENTER>
            </td>
            <td>
                <CENTER>
                    <?=$curso->cant_horas  ?>
                </CENTER>
            </td>
            <td>
                <CENTER>
                    <?=$curso->cant_capacidades  ?>
                </CENTER>
            </td>
            <td>
                <CENTER>
                    <a href="javascript:" class="btnEdicion" data-id="<?=$curso->id?>">Editar</a>
                    <a href="javascript:" class="btnEliminar" data-ide="<?=$curso->id?>">Eliminar</a>
                </CENTER>
            </td>
        </tr>
        <?php  $i++;
} ?>
    </tbody>
</table>



<div id="DIVELIMINARCURSO" title="INTRANET EDUCATIVA :: ELIMINAR CURSOS"></div>
<div id="DIVEDITARCURSO" title="INTRANET EDUCATIVA :: EDITAR   CURSOS"></div>
<script type="text/javascript">
    $("#dataTables-cursos").DataTable();
    $(".btnEdicion").click(function () {
        var id = $(this).data("id");
        $.ajax({
            type: 'POST',
            url: "editarCurso",
            data: {
                id: id
            },
            success: function (datos) {
                if (datos.length > 0) {
                    $('#DIVEDITARCURSO').html(datos);
                    $('#DIVEDITARCURSO').dialog('open');
                }
                return false;
            }
        });
    });

    $(".btnEliminar").click(function () {
        var ide = $(this).data("ide");
        $.ajax({
            type: 'POST',
            url: "eliminarCurso",
            data: {
                ide: ide
            },
            success: function (datos) {
                if (datos.length > 0) {
                    $('#DIVELIMINARCURSO').html(datos);
                    $('#DIVELIMINARCURSO').dialog('open');
                }
                return false;
            }
        });
    });


    $("#DIVELIMINARCURSO").dialog({
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
                    url: "eliminarCursos/" + ide,
                    data: $("#editarcursosal").serialize(),
                    success: function () {
                        $("#DIVCURSO").load("<?= site_url('GestionEducativa/bandejaCurso/') ?>");
                        $("#bandejaAula").load(
                            "<?= site_url('GestionEducativa/vistabandejaaula/') ?>");
                    }
                });

                $(this).dialog("close");
            },

            "NO": function () {
                $(this).dialog("close"); //Se cancela operación

            }
        }
    });

    $("#DIVELIMINARCURSO").dialog({
        draggable: false
    });
    $("#DIVELIMINARCURSO").dialog({
        resizable: false
    });


    $("#DIVEDITARCURSO").dialog({
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
                    url: "editarCursos",
                    data: $("#editarcursosal").serialize(),
                    success: function () {
                        $("#DIVCURSO").load("<?= site_url('GestionEducativa/bandejaCurso/') ?>");
                        $("#bandejaAula").load(
                            "<?= site_url('GestionEducativa/vistabandejaaula/') ?>");
                    }
                });
                $(this).dialog("close");
            },
            "NO": function () {
                $(this).dialog("close"); //Se cancela operación
            }
        }
    });
    $("#DIVEDITARCURSO").dialog({
        draggable: false
    });
    $("#DIVEDITARCURSO").dialog({
        resizable: false
    });
</script>