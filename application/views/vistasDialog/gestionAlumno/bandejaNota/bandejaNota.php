<?php if ($bodyData->respuesta>0) {
    ?>
<?php if (count($bodyData->results)>0) {
        ?>
<table class="table table-bordered">
    <thead>
        <tr>
            <th rowspan="2" valign="middle" colspan="1">
                <CENTER>
                    <H2>CURSOS</H2>
                </CENTER>
            </th>
            <?php foreach ($bodyData->bimestre as $bim) {
            ?>
            <th class="danger" colspan="<?=$bodyData->cantidad; ?>">
                <center>
                    <?=$bim->nom_bimestre; ?>
                </center>
            </th>
            <?php
        } ?>
        </tr>
        <tr>
            <?php       foreach ($bodyData->notas as $not) {
            if (isset($not->pe)==true) {
                $class='class="danger"';
            } else {
                $class='class="active"';
            } ?>
            <th <?=$class; ?>title="
                <?=$not->des_notas?>" colspan="1">
                    <center>
                        <?=$not->nom_notas; ?>
                    </center>
            </th>
            <?php
        } ?>
                <th class="danger">Promedio Final</th>
        </tr>
    </thead>
    <tbody>
        <?php $i=1;
        foreach ($bodyData->results as $cursos): ?>
        <tr>
            <td rowspan="1" valign="middle" colspan="1">
                <?=$cursos->nom_cursos?>
            </td>
            <?php       foreach ($bodyData->arrayNote as $notas):
                                if (isset($notas->pe)==true && isset($notas->id_bimestre)==true) {
                                    $classe='class="danger"';
                                } else {
                                    $classe='class="active"';
                                } ?>
            <?php if ($cursos->id==$notas->id_curso) {
                                    ?>

            <td <?=$classe; ?>
                id="
                <?=$notas->id_nota?>">
                    <center>
                        <?php if ((int)$notas->nota<11) {
                                        $color='color:red;';
                                    } elseif (isset($notas->nota)) {
                                        $color='';
                                    } else {
                                        $color='';
                                    }
                                    if ((int)$notas->nota==null) {
                                        $valority='*';
                                    } else {
                                        $valority=$notas->nota;
                                    } ?>

                        <font style="<?=$color?>">
                            <?=$valority?>
                        </font>
                    </center>
            </td>

            <?php
                                }
        endforeach; ?>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php
    } else {
        echo "<div class='alert_result'>No se encuentra ningun alumno registrado.</div>";
    } ?>
    <?php
} else {
        echo "No cuenta con la información necesaria para mostrar esta interfaz.";
    }
?>