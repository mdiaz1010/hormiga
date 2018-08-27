<?php if ($bodyData->idHor[0]->turnos=='mañana') {
    ?>

<h2>
    <i class="fa fa-list"></i> Turno:
    <?=$bodyData->horas[0]->turnos?>
</h2>

<div class="clearfix"></div>

<div class="x_content">
<br>
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
                            <font style="font-style: ;"COLOR="#fff">
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

    <?php
} else {
        ?>

        <h2>
            <i class="fa fa-list"></i> TURNO TARDE</h2>
        <ul class="nav navbar-right panel_toolbox">

        </ul>
        <div class="clearfix"></div>
</div>
<div class="x_content">
    <br>
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
                            <font style="font-style: ;" COLOR="#fff">
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


    <?php
    }?>