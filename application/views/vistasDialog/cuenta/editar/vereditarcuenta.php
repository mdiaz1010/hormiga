<?php
?>
              <div class="col-md-12 col-sm-12 col-xs-12">               
                  <div class="x_content">                        
                        <form action="" method="post" name="edicioncuenta" id="edicioncuenta" >
                            <div class="form-group" >
                            <label class="control-label col-md-12 col-sm-12 col-xs-12">
                                Nombre:
                                <input  type="hidden"    id='txtid' name="txtid"  value="<?php echo $bodyData->datoscuenta[0]->CODIGO; ?>"  >
                                <input  type="text"    class="form-control"  id='txtnombrecuenta'  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"  name="txtnombrecuenta"    value="<?php echo $bodyData->datoscuenta[0]->NOMBRE; ?>"  >
                            </label>
                            <label class="control-label col-md-12 col-sm-12 col-xs-12">
                                Apellido Paterno:
                                <input  type="text"    class="form-control"  id='txtapepatcuenta'  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"  name="txtapepatcuenta"   size="35" value="<?php echo $bodyData->datoscuenta[0]->APEPAT; ?>"  ></td>                
                            </label>                    
                            <label class="control-label col-md-12 col-sm-12 col-xs-12">
                                Apellido Materno:
                                <input  type="text"    class="form-control" id='txtapematcuenta'  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"  name="txtapematcuenta"   size="35" value="<?php echo $bodyData->datoscuenta[0]->APEMAT; ?>"  >
                            </label>                
                            <label class="control-label col-md-12 col-sm-12 col-xs-12">
                                Rol:
                                <select name="txtrolcuenta"  class="form-control" id='txtrolcuenta' required>                        
                                    <?php
                                    foreach ($bodyData->roles as $rolesTemp) {
                                        if($rolesTemp->id==$bodyData->datoscuenta[0]->USUARR){ $selected="selected";
                                    ?>
                                    <option name='opciones' selected value="<?=$rolesTemp->id?>"><?=$rolesTemp->nombre?></option>
                                    <?php
                                    }else{
                                        ?>
                                        <option name='opciones' value="<?=$rolesTemp->id?>"><?=$rolesTemp->nombre?></option>
                                        <?php
                                    }}
                                    ?>
                                </select>                    
                            </label>                
                            <label class="control-label col-md-12 col-sm-12 col-xs-12">
                                Telefono: 
                                <input  type="text"  class="form-control"  id='txttelefocuenta'  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"  name="txttelefocuenta"  size="35" value="<?php echo $bodyData->datoscuenta[0]->TELEFO; ?>"  >
                            </label>                  
                            <label class="control-label col-md-12 col-sm-12 col-xs-12">
                                Dni:
                                <input  type="text"  class="form-control"   id='txtdocumecuenta'  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"  name="txtdocumecuenta"   size="35" value="<?php echo $bodyData->datoscuenta[0]->DOCUME; ?>"  >
                            </label>        
                            <label class="control-label col-md-12 col-sm-12 col-xs-12">
                                Email:
                                <input  type="email"   class="form-control"  id='txtemailscuenta'    name="txtemailscuenta"   size="35" value="<?php echo $bodyData->datoscuenta[0]->CORREO; ?>"  >
                            </label>  
                            <label class="control-label col-md-12 col-sm-12 col-xs-12">
                                Usuario:
                                <input  type="text"   class="form-control"  id='txtusuaricuenta'    name="txtusuaricuenta"   size="35" value="<?php echo $bodyData->datoscuenta[0]->USUARI; ?>"  >
                            </label>  
                            <label class="control-label col-md-12 col-sm-12 col-xs-12">
                                Clave:
                                <input  type="text"   class="form-control"  id='txtclavescuenta'    name="txtclavescuenta"   size="35" value="<?php echo $bodyData->datoscuenta[0]->CLAVES; ?>"  >
                            </label>                                  
                            </div>
                            <div class="form-group">

                            <label class="control-label col-md-12 col-sm-12 col-xs-12">
                                Direccion: 
                                <textarea class="form-control  col-lg-3" name="txtdirecccuenta" id="txtdirecccuenta" type="text" placeholder="Breve descripcion..." rows="2" id="comment"><?php echo $bodyData->datoscuenta[0]->DIRECC; ?></textarea>
                            </label>                                                                    
                            </div>                          
                        </form>                                                                 
                  </div>                                                                                          
              </div>