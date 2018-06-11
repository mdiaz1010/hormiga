<?php if (count($bodyData->results)>0) {
    ?>
<form name="registroMarca" id="registroMarca" method="POST">
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
            <table class="table table-bordered" cellspacing="0" width="100%" id="dataTables-asistencia">
                <thead style="color: #fff;background-color: #2A3F54;">
                    <tr class="heading">
                        <th>
                            <center>NRO</center>
                        </th>
                        <th>
                            <center>ALUMNO</center>
                        </th>
                        <th>
                            <center>% ASISTENCIA</center>
                        </th>
                        <th>
                            <center>ASISTENCIA</center>
                        </th>
                        <th>
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
                            <input type="hidden" name="id_curso" id="id_curso" value="<?php echo $bodyData->filtroc; ?>">
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
                                    <input type="checkbox" name="txtmarcado[]" id="txtmarcado" value="<?=$cuentasTemp->id; ?>" checked>
                                </CENTER>
                            </td>
                            <td>
                                <CENTER>
                                    <a data-toggle="modal" data-target=".bs-example-modal-lg" href="javascript:" class="Detalle" data-curso="<?php echo $bodyData->filtroc; ?>" data-alumno="<?=$cuentasTemp->alumno; ?>"
                                        data-codigo="<?=$cuentasTemp->id; ?>"> Ver Detalle</a>
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


<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Historial de asistencia</h4>
            </div>
            <div class="modal-body" id="DIVVERDETALLE">

            </div>
            <div class="modal-footer">

                <button type="button"  data-dismiss="modal" class="btn btn" style="color: #fff;background-color: #2A3F54;">Cerrar</button>
            </div>

        </div>
    </div>
</div>
<div id="DIVcargando" title="EN PROCESO">
    <center>
        <strong>Espere estamos cargando la informacion...</strong>
        <span class="fa fa-spinner fa-pulse fa-2x fa-fw"></span>
    </center>
</div>
<?php
} else {
        echo "<div class='alert_result'>No se encuentra ningun alumno registrado.</div>";
    } ?>
    <script type="text/javascript">
        $('#DIVcargando').dialog({
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
        $('#DIVcargando').dialog({
            draggable: false
        });
        $('#DIVcargando').dialog({
            resizable: false
        });

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
                url: "registrarAsitencia",
                data: $("#registroMarca").serialize(),
                type: "POST",
                beforeSend: function () {
                    $('#DIVcargando').dialog('open');
                },
                success: function () {
                    $('#DIVcargando').dialog('close');
                    window.location.href = "reportPrincipal";
                }
            });
        });

        $(".Detalle").click(function () {
            var codigo = $(this).data("codigo");
            var alumno = $(this).data("alumno");
            var curso = $(this).data("curso");
            var alu = alumno.replace(' ', '-');
            var alu2 = alu.replace(' ', '-');
            $.ajax({
                type: 'POST',
                url: "verdetalleAlumno",
                data: {
                    codigo: codigo,
                    alu2: alu2,
                    curso: curso
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
    <script>
        $("#dataTables-asistencia").dataTable();
    </script>