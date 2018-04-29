<?php

    $usuarioNombre = (empty($bodyData->usuario->user_name))? $bodyData->usuario : $bodyData->usuario->user_name;
    

?>
<!-- DATA -->
<div class="row" style="padding: 0px 50px 0px 50px;" > 
    <div class="panel panel-success">
        
        <div class="panel-heading">
            <h3><?= $bodyData->usuario->user_name?></h3>
            <span>
                Desde <?=date('Y-m-d', strtotime($bodyData->delimitadores->desde)) ?>
                Hasta <?=date('Y-m-d', strtotime($bodyData->delimitadores->hasta)) ?>
            </span>
        </div>
        
        <div class="panel-body">
        <!-- Table -->
         
        <table id="ajaxDataTable" class="table   table-striped table-responsive" style="font-size: 0.9em;">
                <thead>
                    <tr> 
                        <th>Id Usuario</th>
                        <th>Fecha</th>
                        <th>Modificado?</th>
                        <th>Horario O Excep</th>
                        <th>Hora Entrada Turno</th>
                        <th>Hora salida Turno</th>
                        <th>Marcación entrada</th>
                        <th>Marcación Salida	</th>
                        <th>Tiempo Trabajado</th>
                        <th>Tiempo Extra</th>
                        <th>Tiempo Adicional</th>
                        <th>Tiempo Presente</th> 
                        <th>Detalles</th> 

                    </tr>
                </thead>

                <tbody> 
                <?=$bodyData->tableTr;  ?> 
                </tbody>
            </table>
        </div>
    </div>
       
    <p><?=" Tiempo de Calculo : ". round($bodyData->tiempoEjecucion, 4)." Seg. "  ?></p>
</div>





 
<!-- /page content -->