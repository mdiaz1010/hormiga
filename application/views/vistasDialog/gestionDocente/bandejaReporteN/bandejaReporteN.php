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

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <strong><small> <i class="fa fa-edit"></i>Orden de merito</small></strong>                                    <span class="badge">
                                        Cant. de alumnos:    <?= $totalRegistros ?>
                                    </span>
                                <ul class="nav navbar-right panel_toolbox">


                                </ul>
                                <div class="clearfix"></div>
                            </div>

                            <div id="merito" >

                            <div class="x_content table-responsive  " >


                            <div class="col-md-12 col-sm-12 col-xs-12">

                                                <form method='POST' id='formReport' name="formReport" action="<?=base_url();?>GestionDocente/comboBandeNotReportG1" target="TheWindow">
                                                        <input type='hidden' name="grado"       id="grado"      value="<?=$bodyData->datos['id_grado']?>">
                                                        <input type='hidden' name="seccion"     id="seccion"    value="<?=$bodyData->datos['id_seccion']?>">
                                                        <input type='hidden' name="bimestre"    id="bimestre"   value="<?=$bodyData->datos['id_bimestre']?>">
                                                        <input type='hidden' name="curso"       id="curso"      value="<?=$bodyData->datos['id_curso']?>">
                                                        <input type="submit" class="btn btn-danger" value="Lista total de alumnos PDF">
                                                </form>
                            </div>
                            </div>
                            </div>
                        </div>
                    </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <strong><small><i class="fa fa-bar-chart-o"></i> Reporte en cantidad:</small></strong>
                        <ul class="nav navbar-right panel_toolbox">


                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content table-responsive">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div id="container" style="width: 100%;height: 100%; margin: 0 auto"></div>
                            </div>


                    </div>
                </div>
            </div>
                        </div>
                    </div>



        <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <strong><small><i class="fa fa-bar-chart-o"></i> Reporte en porcentaje:</small></strong>
                        <ul class="nav navbar-right panel_toolbox">


                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content table-responsive">





                            <div class="x_content" >
                                    <div id="pastel-porcentaje" style="width: 70%;height: 70%; margin: 0 auto"></div>
                            </div>





                    </div>
                </div>
        </div>
















        <!-- /page content -->


        <script type="text/javascript">


        Highcharts.chart('pastel-porcentaje', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: ' '
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Porcentaje',
                colorByPoint: true,
                data: <?=$bodyData->list_pastel?>
            }]
        });
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
                    text: ' '
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




        </script>