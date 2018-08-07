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
                    <center>CURSO</center>
                </th>
                <th >
                    <center>FECHA</center>
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
                    <center>
                        <?=$resultado['cursos']?>
                    </center>
                </td>
                <td >
                    <center>
                        <?=$resultado['fechas']?>
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
        echo "<div class='alert_result'>No hay registro de evasiones.</div>";
    } ?>
    <script type="text/javascript">


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
            });
        });
    </script>