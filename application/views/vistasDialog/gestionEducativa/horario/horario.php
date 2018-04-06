<?php ?>
                           
<form action="" name="formhorario" id="formhorario">
                                      
                                <table class="table table-striped table-bordered dt-responsive nowrap  " cellspacing="0" width="100%" id="dataTables-cursos">
                                    <thead class="bg-success" >
                                        <tr>
                                     <th style="border: hidden;color: #3b752e;"><center>ELEGIR       </center></th>
                                     <th style="border: hidden;color: #3b752e;"><center>HORARIO      </center></th>                                               
                                     <th style="border: hidden;color: #3b752e;"><center>TURNO        </center></th> 

                                        </tr>
                                    </thead>                                   
                                    <tbody>  
                                        <?php  foreach($bodyData->horario as $horarios): 
                                            for($i=0;$i<count($bodyData->horarios);$i++){
                                                if($bodyData->horarios[$i]==$horarios->codigo){
                                                    $checked='checked'; break;
                                                }else{
                                                    $checked=''; 
                                            }
                                                }
                                              
                                            ?>
                                        
                                                  <tr>  
                                                      <td><CENTER><input type="checkbox" size="5" onkeyup="aMays(event, this)" id="elegir" name="elegir[]" class="texto10negro"   <?= $checked; ?>  maxlength="50"  value="<?= $horarios->codigo;?>" /></CENTER></td>
                                                      <td><CENTER><?= $horarios->horarios; ?></CENTER></td>
                                                      <td><CENTER><?= $horarios->turnos;   ?></CENTER></td>                                                      
                                                  </tr>
                                            <?php 
                                        endforeach; ?>          
                                    </tbody>              
                                </table>
</form>    
<script type="text/javascript">
$(document).ready(function() {
    $('#enviar').click(function(){

    });         
});    

</script>