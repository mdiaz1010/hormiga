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
            <th >
                <center>MOTIVO</center>
            </th>
            <th >
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
                            //$color='bgcolor="#F7819F"';
                        } else {
                            $color='';
                            $readonly='readonly';
                            $hidden='hidden';
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
            <td <?=$readonly; ?>
                <?=$color; ?>>
                    <center>

                        <a data-toggle="modal" data-target=".bs-example-modal-lg" <?=$hidden; ?>
                            <?=$hidden1?> class="edita" data-codigo="<?=$cuentasTemp->id?>" data-fecha="<?=$cuentasTemp->fecha_val?>" title="Subir archivo" href="#">
                                        <span class="fa fa-edit"></span>
                        </a>
                    </center>
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



<div class="modal fade bs-example1-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Ver justificación</h4>
      </div>

      <div class="modal-body" id="DIVVERASISTENCIA">

      </div>
      <div class="modal-footer">

        <button name="btnNo" id="btnNo" type="button" class="btn btn-primary" data-dismiss="modal">CERRAR</button>
      </div>

    </div>
  </div>
</div>

<div class="modal fade bs-example-modal-lg" id="subir_justificacion" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Subir justificación</h4>
      </div>
      <div class="modal-body" id="DIVEDITARASISTENCIA1">
      <div id="mensaje"></div>
      </div>

      <div class="modal-footer">
        <button name="btnSi" id="btnSi" type="button" class="btn btn-default" >SI</button>
        <button name="btnNo" id="btnNo" type="button" class="btn btn-primary" data-dismiss="modal">NO</button>
      </div>

    </div>
  </div>
</div>
<script type="text/javascript">


$("#btnSi").click(function(){

    var DocAdj = $("#docAdj").val();


                    var inputimage = document.getElementById('docAdj'),

                        formdata = new FormData();
                        var i = 0,
                        len = inputimage.files.length,
                        img, reader, file;
                    document.getElementById('response').innerHTML = 'Subiendo...';
                    for (; i < len; i++)
                    {
                        file = inputimage.files[i];
                        if (formdata)
                            formdata.append('images[]', file);
                    }
                    var txtid = $("#txtid").val();
                    var txtfec = $("#txtfec").val();
                    var txtarchivo = $("#txtarchivo").val();
                    var mensaje = $("#mensaje").val();
                    if(mensaje ==''){
                        alert("El campo Mensaje* es obligatorio"); return true;
                    }
                    formdata.append('txtid', txtid);
                    formdata.append('txtfec', txtfec);
                    formdata.append('txtarchivo', txtarchivo);
                    formdata.append('mensaje', mensaje);
                    $.ajax({
                        type: 'POST',
                        url: url+'GestionAlumno/editarAsistenciasAl',
                        data: formdata,
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            alert("Se registró su justificación exitosamente.");
                            $('#subir_justificacion').modal('toggle');
                        }
                    });

});




    $(".edita").click(function () {

        var id = $(this).data("codigo");
        var fecha = $(this).data("fecha");
        $.ajax({
            type: 'POST',
            url: url+'GestionAlumno/editarAsistenciaAl',
            data: {
                id: id,
                fecha: fecha
            },
            success: function (datos) {
                if (datos.length > 0) {
                    $('#DIVEDITARASISTENCIA1').html(datos);

                }
                return false;
            }
        });
    });
    $(".ver").click(function () {
        var id = $(this).data("codigo");

        $.ajax({
            type: 'POST',
            url: url+'GestionAlumno/verAsistenciaAl',
            data: {
                id: id
            },
            success: function (datos) {
                if (datos.length > 0) {
                    $('#DIVVERASISTENCIA').html(datos);

                }
                return false;
            }
        });
    });

    $(".guard").click(function () {
        var id = $(this).data("codigo");
        var fecha = $(this).data("fecha");
        var mensaje = $("#mensaje").val();

        $.ajax({
            type: 'POST',
            url: url+'GestionAlumno/guardarmensajeAs',
            data: {
                id: id,
                fecha: fecha,
                mensaje: mensaje
            }
        });
    });


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