<!--<h2><b>Cantidad de alumnos: <?=$bodyData->cantidad?></b></h2>-->
<div class="list-group right">
    <form method='POST' id='formReport' name="formReport" action="<?=base_url();?>GestionEducativa/comboBandeNotReportG1" target="TheWindow">
        <input type="hidden" name="grado"       id="grado"      value="<?=$bodyData->grado?>">
        <input type="hidden" name="seccion"     id="seccion"    value="<?=$bodyData->seccion?>">
        <input type="hidden" name="curso"       id="curso"      value="<?=$bodyData->curso?>">
        <input type="hidden" name="bimestre"    id="bimestre"   value="<?=$bodyData->bimestre?>">
        <input type="submit" class="btn btn-danger" value="Generar pdf">
    </form>

</div>
<input type="hidden" name="grado"       id="grado"      value="<?=$bodyData->grado?>">
<input type="hidden" name="seccion"     id="seccion"    value="<?=$bodyData->seccion?>">
<input type="hidden" name="curso"       id="curso"      value="<?=$bodyData->curso?>">
<input type="hidden" name="bimestre"    id="bimestre"   value="<?=$bodyData->bimestre?>">

<table class="table table-bordered responsive">

    <thead style="color: #fff; background-color: #2A3F54;">
        <tr>
            <th scope="col">Puesto</th>
            <th scope="col">Apellidos y nombres</th>
            <th scope="col">mérito obtenido</th>
            <th scope="col">Grado y seccion</th>
            <th scope="col">Nota</th>

        </tr>
    </thead>
    <tbody>
        <?php foreach($bodyData->resultado as $key =>$result):?>
        <tr style="color:<?=$bodyData->color[$key]['letra']?>" bgcolor="<?= $bodyData->color[$key]['color']?>">
            <td>
                <?=$key+1?>
            </td>
            <td>
                <?=$result['ape_pat_per']?>
            </td>
            <td>
                <?=$bodyData->color[$key]['merito']?>
            </td>
            <td>
                <center><b>
                        <?=$result['gradosec']?></b></center>
            </td>
            <td><b>
                    <?=$result['nota']?></b></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>