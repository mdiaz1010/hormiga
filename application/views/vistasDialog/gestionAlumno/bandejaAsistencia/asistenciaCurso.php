<table class="table table-bordered" cellspacing="0" width="100%" id="dataTables-asistedet">
    <thead style="color: #fff;background-color: #2A3F54;">
        <tr>
            <th >
                <center>NRO</center>
            </th>
            <th >
                <center>FECHA</center>
            </th>
            <th >
                <center>ASISTENCIA</center>
            </th>
            <th>
                <center>OBSERVACION</center>
            </th>
        </tr>
    </thead>
    <tbody>
        <?php
                                            $i=1;
                                            $j=0;
                                            $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
                                            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                                           if ($bodyData->curso=='total') {
                                               $hidden1='';
                                           } else {
                                               $hidden1='hidden';
                                           }
                                            foreach ($bodyData->results as $cuentasTemp) {
                                                if (trim($cuentasTemp->asistencia)=='f') {
                                                    $color='bgcolor="#F8E0E0"';
                                                    $readonly='';
                                                    $hidden='';
                                                    $estilo='';
                                                    //$color='bgcolor="#F7819F"';
                                                } else {
                                                    $color='';
                                                    $readonly='readonly';
                                                    $hidden='hidden';
                                                    $estilo="<td></td>";
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
            <?=$estilo; ?>
                <td <?=$hidden?>
                    <?=$color; ?> >
                        <center>
                           <a data-toggle="modal" data-target=".bs-example6-modal-lg" href="javascript:" ><span class="fa fa-search"></span></a>

                        </center>
                </td>


        </tr>

        <?php
                                               $i++;
                                                $j++;
                                            }
                                            ?>

    </tbody>
</table>
   <div class="modal fade bs-example6-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Observacion</h4>
              </div>
              <div class="modal-body"  title="INTRANET EDUCATIVA :: SUBIR ARCHIVOS ">
                    <?=trim($cuentasTemp->mensaje)?>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              </div>

            </div>
          </div>
        </div>
<script type="text/javascript">




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