<?php




?>

 
    
    <center class="nombreUsuario" style=" ">
        <h3 class=" text-success" >Datos del Proyecto</h3>
    
        <form action="<?= site_url('Proyecto/editPerfil')?>" method="post">
             <td><input type="hidden" name="id"  style='width:285px; height:35px' value="<?=$bodyData->valoresSueltos["id"]?>"  class="form-control" placeholder="Nombre y Apellido" required onkeyup="javascript:this.value=this.value.toUpperCase();"> </td>
            <table class="table-striped">
                <tr>
                    <td>Nombre del proyecto</td>
                   
                    <td><input type="text" name="nombres" style='width:375px; height:35px' value="<?=$bodyData->valoresSueltos["nombre"]?>"  class="form-control" placeholder="Nombre y Apellido" required onkeyup="javascript:this.value=this.value.toUpperCase();"> </td>
                </tr>
                <tr>
                          <td>Cliente</td>             
                          <td>               <select name="webusuarios_id"   class="form-control" required>
                                       
                                               
                                                            <?php 
                                                            $valor=$bodyData->valoresSueltos["codigo"];
                                                            foreach ($bodyData->roles as $rolesTemp) {
                                                                ?>
                                                                <?php  if ($valor==$rolesTemp->codigoEmpresa) {
                                                                    ?>
                                                                <option name='opciones' id='opciones'                                                                
                                                                        selected
                                                                        value="<?=$rolesTemp->codigoEmpresa?>"><?=$rolesTemp->nombre?>-<?=$rolesTemp->nombreLocal?>
                                                                        
                                                                 <?php
                                                                } else {
                                                                    ?>                                                                
                                                                <option  name='opciones' id='opciones'  value="<?=$rolesTemp->codigoEmpresa ?>"><?=$rolesTemp->nombreLocal?>                                                                         
                                                                 <?php
                                                                }
                                                            }?>
                                                                 </option>
                                                                                                                              
                                                            <?php

                                                            
                                                            ?>
                              </select>
                          </td>
                
                <tr>

                <tr>
                          <td>Status</td>             
                          <td>            <select name="status_id"   class="form-control" required>    
                                                            <?php 
                                                            $valor=$bodyData->valoresSueltos["status"];
                                                            foreach ($bodyData->status as $rolesTemp) {
                                                                ?>
                                                                <?php  if ($valor==$rolesTemp->id) {
                                                                    ?>
                                                                <option name='opciones' id='opciones'                                                                
                                                                        selected
                                                                        value="<?=$rolesTemp->id ?>"><?=$rolesTemp->descripcion?>
                                                                 <?php
                                                                } else {
                                                                    ?>                                                                
                                                                <option  name='opciones' id='opciones'  value="<?=$rolesTemp->id ?>"><?=$rolesTemp->descripcion?>                                                                         
                                                                 <?php
                                                                }
                                                            }?>
                                                                 </option>
                                                                                                                              
                                                            <?php

                                                            
                                                            ?>
                              </select>                                                                
                          </td> 
                <tr>
                <tr>
                          <td>Definir Tarea</td>             
                          <td>            <select name="tarea_id"   class="form-control" required>    
                                                            <?php 
                                                            $valor=$bodyData->valoresSueltos["tarid"];
                                                            foreach ($bodyData->combo1 as $rolesTemp) {
                                                                ?>
                                                                <?php  if ($valor==$rolesTemp->id) {
                                                                    ?>
                                                                <option name='opciones' id='opciones'                                                                
                                                                        selected
                                                                        value="<?=$rolesTemp->id ?>"><?=$rolesTemp->nombreTarea?>
                                                                 <?php
                                                                } else {
                                                                    ?>                                                                
                                                                <option  name='opciones' id='opciones'  value="<?=$rolesTemp->id ?>"><?=$rolesTemp->nombreTarea?>                                                                         
                                                                 <?php
                                                                }
                                                            }?>
                                                                 </option>
                                                                                                                              
                                                            <?php

                                                            
                                                            ?>
                                         </select>                                                                
                          </td> 
                <tr>                 
                <tr>
                          <td>Tipo de Proyecto</td>             
                          <td>            <select name="tipoproyecto_id"   class="form-control" required>    
                                                            <?php 
                                                            $valor=$bodyData->valoresSueltos["tipoProyecto"];
                                                            foreach ($bodyData->tipoProy as $rolesTemp) {
                                                                ?>
                                                                <?php  if ($valor==$rolesTemp->id) {
                                                                    ?>
                                                                <option name='opciones' id='opciones'                                                                
                                                                        selected
                                                                        value="<?=$rolesTemp->id ?>"><?=$rolesTemp->descripcion?>
                                                                 <?php
                                                                } else {
                                                                    ?>                                                                
                                                                <option  name='opciones' id='opciones'  value="<?=$rolesTemp->id ?>"><?=$rolesTemp->descripcion?>                                                                         
                                                                 <?php
                                                                }
                                                            }?>
                                                                 </option>
                                                                                                                              
                                                            <?php

                                                            
                                                            ?>
                                         </select>                                                                
                          </td> 
                <tr>                  
                <tr>
                    <td>Periodo</td>
                    <td><input type="text" name="periodo" style='width:375px; height:35px' value="<?=$bodyData->valoresSueltos["periodo"]?>"  class="form-control" required  onkeyup="javascript:this.value=this.value.toUpperCase();"> </td>
                </tr>
                <tr>
                
                <tr></tr>
            
                <tr>
                    <td colspan="2" >
                        
                        <input type="submit" class="form-control submit btn-primary" value="Guardar"  >
                    </td>
                </tr>


            </table>

<br>


  



        </form>
             
    </center>
 <script>

 </script>