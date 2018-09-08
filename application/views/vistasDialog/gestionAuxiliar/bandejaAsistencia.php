<?php if ($bodyData->results!=0) {
    ?>
<?php if ((int)$bodyData->contador==0) {
        ?>
<div class="list-group right">
    <button class="btn btn-danger btnMarca"  style="clear: right;">
       Guardar
    </button>
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
            $valor=round($bodyData->porcentaje[$cuentasTemp->id]);
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
                                    <a data-toggle="modal" data-target=".bs-example-modal-lg"  href="javascript:void(0)" class="Detalle" data-alumno="<?=$cuentasTemp->alumno; ?>" data-codigo="<?=$cuentasTemp->id; ?>">
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
        <?php
} else {
        echo "<div class='alert_result'>No se encuentra ningun alumno registrado.</div>";
    } ?>

            <script type="text/javascript">
                    var url = $("#url").val();
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
                        url: url+"GestionAuxiliar/registrarAsistenciaAux",
                        data: $("#registroMarca").serialize(),
                        type: "POST",
                        success: function (data) {
                            $.notify("Se registró la asistencia satisfactoriamente", {
                                position: 'b r',
                                className: 'success',
                                autoHideDelay: 10 * 1000,
                                clickToHide: true
                            });

                            $("#bandejaAsistencia").load("<?= site_url('GestionAuxiliar/comboBandeAsis') ?>", {
                                    grado: $("#id_grado").val(),
                                    seccion: $("#id_seccion").val()
                                });
                                return true;
                        }

                    });

                });

                $(".Detalle").click(function () {
                    var codigo = $(this).data("codigo");
                    var alumno = $(this).data("alumno");

                    var alu = alumno.replace(' ', '-');
                    var alu2 = alu.replace(' ', '-');
                    $.ajax({
                        type: 'POST',
                        url: url+"GestionAuxiliar/verdetalleAlumnoAux",
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