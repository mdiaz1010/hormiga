<?php ?>
<link href="<?= base_url('publico/js_vistas/css/password.css') ?>" rel="stylesheet">
<script src="<?= base_url('publico/js/strength.js')?>"></script>
<div class="row col-lg-12">
</div>


<div class="col-xs-12">
    <?php if ($bodyData->horas[0]->turnos=='mañana') {
    ?>
    <div class="col-xs-6">
        <div class="row">

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h1 class="panel-title">
                        <i class="fa fa-list"></i> Turno:
                        <?=$bodyData->horas[0]->turnos?>
                    </h1>
                </div>
                <div class="panel-body">
                    <!-- poner responsive a las tablas-->
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped tablesorter ">
                            <thead>
                                <tr>
                                    <th>
                                        <small>
                                            <center>Horas</center>
                                        </small>
                                    </th>
                                    <?php foreach ($bodyData->dias as $dias): ?>
                                    <th>
                                        <small>
                                            <?=$dias->dias?>
                                        </small>
                                    </th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1;
    foreach ($bodyData->horas as $horas):?>
                                <?php  if ($horas->turnos=='mañana') {
        ?>
                                <tr>
                                    <td>
                                        <small>
                                            <center>
                                                <?=$horas->horarios?>
                                            </center>
                                        </small>
                                    </td>
                                    <?php $j=1;
        foreach ($bodyData->dias as $dias):
                        if (isset($bodyData->results[$i][$j])==false) {
                            $valor[$i][$j]='';
                            $color='';
                            $curso='';
                        } else {
                            $valor[$i][$j]=$bodyData->results[$i][$j]['materia'];
                            $color=$bodyData->color[$bodyData->results[$i][$j]['materia']];
                            $curso=$bodyData->curso[$bodyData->results[$i][$j]['materia']];
                        } ?>
                                    <td title="<?=$curso; ?>" bgcolor="<?=$color?>">
                                        <small>
                                            <font style="font-style: italic;" COLOR="#fdfefe">
                                                <?=$valor[$i][$j]; ?>
                                            </font>
                                        </small>
                                    </td>
                                    <?php $j++;
        endforeach; ?>
                                </tr>
                                <?php
    } ?>
                                    <?php $i++;
    endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>



        <?php
} else {
        ?>
            <div class="col-xs-6">
                <div class="row">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h1 class="panel-title">
                                TURNO TARDE
                            </h1>
                        </div>
                        <div class="panel-body">
                            <table class="table table-bordered table-hover table-striped tablesorter">
                                <thead>
                                    <tr>
                                        <th>
                                            <small>
                                                <center>Horas</center>
                                            </small>
                                        </th>
                                        <?php foreach ($bodyData->dias as $dias): ?>
                                        <th>
                                            <small>
                                                <?=$dias->dias?>
                                            </small>
                                        </th>
                                        <?php endforeach; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1;
        foreach ($bodyData->horas as $horas):?>
                                    <?php  if ($horas->turnos=='tarde') {
            ?>
                                    <tr>
                                        <td>
                                            <center>
                                                <small>
                                                    <?=$horas->horarios?>
                                                </small>
                                            </center>
                                        </td>
                                        <?php $j=1;
            foreach ($bodyData->dias as $dias):
                        if (isset($bodyData->results[$i][$j])==false) {
                            $valor[$i][$j]='';
                            $color="";
                            $curso='';
                        } else {
                            $valor[$i][$j]=$bodyData->results[$i][$j]['materia'];
                            $color=$bodyData->color[$bodyData->results[$i][$j]['materia']];
                            $curso=$bodyData->curso[$bodyData->results[$i][$j]['materia']];
                        } ?>
                                        <td title="<?=$curso; ?>" bgcolor="<?=$color; ?>">
                                            <small>
                                                <font style="font-style: italic;" COLOR="#fdfefe">
                                                    <?=$valor[$i][$j]; ?>
                                                </font>
                                            </small>
                                        </td>
                                        <?php $j++;
            endforeach; ?>
                                    </tr>
                                    <?php
        } ?>
                                        <?php $i++;
        endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <?php
    }?>
                    <div class="row">

                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <i class="fa fa-edit"></i>Orden de merito </h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">

                                    <table class="table table-bordered table-hover table-striped tablesorter">
                                        <thead>
                                            <tr>
                                                <th title="Puesto ocupado en el salon">Puesto salon </th>
                                                <th title="Puesto ocupado en todo el grado en el que se encuentra">Puesto Grado </th>
                                                <th title="Puesto ocupado en todo el colegio">Puesto Colegio </th>

                                                <th>Puntaje </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <center>
                                                        <?=$bodyData->salon['puesto']?>/
                                                            <?=$bodyData->total['salon']?>
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <?=$bodyData->grado['puesto']?>/
                                                            <?=$bodyData->total['grado']?>
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <?=$bodyData->colegio['puesto']?>/
                                                            <?=$bodyData->total['colegio']?>
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <strong>
                                                            <?=$bodyData->colegio['nota']?>
                                                        </strong>
                                                    </center>
                                                </td>
                                            </tr>
                                        </tbody>

                                    </table>


                                </div>
                            </div>



                        </div>

                    </div>
            </div>
            <div class="col-xs-6">
                <div id="container1"></div>

            </div>
    </div>
