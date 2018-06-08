<div class="row">



    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Informe:</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table table-bordered table-hover table-striped tablesorter ">
                    <thead>
                        <tr>
                            <th>
                                <small>
                                    <center></center>
                                </small>
                            </th>
                            <th>
                                <small>
                                    <center>Informe</center>
                                </small>
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($bodyData->resultado as $valores):?>
                        <tr>
                            <td>
                                <?=$valores['bimestre']?>
                            </td>
                            <td>
                                <?=$valores['resultado']?>
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>
                    <i class="fa fa-edit"></i>Curso:
                    <?=$bodyData->info[0]->nombre?>
                </h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div id="container7"></div>
            </div>
        </div>
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Notas finales:</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div id="container1"></div>
            </div>
        </div>
    </div>


</div>


<?php foreach ($bodyData->info as $info):?>
<input type="hidden" name="semestre[]" id="semestre" value="<?=$info->desc?>">
<input type="hidden" name="nota[]" id="nota" value="<?=$info->nota?>">
<?php endforeach;?>



<script src="<?= base_url('publico/js/highcharts.js') ?>"></script>


<script type="text/javascript">
    var bimestre = [];

    $("input[name='semestre[]']").each(function () {
        var value = $(this).val();
        bimestre.push(value);
    });
    var notas = [];

    $("input[name='nota[]']").each(function () {
        var value = parseFloat($(this).val());
        notas.push(value);
    });
    Highcharts.chart('container1', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'NOTAS FINALES <?=$bodyData->ano?>'
        },
        xAxis: {
            categories: bimestre,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Notas finales'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [<?=$bodyData->haber?>]
    });

    Highcharts.chart('container7', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'NOTAS FINALES'
        },

        xAxis: {
            categories: bimestre,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Notas Finales'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: "<?=$bodyData->info[0]->nombre?>",
            data: notas
        }]
    });
</script>