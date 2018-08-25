<!-- page content -->
<div class="row">

</div>

<?php



    // echo $fecha->format('Y-m-d');
    ?>

        <div class="row">

            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_title  ">
                        <h2 class=" ">
                            <i class="fa fa-bar-chart-o"></i> Estadística Notas: </h2>
                        <ul class="nav navbar-right panel_toolbox">


                        </ul>
                        <div class="clearfix"></div>
                    </div>



                    <div class="x_content table-responsive">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <span class="badge">
                                Cant. total:   <?= $bodyData->total ?>
                            </span>

                            <div class="x_content ">
                                    <div id="pastel_director"></div>
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

                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div id="merito" class="table-responsive">
                            <center> <i id="estadistica-load" class="fa fa-circle-o-notch fa-spin" style="font-size:24px;color:#ec7063"></i></center>
                        </div>
                    </div>
                </div>
            </div>


        </div>




        <!-- /page content -->

        <script src="<?= base_url('publico/html_libs/Chart.js/dist/Chart.min.js') ?>"></script>
        <script type="text/javascript">
            Highcharts.chart('pastel_director', {

                title: {
                    text: ' '
                },

                xAxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                },

                series: [{
                    name:'Cantidad',
                    type: 'pie',
                    allowPointSelect: true,
                    keys: ['name', 'y', 'selected', 'sliced'],
                    data: <?=$bodyData->notas?>,
                    showInLegend: true
                }]
            });


            $.post('merito', function (data) {

                $("#merito").html(data);
            });
        </script>