</div>
</div>
<?php $i=0; foreach ($bodyData->trayecto as $tray): ?>
<input type="hidden" name="trayecto[]" id="trayecto" value="<?=$tray['nota']?>">
<input type="hidden" name="trayectoSal[]" id="trayectoSal" value="<?=$bodyData->trayectoSal[$i]?>">
<input type="hidden" name="trayectoGra[]" id="trayectoGra" value="<?=$bodyData->trayectoGra[$i]?>">
<input type="hidden" name="trayectoCol[]" id="trayectoCol" value="<?=$bodyData->trayectoCol[$i]?>">
<input type="hidden" name="descripc[]" id="descripc" value="<?=$tray['desc']?>">
<?php $i++; endforeach;?>

<script src="<?= base_url('publico/js/highcharts.js') ?>"></script>
<script src="<?= base_url('publico/js/exporting.js') ?>"></script>

<script type="text/javascript">
    var trayecto = [];

    $("input[name='trayecto[]']").each(function () {
        var value = parseInt($(this).val());
        trayecto.push(value);
    });
    var trayectoSal = [];

    $("input[name='trayectoSal[]']").each(function () {
        var value = parseFloat($(this).val());
        trayectoSal.push(value);
    });
    var trayectoGra = [];

    $("input[name='trayectoGra[]']").each(function () {
        var value = parseFloat($(this).val());
        trayectoGra.push(value);
    });
    var trayectoCol = [];

    $("input[name='trayectoCol[]']").each(function () {
        var value = parseFloat($(this).val());
        trayectoCol.push(value);
    });
    var descripcion = [];

    $("input[name='descripc[]']").each(function () {
        var value = $(this).val();
        descripcion.push(value);
    });
    Highcharts.chart('container1', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'RENDIMIENTO ACADEMICO'
        },
        subtitle: {
            text: '<?=date('
            Y ')?> Año del buen servicio al ciudadano'
        },
        xAxis: {
            categories: descripcion
        },
        yAxis: {
            title: {
                text: 'Rendimiento academico'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        series: [{
                name: 'Mi Promedio',
                data: trayecto
            }, {
                name: 'Salon',
                data: trayectoSal
            },
            {
                name: 'Grado',
                data: trayectoGra
            }, {
                name: 'Colegio',
                data: trayectoCol
            }
        ]
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
        width: 150px;
        height: 180px;

    }

    #imagen {
        width: 100px;
    }
</style>
<script type="text/javascript">
    $("#btneditar").click(function () {
        var fecha = $("#fecha").val();
        var direccion = $("#direccion").val();
        var clave = $("#myPassword").val();
        var clave2 = $("#clave").val();
        if (clave === clave2) {
            var fecha = $("#fecha").val();
            var direccion = $("#direccion").val();
            var clave = $("#myPassword").val();
            var DocAdj = $("#docAdj").val();

            var inputimage = document.getElementById('docAdj'),

                formdata = new FormData();
            var i = 0,
                len = inputimage.files.length,
                img, reader, file;
            for (; i < len; i++) {
                file = inputimage.files[i];
                if (formdata)
                    formdata.append('images[]', file);
            }

            formdata.append('fecha', fecha);
            formdata.append('direccion', direccion);
            formdata.append('clave', clave);
            $.ajax({
                type: 'POST',
                url: "editarInfo",
                data: formdata,
                processData: false,
                contentType: false,
                success: function () {
                    location.reload();
                }
            });

        } else {
            $('#result_error').html("<font color='red'>Las claves no coinciden</font>");
        }


    });
    $(document).ready(function ($) {
        $("#myPassword").strength();
    });
</script>