<div class="panel panel-default">
    <div class="panel-heading">
        <h3>
            <small>
                <font style="font-style: italic;">
                    <?=$bodyData->alumno;?>
                </font>
            </small>
    </div>
</div>
<div class="panel-body">
    <div class="table-responsive">
        <table class="table table-striped table-bordered dt-responsive nowrap " cellspacing="0" width="100%" id="dataTables-asistedet">
            <thead class="bg-success">
                <tr>
                    <th style="border: hidden;color: #3b752e;">
                        <center>NRO</center>
                    </th>
                    <th style="border: hidden;color: #3b752e;">
                        <center>FECHA</center>
                    </th>
                    <th style="border: hidden;color: #3b752e;">
                        <center>ASISTENCIA</center>
                    </th>
                    <th style="border: hidden;color: #3b752e;">
                        <center>MOTIVO</center>
                    </th>
                    <th style="border: hidden;color: #3b752e;">
                        <center>JUSTIFICADO</center>
                    </th>
                </tr>
            </thead>

            <tbody>

                <?php

                                            $i=1;
                                            $j=0;
                                            $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
                                            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
 
                                           
                                            foreach ($bodyData->results as $cuentasTemp) {
                                                if (trim($cuentasTemp->asistencia)=='f') {
                                                    $color='bgcolor="#F78181"';
                                                    //$color='bgcolor="#F7819F"';
                                                } else {
                                                    $color='';
                                                } ?>
                    <tr id="<?=$i?>">
                        <input type="hidden" name="ano[]" id="ano" value="<?=$cuentasTemp->ano?>">
                        <input type="hidden" name="mes[]" id="mes" value="<?=$cuentasTemp->mes?>">
                        <input type="hidden" name="dia[]" id="dia" value="<?=$cuentasTemp->dia?>">
                        <td <?=$color; ?>>
                            <CENTER>
                                <?= $i; ?>
                            </CENTER>
                        </td>
                        <td <?=$color; ?>>
                            <CENTER>
                                <?= $cuentasTemp->dia." de ".$meses[$cuentasTemp->mes-1]; ?>
                            </CENTER>
                        </td>
                        <td <?=$color; ?>>
                            <CENTER>
                                <strong>
                                    <?=strtoupper($cuentasTemp->asistencia); ?>
                                </strong>
                            </CENTER>
                        </td>
                        <td <?=$color; ?>>
                            <CENTER>
                                <textarea rows="2" readonly class="form-control">
                                    <?=$cuentasTemp->mensaje?>
                                </textarea>
                            </CENTER>
                        </td>
                        <td <?=$color; ?>>
                            <CENTER>
                                <?=$cuentasTemp->respuesta?>
                            </CENTER>
                        </td>
                    </tr>
                    <?php
                                               $i++;
                                                $j++;
                                            }
                                            ?>

            </tbody>
        </table>
    </div>
</div>
<script>
    var f = new Date();
    var ano = [];
    var mes = [];
    var dia = [];
    var fechaImprimible = [];
    $("input[name='ano[]']").each(function () {
        var value = $(this).val();
        ano.push(value);
    });
    $("input[name='mes[]']").each(function () {
        var value = $(this).val();
        mes.push(value);
    });
    $("input[name='dia[]']").each(function () {
        var value = $(this).val();
        dia.push(value);
    });

    var estiloDia;
    var meses = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre",
        "Octubre", "Noviembre", "Diciembre");
    var diasSemana = new Array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
    var diasMes = new Array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    var diaMaximo = diasMes[mes];
    for (i = 0; i < ano.length; i++) {
        if (mes[i] === 1 && (((ano[i] % 4 === 0) && (ano[i] % 100 !== 0)) || (ano[i] % 400 === 0)))
            diaMaximo = 29;

        fechaImprimible[i] = dia[i] + " de " + meses[mes[i]];

    }

    //IMPRIMO LA FECHA
</script>
<script type="text/javascript">
    $("#dataTables-asistedet").dataTable();
</script>