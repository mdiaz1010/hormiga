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

                <p><code>Fórmula: </code> to table for bulk actions options on row select</p>

                <div class="table-responsive">
                    <table class="table table-striped jambo_table bulk_action">
                        <thead>
                            <tr class="headings">
                                <th class="column-title">Bimestre </th>
                                <th class="column-title">Capacidad </th>
                                <th class="column-title">Evaluación </th>
                                <th class="column-title">Descripcion de evaluación</th>
                                <th class="column-title">Peso</th>
                                <th class="column-title">Nota</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach($bodyData->array_result_alumno[$nom_curso->id] as $clave => $detalle): ?>
                            <tr class="even pointer">
                                <td class=" ">
                                    <?=$detalle['Bimestre']?>
                                </td>
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
                                <td class=" ">
                                    <?=$detalle['Nota']?>
                                </td>
                            </tr>
                            <?php endforeach;?>
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