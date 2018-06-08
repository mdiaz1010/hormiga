<?php if (($bodyData->results)!=0) {
    ?>
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
                    <center>GRADO Y SECCION</center>
                </th>
                <th style="border: hidden;color: #3b752e;">
                    <center>FECHA</center>
                </th>
                <th style="border: hidden;color: #3b752e;">
                    <center>MENSAJE</center>
                </th>
                <th style="border: hidden;color: #3b752e;">
                    <center>DOCUMENTO ADJUNTO</center>
                </th>
                <th style="border: hidden;color: #3b752e;">
                    <center>RESPUESTA</center>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php $i=1;
    foreach ($bodyData->results as $resultado):?>
            <tr>
                <td style="width:2px;">
                    <center>
                        <?=$i?>
                    </center>
                </td>
                <td style="width:100px;">
                    <?=$resultado['nombre']?>
                </td>
                <td style="width:1px;">
                    <center>
                        <strong>
                            <?=$resultado['grados'].'°'.$resultado['seccio']?>
                        </strong>
                    </center>
                </td>
                <td style="width:5px;">
                    <center>
                        <strong>
                            <?=$resultado['fecha']?>
                        </strong>
                    </center>
                </td>
                <td>
                    <center>
                        <textarea readonly class="form-control" style="width:500px;" rows="1">
                            <?=$resultado['mensaj']?>
                        </textarea>
                    </center>
                </td>
                <td style="width:1px;">
                    <center>
                        <a class="ver" data-codigo="<?=$resultado['id']?>" title="Ver archivo subido" href="javascript:">
                            <span class="fa fa-search"></span>
                        </a>
                    </center>
                </td>
                <td style="width:1px;">
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
    <div id="DIVVERASISTENCIA" title="INTRANET EDUCATIVA :: ARCHIVO SUBIDO"></div>
    <script type="text/javascript">
        $("#dataTables-asistencia").dataTable();
        $("#DIVVERASISTENCIA").dialog({
            autoOpen: false,
            hide: "drop",
            width: 600,
            height: 390,
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

        $("#DIVVERASISTENCIA").dialog({
            draggable: false
        });
        $("#DIVVERASISTENCIA").dialog({
            resizable: false
        });
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

        });
        $(".ver").click(function () {
            var id = $(this).data("codigo");

            $.ajax({
                type: 'POST',
                url: "verAsistenciaAl",
                data: {
                    id: id
                },
                success: function (datos) {
                    if (datos.length > 0) {
                        $('#DIVVERASISTENCIA').html(datos);
                        $('#DIVVERASISTENCIA').dialog('open');
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