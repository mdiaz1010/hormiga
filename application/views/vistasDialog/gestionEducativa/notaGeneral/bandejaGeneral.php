<?php ?>

<div class="col-xs-12">

    <div class="row">

        <div class="table-responsive">
            <div id="container" class="col-xs-12"></div>
        </div>

    </div>


</div>




<script src="<?= base_url('publico/js/highcharts.js') ?>"></script>
<script src="<?= base_url('publico/js/exporting.js') ?>"></script>
<script src="<?= base_url('publico/html_libs/Chart.js/dist/Chart.min.js') ?>"></script>
<script type="text/javascript">

    Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: ''
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: [<?=$bodyData->arrayGrado?>]
        },
        yAxis: {
            title: {
                text: ''
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
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        series: [<?=$bodyData->arrayNombre?>]
    });
</script>