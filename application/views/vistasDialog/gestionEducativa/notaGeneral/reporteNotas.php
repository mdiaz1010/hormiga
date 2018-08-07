<div class="row">


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
            categories: <?=$bodyData->bimestre?>,
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


</script>