<?php if ($bodyData->respuesta>0) {
    ?>
<div class="row">

     <?php if ($bodyData->idHor[0]->turnos=='mañana') {
        ?>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2> <i class="fa fa-list"></i>   Turno:  <?=$bodyData->horas[0]->turnos?></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped tablesorter">
                <thead>
                    <tr class="headings">
                        <th><small><center>Horas</center></small></th>
            <?php foreach ($bodyData->dias as $dias): ?>
            <th><small><?=$dias->dias?></small></th>
            <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
            <?php $i=1;
        foreach ($bodyData->horas as $horas):?>
                <?php  if ($horas->turnos=='mañana') {
            ?>
                    <tr>
                        <td><small><center><?=$horas->horarios?></center></small></td>
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
                        <td title="<?=$curso; ?>" bgcolor="<?=$color?>"><small><font style="font-style: italic;" COLOR="#fdfefe"><?=$valor[$i][$j]; ?></font></small></td>
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
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2> <i class="fa fa-list"></i>  TURNO TARDE</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped tablesorter" >
                <thead>
                    <tr>
                        <th><small><center>Horas</center></small></th>
            <?php foreach ($bodyData->dias as $dias): ?>
                    <th><small><?=$dias->dias?></small></th>
            <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
            <?php $i=1;
        foreach ($bodyData->horas as $horas):?>
                <?php  if ($horas->turnos=='tarde') {
            ?>
                    <tr>
                        <td><center><small><?=$horas->horarios?></small></center></td>
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
            <td title="<?=$curso; ?>" bgcolor="<?=$color; ?>"><small><font style="font-style: italic;" COLOR="#fdfefe"><?=$valor[$i][$j]; ?></font></small></td>
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
    } ?>
<div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-graduation-cap"></i> Orden de merito</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <div class="table-responsive">
                  <table class="table table-bordered table-hover table-striped tablesorter">
                    <thead>
                      <tr class="headings">
                          <th  class="flat" title="Puesto ocupado en el salon">Puesto salon      </th>
                          <th  class="flat" title="Puesto ocupado en todo el grado en el que se encuentra">Puesto Grado        </th>
                          <th  class="flat" title="Puesto ocupado en todo el colegio">Puesto Colegio      </th>

                        <th>Puntaje </th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><center><?=$bodyData->salon['puesto']?>/<?=$bodyData->total['salon']?></center></td>
                            <td><center><?=$bodyData->grado['puesto']?>/<?=$bodyData->total['grado']?></center></td>
                            <td><center><?=$bodyData->colegio['puesto']?>/<?=$bodyData->total['colegio']?></center></td>
                            <td><center><strong><?=$bodyData->colegio['nota']?></strong></center></td>
                        </tr>
                    </tbody>

                  </table>
                  </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                      <h2><i class="fa fa-line-chart"></i> Rendimiento academico</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                       <div id="container1" ></div>

                  </div>
                </div>
              </div>
     <div class="clearfix"></div>


 </div>

 <?php $i=0;
    foreach ($bodyData->trayecto as $tray): ?>
        <input type="hidden" name="trayecto[]"      id="trayecto"      value="<?=round($tray['nota'], 2)?>">
        <input type="hidden" name="trayectoSal[]"   id="trayectoSal"   value="<?=round($bodyData->trayectoSal[$i]['nota'], 2)?>">
        <input type="hidden" name="trayectoGra[]"   id="trayectoGra"   value="<?=round($bodyData->trayectoGra[$i]['nota'], 2)?>">
        <input type="hidden" name="trayectoCol[]"   id="trayectoCol"   value="<?=round($bodyData->trayectoCol[$i]['nota'], 2)?>">
        <input type="hidden" name="descripc[]"      id="descripc"      value="<?=$tray['desc']?>">
 <?php $i++;
    endforeach; ?>

<script src="<?= base_url('publico/js/highcharts.js') ?>"></script>
<script src="<?= base_url('publico/js/exporting.js') ?>"></script>

<script type="text/javascript">
var trayecto    = [];

 		$("input[name='trayecto[]']").each(function() {
			var value = parseFloat($(this).val());
		    	trayecto.push(value);
		});
var trayectoSal    = [];

 		$("input[name='trayectoSal[]']").each(function() {
			var value = parseFloat($(this).val());
		    	trayectoSal.push(value);
		});
var trayectoGra    = [];

 		$("input[name='trayectoGra[]']").each(function() {
			var value = parseFloat($(this).val());
		    	trayectoGra.push(value);
		});
var trayectoCol    = [];

 		$("input[name='trayectoCol[]']").each(function() {
			var value = parseFloat($(this).val());
		    	trayectoCol.push(value);
		});
var descripcion = [];

 		$("input[name='descripc[]']").each(function() {
			var value = $(this).val();
		    	descripcion.push(value);
		});
Highcharts.chart('container1', {
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
    },{
        name: 'Salon',
        data: trayectoSal
    },
    {
        name: 'Grado',
        data: trayectoGra
    }, {
        name: 'Colegio',
        data: trayectoCol
    }]
});
</script>
<?php
} else {
        echo "No cuenta con la información necesaria para mostrar esta interfaz.";
    }
?>