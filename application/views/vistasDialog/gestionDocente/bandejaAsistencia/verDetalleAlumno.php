                <div class="col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><font style="font-style: italic;"><?=$bodyData->alumno;?></h2>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">               
                        <div class="table-responsive">                                          
                                <table class="table table-striped table-bordered dt-responsive nowrap " cellspacing="0" width="100%" id="dataTables-asistedet">
                                    <thead class="bg-success" >
                                        <tr>
                                     <th  style="border: hidden;color: #3b752e;"><center>NRO</center>          </th>
                                     <th  style="border: hidden;color: #3b752e;"><center>FECHA</center>        </th>                                            
                                     <th  style="border: hidden;color: #3b752e;"><center>ASISTENCIA</center>   </th>
                                     <th  style="border: hidden;color: #3b752e;"><center>MOTIVO</center>       </th>
                                     <th  style="border: hidden;color: #3b752e;"><center>JUSTIFICADO</center>  </th>
                                        </tr>
                                    </thead>                                   
                                    <tbody>       
                                            <?php
                                                
                                            $i=1;
                                            $j=0;
                                            $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
                                            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                                            foreach ($bodyData->results as $cuentasTemp) { 
                                                if(trim($cuentasTemp->asistencia)=='f'){
                                                    $color='bgcolor="#F78181"';
                                                    //$color='bgcolor="#F7819F"';
                                                }else{
                                                    $color='';
                                                }
                                            ?>
                                                  <tr id="<?=$i?>" >
                                                        <input type="hidden" name="ano[]" id="ano" value="<?=$cuentasTemp->ano?>">
                                                        <input type="hidden" name="mes[]" id="mes" value="<?=$cuentasTemp->mes?>">
                                                        <input type="hidden" name="dia[]" id="dia" value="<?=$cuentasTemp->dia?>">                                    
                                                        <td     <?=$color;?>><CENTER> <?= $i;?></CENTER></td>
                                                        <td     <?=$color;?>><CENTER> <?= $cuentasTemp->dia." de ".$meses[$cuentasTemp->mes-1];?></CENTER></td>
                                                        <td     <?=$color;?>><CENTER><strong><?=strtoupper($cuentasTemp->asistencia);?></strong></CENTER></td>
                                                        <td     <?=$color;?>><CENTER><textarea rows="2" readonly class="form-control"><?=$cuentasTemp->mensaje?></textarea></CENTER></td>
                                                        <?php if($cuentasTemp->respuesta=='1'){$mensaje='SI';}else if($cuentasTemp->respuesta=='2'){$mensaje='NO';}else{$mensaje='';} ?>
                                                        <td     <?=$color;?>><CENTER><?=$mensaje;?></CENTER></td>
                                                  </tr>
                                            <?php
                                               $i++;
                                               $j++;}
                                            ?>                                        
                                           
                                    </tbody>
                                </table>
                               </div>                                                               
                  </div>
                </div>
              </div>   
    

<script>           
</script>  
<script type="text/javascript">
$("#dataTables-asistedet").dataTable();	
</script>