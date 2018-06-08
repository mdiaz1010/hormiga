<?php if ($bodyData->results!=0) {
    ?>
<?php if ((int)$bodyData->contador==0) {
        ?>
<div class="list-group right">
    <a class="btn btn-danger btnMarca" href="javascript:" aria-label="Archivo" style="clear: right;">
        <i class="fa fa-floppy-o" aria-hidden="true" style="clear: right;"></i>
    </a>
</div>
<?php
    } else {
        ?>
    <div class="list-group right">
        <h3>
            <small>
                <font style="font-style: italic;">YA SE REALIZO EL REGISTRO DE ASISTENCIA</font>
            </small>
        </h3>
        </a>
    </div>
    <?php
    } ?>
        <form name="registroMarca" id="registroMarca" method="POST">
            <table class="table table-striped table-bordered dt-responsive nowrap  " cellspacing="0" width="100%" id="dataTables-asistencia">
                <thead class="bg-success">
                    <tr>
                        <th style="border: hidden;color: #3b752e;">
                            <center>NRO</center>
                        </th>
                        <th style="border: hidden;color: #3b752e;">
                            <center>ALUMNO</center>
                        </th>
                        <th style="border: hidden;color: #3b752e;">
                            <center>% ASISTENCIA</center>
                        </th>
                        <th style="border: hidden;color: #3b752e;">
                            <center>ASISTENCIA</center>
                        </th>
                        <th style="border: hidden;color: #3b752e;">
                            <center>OPCION</center>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                                            $i=1;
    $j=0;
    foreach ($bodyData->results as $cuentasTemp) {
        if (isset($bodyData->porcentaje[$cuentasTemp->id])==false) {
            $valor='100';
        } else {
            $valor=round($bodyData->porcentaje[$cuentasTemp->id], 2);
        } ?>
                        <tr>
                            <input type="hidden" name="id_grado" id="id_grado" value="<?php echo $bodyData->filtrog; ?>">
                            <input type="hidden" name="id_seccion" id="id_seccion" value="<?php echo $bodyData->filtros; ?>">
                            <input type="hidden" name="txtcodigo[]" id="txtcodigo" value="<?=$cuentasTemp->id; ?>">
                            <td>
                                <CENTER>
                                    <?= $i; ?>
                                </CENTER>
                            </td>
                            <td>
                                <CENTER>
                                    <?=$cuentasTemp->alumno; ?>
                                </CENTER>
                            </td>
                            <td>
                                <CENTER>
                                    <?=$valor; ?> %</CENTER>
                            </td>
                            <td>
                                <CENTER>
                                    <input type="checkbox" name="txtmarcado[]" id="txtmarcado" value="<?=$cuentasTemp->id; ?>"
                                        checked>
                                </CENTER>
                            </td>
                            <td>
                                <CENTER>
                                    <a href="javascript:void(0)" class="Detalle" data-alumno="<?=$cuentasTemp->alumno; ?>" data-codigo="<?=$cuentasTemp->id; ?>">
                                    Ver Detalle</a>
                                </CENTER>
                            </td>
                        </tr>
                        <?php
                                               $i++;
        $j++;
    } ?>

                </tbody>
            </table>
        </form>
        <?php
} else {
        echo "<div class='alert_result'>No se encuentra ningun alumno registrado.</div>";
    } ?>

            <script type="text/javascript">
                $("#dataTables-asistencia").dataTable();

                $(".btnMarca").click(function () {
                    var arrayAlumno = [];
                    var arrayMarcado = [];
                    $("input[name='txtcodigo[]']").each(function () {
                        var value = $(this).val();
                        arrayAlumno.push(value);
                    });
                    $("input[name='txtmarcado[]']:checked").each(function () {
                        var value = $(this).val();
                        arrayMarcado.push(value);

                    });

                    $.ajax({
                        url: "registrarAsistenciaAux",
                        data: $("#registroMarca").serialize(),
                        type: "POST",
                        success: function (data) {
                            window.location.href = "asistencia";
                        }

                    });

                });
                $("#DIVVERDETALLE").dialog({
                    autoOpen: false,
                    hide: "drop",
                    width: 1100,
                    height: 600,
                    closeOnEscape: false,
                    open: function (event, ui) {
                        $(this).closest(".ui-dialog").find(".ui-dialog-titlebar-close").hide();
                    },
                    modal: true,
                    buttons: {
                        "CERRAR": function () {
                            $(this).dialog("close"); //Se cancela operación                              
                        }
                    }
                });
                $("#DIVVERDETALLE").dialog({
                    draggable: false
                });
                $("#DIVVERDETALLE").dialog({
                    resizable: false
                });
                $(".Detalle").click(function () {
                    var codigo = $(this).data("codigo");
                    var alumno = $(this).data("alumno");

                    var alu = alumno.replace(' ', '-');
                    var alu2 = alu.replace(' ', '-');
                    $.ajax({
                        type: 'POST',
                        url: "verdetalleAlumnoAux",
                        data: {
                            codigo: codigo,
                            alu2: alu2
                        },
                        beforeSend: function () {
                            $('#DIVcargas').dialog('open');
                        },
                        success: function (datos) {
                            if (datos.length > 0) {
                                $('#DIVcargas').dialog('close');
                                $('#DIVVERDETALLE').html(datos);
                                $('#DIVVERDETALLE').dialog('open');
                            }
                            return false;
                        }
                    });
                });
            </script>
            <style>
                .right {
                    float: right;

                }

                .left {
                    float: left;

                }

                #centrador {
                    text-align: center;
                    width: 160px;
                    height: 220px;

                }

                #imagen {
                    width: 100px;
                }
            </style>