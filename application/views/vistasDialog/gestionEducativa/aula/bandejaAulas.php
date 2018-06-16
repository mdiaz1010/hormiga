<?php ?>

<div class="table-responsive">
    <table class="table table-striped table-bordered dt-responsive nowrap  " cellspacing="0" width="100%" id="dataTables-example">
        <thead class="bg-success">
            <tr>
                <th style="border: hidden;color: #3b752e;">GRADO</th>
                <th style="border: hidden;color: #3b752e;">SECCION</th>
                <th style="border: hidden;color: #3b752e;">CURSO</th>
                <th style="border: hidden;color: #3b752e;">PROFESOR</th>
                <th style="border: hidden;color: #3b752e;">OPCIONES</th>

            </tr>
        </thead>
        <tbody>
            <?php  $i=1;
                                            foreach ($bodyData->vista as $value) {
                                                ?>
            <tr>
                <td>
                    <a data-id="<?php $i ?>" name="cuentaEditorTrigger" href="javascript:void(0)">
                        <?= $value->GRADO?>
                    </a>
                </td>
                <td>
                    <?= $value->SECCION?>
                </td>
                <td>
                    <?= $value->CURSOS?>
                </td>
                <td>
                    <?= $value->PROFESOR?>
                </td>

                <td>

                    <label style="margin-right: 7px;">
                        <i class="fa fa-sticky-note-o"></i>
                        <a href="javascript:" class="btnEliminarA" data-grado="<?=$value->GRADO?>" data-seccion="<?=$value->SECCION?>" data-curso="<?=$value->CURSOS?>">Bloquear</a>
                    </label>
                    <label style="margin-right: 7px;">
                        <i class="fa fa-pencil-square-o"></i>
                        <a href="javascript:" class="btnEdicionA" data-grado="<?=$value->GRADO?>" data-seccion="<?=$value->SECCION?>" data-curso="<?=$value->CURSOS?>">Editar</a>
                    </label>
                </td>
            </tr>
            <?php
                                            $i++;
                                            }
                                            ?>
        </tbody>
    </table>
</div>

<div id="DIVANULARAULA" title="INTRANET EDUCATIVA :: ANULAR AULAS"></div>
<div id="DIVEDITARAULA" title="INTRANET EDUCATIVA :: EDITAR AULAS"></div>
<script type="text/javascript">
    $("#DIVEDITARAULA").dialog({

        autoOpen: false,
        hide: "drop",
        width: 380,
        height: 390,
        closeOnEscape: false,
        open: function (event, ui) {
            $(this).closest(".ui-dialog").find(".ui-dialog-titlebar-close").hide();
        },
        modal: true,
        buttons: {
            "EDITAR": function () {
                $.ajax({
                    type: 'POST',
                    url: "editarAulas",
                    data: $("#editaraulasa1a").serialize(),
                    success: function () {
                        $("#bandejaAula").load(
                            "<?= site_url('GestionEducativa/vistabandejaaula/') ?>");
                    }
                });
                $(this).dialog("close");
            },
            "CANCELAR": function () {
                $(this).dialog("close"); //Se cancela operación
            }
        }
    });
    $("#DIVEDITARAULA").dialog({
        draggable: false
    });
    $("#DIVEDITARAULA").dialog({
        resizable: false
    });

    $("#DIVANULARAULA").dialog({
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
                var curso = $("#txtcursoa").val();
                var grado = $("#txtgradoa").val();
                var seccion = $("#txtsecciona").val();
                $.ajax({
                    type: 'POST',
                    url: "eliminarAulas/",
                    data: {
                        curso: curso,
                        grado: grado,
                        seccion: seccion
                    },
                    success: function () {
                        $("#bandejaprincipal").load(
                            "<?= site_url('GestionEducativa/vistabandejaaulas/') ?>");
                    }
                });


                $(this).dialog("close");
            },
            "NO": function () {
                $(this).dialog("close"); //Se cancela operación
            }
        }
    });
    $("#DIVANULARAULA").dialog({
        draggable: false
    });
    $("#DIVANULARAULA").dialog({
        resizable: false
    });

    $(".btnEliminarA").click(function () {
        var curso = $(this).data("curso");
        var grado = $(this).data("grado");
        var seccion = $(this).data("seccion");
        $.ajax({
            type: 'POST',
            url: "eliminarAula",
            data: {
                curso: curso,
                grado: grado,
                seccion: seccion
            },
            success: function (datos) {
                if (datos.length > 0) {
                    $('#DIVANULARAULA').html(datos);
                    $('#DIVANULARAULA').dialog('open');
                }
                return false;
            }
        });
    });
    $(".btnEdicionA").click(function () {
        var curso = $(this).data("curso");
        var grado = $(this).data("grado");
        var seccion = $(this).data("seccion");
        $.ajax({
            type: 'POST',
            url: "editarAula",
            data: {
                curso: curso,
                grado: grado,
                seccion: seccion
            },
            success: function (datos) {
                if (datos.length > 0) {
                    $('#DIVEDITARAULA').html(datos);
                    $('#DIVEDITARAULA').dialog('open');
                }
                return false;
            }
        });
    });

    $('#dataTables-example').dataTable();
</script>