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
                                         <?php foreach($bodyData->datos as $dato): ?>
                                                  <tr >                                   
                                                        <td><CENTER><?=$dato['abreviacion'];?> </CENTER></td>
                                                        <td><CENTER><?=$dato['descripcion'];?> </CENTER></td>
                                                        <td><CENTER><?=$dato['peso']*100;?>% </CENTER></td>
                                                        <td>
                                                            <CENTER>                                                                
                                                                <a href="#">Eliminar</a>
                                                            </CENTER>
                                                        </td>
                                                  </tr>                     
                                         <?php endforeach; ?>                                                                        
                                    </tbody>
</table>
</form>


