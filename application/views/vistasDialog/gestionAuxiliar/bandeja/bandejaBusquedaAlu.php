<?php if ($bodyData->respuesta>0) {
    ?>
<link href="<?= base_url('publico/js_vistas/css/password.css') ?>" rel="stylesheet">
<script src="<?= base_url('publico/js/strength.js')?>"></script>

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>
                <span class="fa fa-search"></span> INTRANET EDUCATIVO - Consultar Informacion </h2>

            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="col-xs-10">
                <form method="post" name="crearusuario" id="crearusuario">
                    <div class="form-group">
                        <label class="control-label col-md-6 col-sm-6 col-xs-12">
                            Nombres y apellidos:
                            <input name="apepat" id="apepat" placeholder="Apellido paterno" class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"
                                value="<?=$bodyData->results1['apepat']?>" readonly>
                        </label>
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                            Rol:
                            <input name="rol" id="rol" placeholder="Rol" class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"
                                value="<?=$bodyData->results1['usuari']?>" readonly>
                        </label>
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                            Dni:
                            <input name="documento" id="documento" placeholder="documento" type="text" class="form-control" required value="<?=$bodyData->results1['docume']?>"
                                readonly>
                        </label>
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                            Telefono:
                            <input name="telefono" id="telefono" placeholder="Telefono" type="text" class="form-control" value="<?=$bodyData->results1['telefo']?>"
                                readonly>
                        </label>

                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                            email:
                            <input name="email" id="email" placeholder="email" type="email " class="form-control" required value="<?=$bodyData->results1['correo']?>"
                                readonly>
                        </label>
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                            Grado y Seccion:
                            <input name="grado" id="grado" placeholder="email" type="email " class="form-control" required value="<?=$bodyData->results1['grados']?>"
                                readonly>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                            Fecha de Nacimiento:
                            <input name="fecha" id="fecha" type="date" placeholder="fecha" class="form-control" required value="<?=$bodyData->results1['fecha']?>">
                        </label>
                        <label class="control-label col-md-9 col-sm-9 col-xs-12">
                            Direccion:
                            <textarea name="direccion" id="direccion" placeholder="Direccion " class="form-control" style="text-transform:uppercase;"
                                onkeyup="javascript:this.value=this.value.toUpperCase();" rows="1"><?=$bodyData->results1['direcc']?></textarea>
                        </label>
                    </div>

                </form>
            </div>
            <div class="col-xs-2">
                <div class="table-responsive">

                    <div id="centrador" class="thumbnail">
                        <a href="#" style=" outline: none;" class="img-rounded">
                            <img id="imagen" src="<?= base_url($bodyData->results1['ruta'])?>" class="img-responsive center-block" align="top" alt="Lights"
                                style="width:100%" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php if ($bodyData->idHor[0]->turnos=='mañana') {
        ?>
<div class="col-md-6 col-sm-6 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>
                <i class="fa fa-list"></i> Turno:
                <?=$bodyData->horas[0]->turnos?>
            </h2>
            <ul class="nav navbar-right panel_toolbox">
                <li>
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        <i class="fa fa-wrench"></i>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="#">Settings 1</a>
                        </li>
                        <li>
                            <a href="#">Settings 2</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="close-link">
                        <i class="fa fa-close"></i>
                    </a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped tablesorter">
                    <thead>
                        <tr class="headings">
                            <th>
                                <small>
                                    <center>Horas</center>
                                </small>
                            </th>
                            <?php foreach ($bodyData->dias as $dias): ?>
                            <th>
                                <small>
                                    <?=$dias->dias?>
                                </small>
                            </th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1;
        foreach ($bodyData->horas as $horas):?>
                        <?php  if ($horas->turnos=='mañana') {
            ?>
                        <tr>
                            <td>
                                <small>
                                    <center>
                                        <?=$horas->horarios?>
                                    </center>
                                </small>
                            </td>
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
                            <td title="<?=$curso; ?>" bgcolor="<?=$color?>">
                                <small>
                                    <font style="font-style: italic;" COLOR="#fdfefe">
                                        <?=$valor[$i][$j]; ?>
                                    </font>
                                </small>
                            </td>
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
                <h2>
                    <i class="fa fa-list"></i> TURNO TARDE</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li>
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </li>
                    <li>
                        <a class="close-link">
                            <i class="fa fa-close"></i>
                        </a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped tablesorter">
                        <thead>
                            <tr>
                                <th>
                                    <small>
                                        <center>Horas</center>
                                    </small>
                                </th>
                                <?php foreach ($bodyData->dias as $dias): ?>
                                <th>
                                    <small>
                                        <?=$dias->dias?>
                                    </small>
                                </th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1;
        foreach ($bodyData->horas as $horas):?>
                            <?php  if ($horas->turnos=='tarde') {
            ?>
                            <tr>
                                <td>
                                    <center>
                                        <small>
                                            <?=$horas->horarios?>
                                        </small>
                                    </center>
                                </td>
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
                                <td title="<?=$curso; ?>" bgcolor="<?=$color; ?>">
                                    <small>
                                        <font style="font-style: italic;" COLOR="#fdfefe">
                                            <?=$valor[$i][$j]; ?>
                                        </font>
                                    </small>
                                </td>
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
                                <i class="fa fa-close"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped tablesorter">
                            <thead>
                                <tr class="headings">
                                    <th class="flat" title="Puesto ocupado en el salon">Puesto salon </th>
                                    <th class="flat" title="Puesto ocupado en todo el grado en el que se encuentra">Puesto Grado </th>
                                    <th class="flat" title="Puesto ocupado en todo el colegio">Puesto Colegio </th>

                                    <th>Puntaje </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <center>
                                            <?=$bodyData->salon['puesto']?>/
                                                <?=$bodyData->total['salon']?>
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <?=$bodyData->grado['puesto']?>/
                                                <?=$bodyData->total['grado']?>
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <?=$bodyData->colegio['puesto']?>/
                                                <?=$bodyData->total['colegio']?>
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <strong>
                                                <?=$bodyData->colegio['nota']?>
                                            </strong>
                                        </center>
                                    </td>
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
                    <h2>
                        <i class="fa fa-line-chart"></i> Rendimiento academico</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </li>
                        <li>
                            <a class="close-link">
                                <i class="fa fa-close"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div id="container1"></div>

                </div>
            </div>
        </div>
        <div class="clearfix"></div>




        <?php $i=0;
    foreach ($bodyData->trayecto as $tray): ?>
        <input type="hidden" name="trayecto[]" id="trayecto" value="<?=round($tray['nota'], 2)?>">
        <input type="hidden" name="trayectoSal[]" id="trayectoSal" value="<?=round($bodyData->trayectoSal[$i]['nota'], 2)?>">
        <input type="hidden" name="trayectoGra[]" id="trayectoGra" value="<?=round($bodyData->trayectoGra[$i]['nota'], 2)?>">
        <input type="hidden" name="trayectoCol[]" id="trayectoCol" value="<?=round($bodyData->trayectoCol[$i]['nota'], 2)?>">
        <input type="hidden" name="descripc[]" id="descripc" value="<?=$tray['desc']?>">
        <?php $i++;
    endforeach; ?>

        <script src="<?= base_url('publico/js/highcharts.js') ?>"></script>
        <script src="<?= base_url('publico/js/exporting.js') ?>"></script>

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
            Highcharts.chart('container1', {
                chart: {
                    type: 'line'
                },
                title: {
                    text: ''
                },
                subtitle: {
                    text: '<?=date('
                    Y ')?> Año del buen servicio al ciudadano'
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

            $(document).ready(function ($) {
                $("#myPassword").strength();
            });
        </script>
        <?php
} else {
        echo "No cuenta con la información necesaria para mostrar esta interfaz.";
    }
?>