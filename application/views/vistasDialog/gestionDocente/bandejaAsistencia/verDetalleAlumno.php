<?php if ($bodyData->respuesta>0) {
    ?>

<div class="row">
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Reporte de asistencias, inasistencias y evasiones</h2>
                <ul class="nav navbar-right panel_toolbox">


                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content" id="container7">



            </div>
        </div>
    </div>


    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <strong><small>Historial de inasistencias</small></strong>
                <ul class="nav navbar-right panel_toolbox">


                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">


                <div class="table-responsive" id="bandejaAsistenciaAlu"></div>

            </div>
        </div>
    </div>


    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <small><strong>Historial de evasiones</strong> (El alumno no ingresó al salón de clase de los siguientes curso)</small>
                <ul class="nav navbar-right panel_toolbox">


                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">


                <div class="table-responsive" id="bandejaEvasionAlu"></div>

            </div>
        </div>
    </div>
</div>
<input type="hidden" name="codigo" id="codigo" value="<?=$bodyData->codigo?>">
<font style="font-style: italic;">
        <?=$bodyData->alumno;?>
</font>

<input type="hidden" name="url" id="url" value="<?=site_url()?>">
<div id="DIVcargas" title="EN PROCESO ... ">
    Espere mientras se gestiona la informaci&oacute;n.
    <span class="fa fa-spinner fa-pulse fa-2x fa-fw"></span>
</div>

<script>

        var codigo= $("#codigo").val();
        var url = $("#url").val();

           $('#DIVcargas').dialog({
               autoOpen: false,
               hide: 'drop',
               width: 360,
               height: 80,
               closeOnEscape: false,
               open: function (event, ui) {
                   $(".ui-dialog-titlebar-close").hide();
               },
               modal: true
           });
           $('#DIVcargas').dialog({
               draggable: false
           });
           $('#DIVcargas').dialog({
               resizable: false
           });

           $.post(url + 'GestionDocente/bandejaAsistenciaAlu/' + "total", {codigo:codigo}, function (data) {

               $("#bandejaAsistenciaAlu").html(data);


           });
           $.post(url + 'GestionDocente/consultarEvasion', {codigo:codigo}, function (data) {

               $("#bandejaEvasionAlu").html(data);


           });
Highcharts.chart('container7', {

    title: {
        text: ' '
    },



    series: [{
        name: 'Cantidad:',
        type: 'pie',
        allowPointSelect: true,
        keys: ['name', 'y', 'selected', 'sliced'],
        data: <?=$bodyData->list_historial;?>,
        showInLegend: true
    }]
});
</script>
<?php
} else {
        echo "No cuenta con la información necesaria para mostrar esta interfaz.";
    }
?>
