<script src="https://use.fontawesome.com/a18b0c2e94.js"></script>
<a href="#" id="js_up" class="boton-subir">
  <!-- link del icono http://fontawesome.io/icon/rocket/ -->
  <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
</a>
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
                                <th class="column-title">Competencia </th>
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
                                        <strong>
                                            <?=$texto?>
                                        </strong>
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
        <style>
            .boton-subir {
                display: none;
                background: #2A3F54;
                border: thin solid #fff;
                border-radius: 3px;
                position: fixed;
                right: 15px;
                bottom: 2px;
                z-index: 999999999;
            }

            /*evento hover*/

            .boton-subir:hover {
                box-shadow: 0px 2px 10px 0px rgba(255, 255, 255, 0.75);
            }

            /*estilos para el tag i*/

            .boton-subir i {
                color: #fff;
                font-size: 1.5em;
                padding: 10px 10px 10px 7px;
                -ms-transform: rotate(-45deg);
                /* IE 9 */
                -webkit-transform: rotate(-45deg);
                /* Chrome, Safari, Opera */
                transform: rotate(-45deg);
            }
        </style>
        <script>


                $(window).scroll(function () {
                    if ($(this).scrollTop() > 300) { //condición a cumplirse cuando el usuario aya bajado 301px a más.
                        $("#js_up").slideDown(300); //se muestra el botón en 300 mili segundos
                    } else { // si no
                        $("#js_up").slideUp(300); //se oculta el botón en 300 mili segundos
                    }
                });

            //creamos una función accediendo a la etiqueta i en su evento click
            $("#js_up i").on('click', function (e) {
                e.preventDefault(); //evita que se ejecute el tag ancla (<a href="#">valor</a>).
                $("body,html").animate({ // aplicamos la función animate a los tags body y html
                    scrollTop: 0 //al colocar el valor 0 a scrollTop me volverá a la parte inicial de la página
                }, 700); //el valor 700 indica que lo ara en 700 mili segundos
                return false; //rompe el bucle
            });

        </script>