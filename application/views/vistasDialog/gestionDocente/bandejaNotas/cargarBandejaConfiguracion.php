<form name="registrarNotasConf" id="registrarNotasConf" method='POST' >
                              <input type="hidden" name="grado" id="grado" value="<?=$bodyData->datos_usuario['grado']?>">
                      
                              <input type="hidden" name="curso" id="curso" value="<?=$bodyData->datos_usuario['curso']?>">
                              <input type="hidden" name="nota" id="nota" value="<?=$bodyData->datos_usuario['nota']?>">
                              <input type="hidden" name="profesor" id="profesor" value="<?=$bodyData->datos_usuario['profesor']?>">
                              <input type="hidden" name="ano" id="ano" value="<?=$bodyData->datos_usuario['ano']?>">
<table class="table table-bordered" border="1"  cellspacing="0" width="80%" id="configuracion" name="configuracion">
                                    <thead class="bg-success" >
                                        <tr>
                                                <th  style="border: hidden;color: #3b752e;"><center>Abreviacion</center>          </th>
                                                <th  style="border: hidden;color: #3b752e;"><center>Descripcion</center>        </th>                                            
                                                <th  style="border: hidden;color: #3b752e;"><center>Peso</center>   </th>      
                                                <th  style="border: hidden;color: #3b752e;"><center>Opciones</center>   </th>                                    
                                        </tr>
                                    </thead>
                                    <tbody>       
                                         <?php $i=0; foreach($bodyData->datos as $dato): ?>
                                                  <tr id="<?=$dato['abreviacion']?>" bgcolor="#A9F5A9">                                   
                                                        <td><CENTER><?=$dato['abreviacion'];?> </CENTER></td>
                                                        <td><CENTER><?=$dato['descripcion'];?> </CENTER></td>
                                                        <td><CENTER><?=$dato['peso']*100;?>% </CENTER></td>
                                                        <td >
                                                            <CENTER>                                                                
                                                                <input name="txtmarcado[]" id="txtmarcado" data-codigo='<?=$dato['abreviacion'];?>' data-peso='<?=$dato['peso']*100?>' class='eliminarPeso' type="checkbox">
                                                                
                                                            </CENTER>
                                                        </td>
                                                  </tr>                     
                                         <?php endforeach; ?>                                                                        
                                    </tbody>
                                    <input type="hidden" name="not" id="not" >
                                    <input type="hidden" name="descontar" id="descontar" >
                                    
</table>
</form>
<div class="container">
        <center>
            <strong>
                <h5><?=$bodyData->formula?></h5>
            </strong>
        </center>
</div>
<script>

$(".eliminarPeso").click(function(){
    var arrayMarcado=[];
    var arrayPeso=0;
    var i=0;
    $("input[name='txtmarcado[]']:checked").each(function() {			
			var value       = $(this).val();
            var codigo      = $(this).data('codigo');
            var peso        = $(this).data('peso');	
       
                            arrayPeso=parseInt(arrayPeso)+parseInt(peso);   
                            arrayMarcado.push(codigo);
            alert(arrayMarcado[i]); return true;
            if($("input[name='txtmarcado[]']:checked").checked){
                $("#"+codigo).attr("bgcolor","#F8E0E0");	
            }else{
                $("#"+codigo).attr("bgcolor","#A9F5A9");	
            }
            i++;
                    
		});      

    list_final= arrayMarcado.join();


    var grado=$("#grado").val();
    var curso=$("#curso").val();
    var nota=$("#nota").val();
    var codigo = $(this).data('codigo');
    cod='';
    $("#not").val(list_final);
    $("#descontar").val(parseInt(arrayPeso));

    
    $("#not").val();
    var profesor=$("#profesor").val();
   

    });
</script>
