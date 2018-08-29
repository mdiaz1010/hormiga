<?php if (($bodyData->results)!=0) {
    ?>
<form name="registroMarca" id="registroMarca" method="POST">
    <table class="table table-bordered" cellspacing="0" width="100%" id="dataTables-asistencia5">
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
                    <center>CURSO</center>
                </th>
                <th >
                    <center>FECHA</center>
                </th>
                <th >
                    <center>TIPO</center>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php $i=1;
    foreach ($bodyData->results as $resultado): ?>
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
                            <?=$resultado['grados']?>
                        </strong>
                    </center>
                </td>
                <td >
                    <center>
                        <?=$resultado['cursos']?>
                    </center>
                </td>
                <td >
                    <center>
                        <?=$resultado['fechas']?>
                    </center>
                </td>
                <td>
                    <center>
                        <select name="respuesta[]" id="respuesta[]" class="form-control" data-grado="<?=$resultado['id_grado']?>" data-seccion="<?=$resultado['id_seccion']?>"
                            data-curso="<?=$resultado['id_curso']?>" data-alumno="<?=$resultado['id_alumno']?>" data-id="<?=$resultado['id']?>"
                            data-fecha="<?=$resultado['fechas']?>">
                            <option value="0">Sin revisar</option>
                            <?php
                                        foreach ($bodyData->resultado as $result) {
                                            if ($resultado['respuesta']==$result->id) {
                                                $selected='selected';
                                            } else {
                                                $selected="";
                                            }
                                            if ($result->id==1) {
                                                $valor="EVASION";
                                            } elseif ($result->id==2) {
                                                $valor="JUSTIFICADO";
                                            } else {
                                                $valor="Sin revisar";
                                            } ?>
                                <option <?=$selected?> value="
                                    <?=$result->id?>">
                                        <?=$valor?>
                                </option>
                                <?php
                                        } ?>
                        </select>
                    </center>
                </td>

            </tr>
            <?php $i++;
    endforeach; ?>
        </tbody>
    </table>
</form>
<?php
} else {
        echo "<div class='alert_result'>No hay registro de evasión justificada.</div>";
    } ?>
    <script type="text/javascript">
        $("#dataTables-asistencia5").dataTable();

        $('[id="respuesta[]"]').change(function () {


            var tipo = $(this).val();
            var grado = $(this).data("grado");
            var seccion = $(this).data("seccion");
            var curso = $(this).data("curso");
            var alumno = $(this).data("alumno");
            var codigo = $(this).data("id");
            var fecha = $(this).data("fecha");


            $.post("registrarObservacion", {
                codigo: codigo,
                tipo: tipo,
                grado: grado,
                seccion: seccion,
                curso: curso,
                alumno: alumno,
                fecha: fecha
            },function(data){
                            $.notify("Se envió la respuesta satisfactoriamente", {
                                position: 'b r',
                                className: 'success',
                                autoHideDelay: 10 * 1000,
                                clickToHide: true
                            });
            });
        });
    </script>