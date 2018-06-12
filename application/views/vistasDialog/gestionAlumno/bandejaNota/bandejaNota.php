<?php
if ($bodyData->respuesta>0)
{
      if (count($bodyData->results)>0)
      {


          foreach($bodyData->results as $key =>$nom_curso):
?>


    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>
                    <?=$nom_curso->nom_cursos;?>
                </h2>

                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <p>
                    <code>Fórmula:
                        <?php isset($bodyData->formula[$nom_curso->id])?$formula_curso=$bodyData->formula[$nom_curso->id]:$formula_curso='Fórmula no definida por el docente';?>
                        <?=$formula_curso;?>

                    </code>
                </p>
                <div class="table-responsive">
                    <table class="table table-striped  bulk_action">
                        <thead style="color: #fff; background-color: #2A3F54;">
                            <tr class="headings">
                                <th class="column-title">Capacidad </th>
                                <th class="column-title">Evaluación </th>
                                <th class="column-title">Descripcion de evaluación</th>
                                <th class="column-title">Peso</th>
                                <th class="column-title">Nota</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $a=0; foreach($bodyData->array_result_alumno[$nom_curso->id] as $clave => $detalle):
                            if($detalle['Nota']>10 && $detalle['Nota']<=20){
                                $color="#2E9AFE";

                            }else if($detalle['Nota']==''){
                                $color="#FFF";
                                $a++;
                            }else{
                                $color="#FE2E2E";

                            }

                                ?>
                            <tr class="">
                                <td class=" ">
                                    <?=$detalle['Capacidad']?>
                                </td>
                                <td class=" ">
                                    <?=$detalle['Evaluacion']?>
                                </td>
                                <td class=" ">
                                    <?=$detalle['Descripcion']?>
                                </td>
                                <td class=" ">
                                    <?=$detalle['Peso']?>
                                </td>
                                <td class=" " bgcolor=<?=$color?>>
                                    <font color="#ffffff">
                                        <?=$detalle['Nota']?>
                                    </font>
                                </td>

                            </tr>

                            <?php endforeach;?>
                            <tr>
                                <td class=" " style="color: #fff; background-color: #2A3F54;" colspan="4">
                                    <font color="#ffffff">
                                    <?php if($a>0){$texto='NO OFICIAL';}else{$texto='OFICIAL';} ?>
                                       <strong><?=$texto?></strong>
                                    </font>
                                </td>
                                <td class=" " style="color: #fff; background-color: #2A3F54;" colspan="4">
                                    <font color="#ffffff">
                                        <strong>
                                        <?php isset($bodyData->promedio[$nom_curso->id])?$promedio_curso=$bodyData->promedio[$nom_curso->id]:$promedio_curso='Promedio no definido';?>
                                        <?=$promedio_curso;?>
                                        </strong>
                                    </font>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>







    <?php
    endforeach;
     }
     else
     {
        echo "<div class='alert_result'>No se encuentra ningun alumno registrado.</div>";
     }

}
else
{
        echo "No cuenta con la información necesaria para mostrar esta interfaz.";
}
?>