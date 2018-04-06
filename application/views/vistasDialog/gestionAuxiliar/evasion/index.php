<?php if(($bodyData->results)!=0){ ?>                        
                            <form name="registroMarca" id="registroMarca" method="POST" >                                             
                                <table class="table table-striped table-bordered dt-responsive nowrap  " cellspacing="0" width="100%" id="dataTables-asistencia5">
                                    <thead class="bg-success" >
                                        <tr>
                                     <th style="border: hidden;color: #3b752e;"><center>NRO</center>         </th>
                                     <th style="border: hidden;color: #3b752e;"><center>ALUMNO</center>      </th>    
                                     <th style="border: hidden;color: #3b752e;"><center>GRADO Y SECCION</center>      </th>    
                                     <th style="border: hidden;color: #3b752e;"><center>CURSO</center></th>
                                     <th style="border: hidden;color: #3b752e;"><center>FECHA</center>  </th>                                    
                                     <th style="border: hidden;color: #3b752e;"><center>TIPO</center>
                                    
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i=1;
                                    foreach($bodyData->results as $resultado): ?>
                                        <tr>    
                                    <td style="width:1px;"><center><?=$i?></center></td>
                                    <td style="width:20px;"><?=$resultado['nombre']?></td>
                                    <td style="width:2px;"><center><strong><?=$resultado['grados']?></strong></center></td>
                                    <td style="width:20px;"><center><?=$resultado['cursos']?></center></td>
                                    <td style="width:20px;"><center><?=$resultado['fechas']?></center></td>                                    
                                    <td>   
                                    <center>                                     
                                        <select name="respuesta[]" id="respuesta[]"     class="form-control"
                                                                                 data-grado  ="<?=$resultado['id_grado']?>" 
                                                                                 data-seccion="<?=$resultado['id_seccion']?>" 
                                                                                 data-curso  ="<?=$resultado['id_curso']?>" 
                                                                                 data-alumno ="<?=$resultado['id_alumno']?>" 
                                                                                 data-id     ="<?=$resultado['id']?>"
                                                                                 data-fecha  ="<?=$resultado['fechas']?>"                                                                                                
                                                >
                                        <option value="0">Sin revisar</option>    
                                        <?php
                                        foreach($bodyData->resultado as $result){
                                        if($resultado['respuesta']==$result->id){$selected='selected';}else{$selected="";}
                                        if($result->id==1){$valor="EVASION";}else if($result->id==2){$valor="JUSTIFICADO";}else{$valor="Sin revisar";}
                                        ?>                                        
                                        <option <?=$selected?> value="<?=$result->id?>"><?=$valor?></option>
                                        <?php } ?>
                                        </select> 
                                    </center>
                                    </td>

                                        </tr>
                                    <?php $i++;
                                    endforeach; ?>                                            
                                    </tbody>                                                                        
                                </table>
                            </form>                    
<?php }else{
echo "<div class='alert_result'>No hay registro de inasistencia justificada.</div>";
} ?>
<script type="text/javascript">  
$("#dataTables-asistencia5").dataTable();	

$('[id="respuesta[]"]').change(function(){    

  
  var tipo       =$(this).val(); 
  var grado      = $(this).data("grado");
  var seccion    = $(this).data("seccion");
  var curso      = $(this).data("curso");
  var alumno     = $(this).data("alumno");
  var codigo     = $(this).data("id");
  var fecha      = $(this).data("fecha");
  
  
    $.post( "registrarObservacion", {codigo:codigo,tipo:tipo,grado:grado,seccion:seccion,curso:curso,alumno:alumno,fecha:fecha});
});              

</script>