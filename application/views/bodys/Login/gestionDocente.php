<?php if ($bodyData->respuesta==0) {
    ?>
<div class="row">
    <div class="col-md-6 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>TURNO MAÑANA</h2>
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


    <div class="col-md-6 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>TURNO TARDE</h2>
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
</div>
<?php
} else {
        echo "No cuenta con la informacion necesaria registrada para mostrar esta interfaz";
    }
?>