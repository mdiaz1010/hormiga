<?php if (($bodyData->results)!=0) {
    ?>
<form name="registroMarca" id="registroMarca" method="POST">
    <table class="table table-bordered" cellspacing="0" width="100%" id="dataTables-asistencia">
        <thead style="color: #fff;background-color: #2A3F54;">
            <tr>
                <th >
                    <center>NRO</center>
                </th>
                <th >
                    <center>ALUMNO</center>
                </th>
                <th >
                    <center>GRADO Y SECCION</center>
                </th>
                <th >
                    <center>FECHA</center>
                </th>
                <th >
                    <center>DOCUMENTO ADJUNTO</center>
                </th>
                <th >
                    <center>RESPUESTA</center>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php $i=1;
    foreach ($bodyData->results as $resultado):?>
            <tr>
                <td >
                    <center>
                        <?=$i?>
                    </center>
                </td>
                <td >
                    <?=$resultado['nombre']?>
                </td>
                <td >
                    <center>
                        <strong>
                            <?=$resultado['grados'].'°'.$resultado['seccio']?>
                        </strong>
                    </center>
                </td>
                <td >
                    <center>
                        <strong>
                            <?=$resultado['fecha']?>
                        </strong>
                    </center>
                </td>
                <td >
                    <center>
                        <a class="ver" data-codigo="<?=$resultado['id']?>" data-mensaje="<?=$resultado['mensaj']?>" title="Ver archivo subido" data-toggle="modal" data-target=".bs-example-modal-lg"  href="javascript:void(0)">
                            <span class="fa fa-search"></span>
                        </a>
                    </center>
                </td>
                <td >
                    <center>
                        <select name="respuesta[]" id="respuesta[]" data-codigo="<?=$resultado['id']?>" data-fecha="<?=$resultado['fecha']?>" data-usu="<?=$resultado['codigo']?>">
                            <option value="">Sin revisar</option>
                            <?php
                                        foreach ($bodyData->resultado as $result) {
                                            $resultado['respuesta']==$result->id?$selected='selected':$selected=''; ?>

                                <option <?=$selected; ?> value="
                                    <?=$result->id?>">
                                        <?=$result->nom_justificada?>
                                </option>
                                <?php
                                        } ?>
                        </select>
                    </center>
                </td>
                <?php  $i++;

    endforeach; ?>
            </tr>
        </tbody>
    </table>
</form>
<?php
} else {
        echo "<div class='alert_result'>No hay registro de inasistencia justificada.</div>";
    } ?>
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Justificacion</h4>
                </div>
                <div class="" id="DIVVERASISTENCIA">

                </div>
                <div class="modal-footer">

                    <button type="button"  data-dismiss="modal" class="btn btn" style="color: #fff;background-color: #2A3F54;">Cerrar</button>
                </div>

            </div>
        </div>
    </div>

    <script type="text/javascript">
        $("#dataTables-asistencia").dataTable();

        $('[id="respuesta[]"]').change(function () {
            var respuesta = $(this).val();
            var codigo = $(this).data("codigo");
            var fecha = $(this).data("fecha");
            var usu = $(this).data("usu");

            $.post("registrarRespuesta", {
                respuesta: respuesta,
                codigo: codigo,
                fecha: fecha,
                usu: usu
            });
                            $.notify("Se registró la respuesta satisfactoriamente", {
                                position: 'b r',
                                className: 'success',
                                autoHideDelay: 10 * 1000,
                                clickToHide: true
                            });
        });
        $(".ver").click(function () {
            var id = $(this).data("codigo");
            var mensaje = $(this).data("mensaje");
            $.ajax({
                type: 'POST',
                url: "verAsistenciaAl",
                data: {
                    id: id,
                    mensaje:mensaje
                },
                success: function (datos) {
                    if (datos.length > 0) {
                        $('#DIVVERASISTENCIA').html(datos);

                    }
                    return false;
                }
            });
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

            //alert(codigo);
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