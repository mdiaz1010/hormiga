<div class="x_content">
    <div id="container111"></div>

</div>

<?php $i=0; foreach ($bodyData->trayecto as $tray): ?>
<input type="hidden" name="trayecto[]" id="trayecto" value="<?=round($tray['nota'], 2)?>">
<input type="hidden" name="trayectoSal[]" id="trayectoSal" value="<?=round($bodyData->trayectoSal[$i]['nota'], 2)?>">
<input type="hidden" name="trayectoGra[]" id="trayectoGra" value="<?=round($bodyData->trayectoGra[$i]['nota'], 2)?>">
<input type="hidden" name="trayectoCol[]" id="trayectoCol" value="<?=round($bodyData->trayectoCol[$i]['nota'], 2)?>">
<input type="hidden" name="descripc[]" id="descripc" value="<?=$tray['desc']?>">
<?php $i++; endforeach;?>




<script type="text/javascript">
    var trayecto = [];

    $("input[name='trayecto[]']").each(function () {
        var value = parseFloat($(this).val());
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
    Highcharts.chart('container111', {
        chart: {
            type: 'line'
        },
        title: {
            text: ''
        },
        subtitle: {
            text: '<?=date('Y')?> Año del buen servicio al ciudadano'
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