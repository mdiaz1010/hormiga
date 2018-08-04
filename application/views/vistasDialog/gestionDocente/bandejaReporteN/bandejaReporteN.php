<div class="row">

</div>

<?php

    $semana= array("","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado","Domingo");
    $graficoArrayFecha = "";
    $graficoArrayLabels ="";
    $graficoArrayValores ="";
    $graficoArrayColores ="";
    $totalRegistros =0;
    $listaYColor = array();
    foreach ($bodyData->notas as  $value) {
        $graficoArrayLabels .= "'".$value['nombre']."',";
        $graficoArrayValores.= "'".$value['nota']."',";
        $color = '#'.substr(md5(rand(20, 100)), 0, 6);
        $graficoArrayColores .= "'".$color."',"; ?>
    <input type="hidden" name="nombre[]" id="nombre" value="<?=$value['nombre']?>">
    <input type="hidden" name="nota[]" id="nota" value="<?=$value['nota']?>">
    <input type="hidden" name="rango[]" id="rango" value="<?=$value['rango']?>">
    <?php
        $totalRegistros = $bodyData->usuariosTotales[0]->cantidad;
        $listaYColor[] =(object) array('nombre'=>$value['nombre'], 'color'=>$color,'valor'=>$value['nota']);
    }
    $graficoArrayLabels  = trim($graficoArrayLabels, ",");
    $graficoArrayValores = trim($graficoArrayValores, ",");
    $graficoArrayColores = trim($graficoArrayColores, ",");

     //   echo password_hash("algo", PASSWORD_DEFAULT)."\n   ".PASSWORD_DEFAULT ;

    $graficoArrayFecha ;


    // echo $fecha->format('Y-m-d');
    ?>

        <div class="row">

            <div class="col-xs-12 col-sm-6   col-md-6">
                <div class="panel panel-danger">
                    <div class=" panel-heading">
                        <h3 class=" ">
                            <i class="fa fa-bar-chart-o"></i> Estadística Notas: </h3>
                    </div>

                    <div class="panel-body">

                        <div class="row">
                            <div class="col-md-6 ">
                                <span id="trafico_terminales_dia">Dia:
                                    <?=  date('d')  ?>
                                </span>
                                <i class="fa fa-check"></i>
                            </div>

                        </div>
                        <div class="col-md-8">
                            <div class="x_content">
                                <canvas id="polarArea" style="    height: 350px;"></canvas>
                            </div>
                        </div>
                        <form method='POST' id='formReport' name="formReport" action="<?=base_url();?>GestionDocente/comboBandeNotReportG1" target="TheWindow">
                        <div class="col-md-4">
                            <div class="list-group">

                                <div class="list-group-item">

                                    <a class="no_color_link">Cantidad de alumnos</a>
                                    <span class="badge">
                                        <?= $totalRegistros ?>
                                    </span>

                                </div>

                                <input type='hidden' name="grado"       id="grado"      value="<?=$bodyData->datos['id_grado']?>">
                                <input type='hidden' name="seccion"     id="seccion"    value="<?=$bodyData->datos['id_seccion']?>">
                                <input type='hidden' name="bimestre"    id="bimestre"   value="<?=$bodyData->datos['id_bimestre']?>">
                                <input type='hidden' name="curso"       id="curso"      value="<?=$bodyData->datos['id_curso']?>">

                                <br>
                                <input type="submit" class="btn btn-danger" value="Generar PDF">



                            </div>
                        </div>
                        </form>
                        <div class="col-xs-12">
                            <div class="row">
                                <table class="table table-bordered table-hover table-striped tablesorter">
                                    <?php
                            foreach ($listaYColor as $listaYColorTemp) {
                                ?>
                                        <tr>
                                            <td class="col-xs-11">
                                                <div class="col-xs-2" style="background: <?=$listaYColorTemp->color?>;padding: 5px;">
                                                </div>
                                                <?=$listaYColorTemp->nombre?>
                                            </td>
                                            <td class="col-xs-1">
                                                <?=$listaYColorTemp->valor?>
                                            </td>
                                            <tr>
                                                <?php
                            }
                        ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="fa fa-edit"></i>Orden de merito </h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">

                            <table class="table table-bordered table-hover table-striped tablesorter">
                                <thead>
                                    <tr>
                                        <th>Puesto </th>
                                        <th>Usuario </th>
                                        <th>Puntaje </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $p=1; foreach ($bodyData->merito as $merito):?>
                                    <tr>
                                        <td>
                                            <center>
                                                <strong>
                                                    <?=$p?>
                                                </strong>
                                            </center>
                                        </td>
                                        <td>
                                            <?=$bodyData->alumno[$merito['id_alumno']]?>
                                        </td>
                                        <td>
                                            <center>
                                                <strong>
                                                    <?=$merito['nota']?>
                                                </strong>
                                            </center>
                                        </td>
                                    </tr>
                                    <?php  $p++; endforeach;?>
                                </tbody>

                            </table>


                        </div>

                        <div class="text-right">

                        </div>
                    </div>
                </div>
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="fa fa-check"></i>Leyenda</h3>
                    </div>
                    <table class="table table-bordered table-hover table-striped tablesorter">
                        <tr>
                            <small>
                                <font style="font-style: italic;">
                                    <td>Satisfactorio</td>
                                    <td>18,19,20</td>
                                </font>
                            </small>
                        </tr>
                        <tr>
                            <small>
                                <font style="font-style: italic;">
                                    <td>Proceso </td>
                                    <td>14,15,16,17</td>
                                </font>
                            </small>
                        </tr>
                        <tr>
                            <small>
                                <font style="font-style: italic;">
                                    <td>Inicio</td>
                                    <td>11,12,13</td>
                                </font>
                            </small>
                        </tr>
                        <tr>
                            <small>
                                <font style="font-style: italic;">
                                    <td>Previo Inicio</td>
                                    <td>0 a 10</td>
                                </font>
                            </small>
                        </tr>
                    </table>
                </div>
            </div>

        </div>

        <div class="panel panel-info">
            <div class=" panel-heading">
                <h3 class=" ">
                    <i class="fa fa-bar-chart-o"></i> Estadística Notas: </h3>
            </div>

            <div class="panel-body">

                <div id="container" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>

            </div>

        </div>



        <!-- /page content -->
        <script src="<?= base_url('publico/js/highcharts.js') ?>"></script>
        <script src="<?= base_url('publico/js/exporting.js') ?>"></script>
        <script src="<?= base_url('publico/html_libs/Chart.js/dist/Chart.min.js') ?>"></script>
        <script type="text/javascript">
            $(".detalle").click(function () {
                var curso = $(this).data("curso");
                var grado = $(this).data("grado");
                var seccion = $(this).data("seccion");
                var bimestre = $(this).data("bimestre");
                window.open(url+"GestionDocente/comboBandeNotReportG1",{curso:curso,grado:grado,seccion:seccion,bimestre:bimestre});

            });

            var rango = [];

            $("input[name='rango[]']").each(function () {
                var value = parseInt($(this).val());
                rango.push(value);
            });

            var notas = [];

            $("input[name='nota[]']").each(function () {
                var value = parseInt($(this).val());
                notas.push(value);
            });

            var nombre = [];

            $("input[name='nombre[]']").each(function () {
                var value = $(this).val();
                nombre.push(value);
            });

            Highcharts.chart('container', {
                chart: {
                    type: 'bar'
                },
                title: {
                    text: 'Grafico de Barras'
                },
                xAxis: {
                    categories: nombre
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Alumnos'

                    }

                },
                legend: {
                    reversed: true
                },
                plotOptions: {
                    series: {
                        stacking: 'normal'
                    }
                },
                series: [{
                    categories: nombre,
                    name: 'Cantidad de alumnos',
                    data: notas
                }]
            });



            Chart.defaults.global.legend = {
                enabled: false
            };
            // PolarArea chart
            var ctx = document.getElementById("polarArea");
            var data = {
                datasets: [{
                    data: [<?=$graficoArrayValores ?>],
                    backgroundColor: [<?=$graficoArrayColores?>],
                    label: 'Registros de Asistencia'
                }],
                labels: [<?=$graficoArrayLabels?>]
            };

            var polarArea = new Chart(ctx, {
                data: data,
                type: 'doughnut',
                options: {
                    scale: {
                        ticks: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>