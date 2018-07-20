<!-- page content -->
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
    $graficoArrayLabels = trim($graficoArrayLabels, ",");
    $graficoArrayValores = trim($graficoArrayValores, ",");
    $graficoArrayColores = trim($graficoArrayColores, ",");

     //   echo password_hash("algo", PASSWORD_DEFAULT)."\n   ".PASSWORD_DEFAULT ;

    $graficoArrayFecha ;

    try {
        //    $fecha = new DateTime($graficoArrayFecha);
    } catch (Exception $e) {
    }

    // echo $fecha->format('Y-m-d');
    ?>

        <div class="row">

            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_title  ">
                        <h2 class=" ">
                            <i class="fa fa-bar-chart-o"></i> Estadística Notas: </h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </li>

                            <li>
                                <a class="close-link">

                                </a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>



                    <div class="x_content">

                        <div class="row">
                            <div class="col-md-6 ">
                                <span id="trafico_terminales_dia">Dia:
                                    <?=  date('d')  ?>
                                </span>
                                <i class="fa fa-check"></i>
                            </div>
                            <div class="col-md-6  ">
                                <span id="trafico_terminales_fecha">Fecha:
                                    <?=date('Y-m-d')?>
                                </span>
                                <i class="glyphicon glyphicon-calendar"></i>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="x_content">
                                <canvas id="polarArea" style="    height: 350px;"></canvas>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="list-group">

                                <div class="list-group-item">
                                    <span class="badge">
                                        <?= $totalRegistros ?>
                                    </span>
                                    <i class="fa fa-check"></i>
                                    <a class="no_color_link">Cantidad de usuarios</a>
                                </div>



                            </div>
                        </div>

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


            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>
                            <i class="fa fa-graduation-cap"></i> Orden de merito</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </li>
                            <li>
                                <a class="close-link">

                                </a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div id="merito" class="table-responsive">

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>
                            <i class="fa fa-list-ul"></i> Leyenda</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </li>
                            <li>
                                <a class="close-link">

                                </a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="table-responsive">
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
            </div>


        </div>




        <!-- /page content -->
        <script src="<?= base_url('publico/js/highcharts.js') ?>"></script>
        <script src="<?= base_url('publico/html_libs/Chart.js/dist/Chart.min.js') ?>"></script>
        <script type="text/javascript">
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
            $.post('merito', function (data) {
                $("#merito").html('<i class="fa fa-circle-o-notch" style="font-size:48px;color:red"></i>');
                $("#merito").html(data);
            });
        </script>