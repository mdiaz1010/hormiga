                <div class="col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>GESTION DE ASITENCIA</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                                                   
                <form  method="post"  name="crearusuario" id="crearusuario" >
                
                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                    Grado:
                    <select name="rol_grado"  class="form-control" id='rol_grado' required>
                        <option >Seleccione</option>
                        <?php
                        foreach ($bodyData->valores as $rolesTemp) {
                            ?>
                            <option name='opciones' value="<?=$rolesTemp['id']?>"><?=$rolesTemp['nom_grado']?></option>
                        <?php
                        }
                        ?>
                    </select>
                </label>
                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                    Seccion:
                    <select name="rol_seccion"  class="form-control" id='rol_seccion' required></select>
                </label>                    
                
                
                
                
                <label class="control-label col-md-3 col-sm-3 col-xs-12">                    
                <label>Fecha:</label>
                                    <div class='input-group date' >
                                        <input type='text' name="fecha" id='fecha' class="form-control "  disabled="true"/>
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                    </div>
                </label>                
                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                <label>Hora:</label>
                                        <div class='input-group date' name="horadiv" id="horadiv"  >    
                                         <input type='text' name="hora" id='hora' class="form-control "  disabled="true"/>                                           
                                        <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                        </div>
                </label>                    
                </form>       
                  </div>
                                                                    
                
                                               

                  </div>
                </div>
                 
               <div class="col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>REGISTRO DE ASISTENCIA</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                      <div class="table-responsive" id="bandejaAsistencia">                      
                      </div>
                  </div>
                </div>
              </div>  



                           
                      

<div id="DIVVERDETALLE" title="INTRANET :: Ver asistencia"></div>
<div id="DIVcargas"       title="EN PROCESO ... "> Espere mientras se gestiona la informaci&oacute;n.   <img src="<?= base_url('publico/media/loading.gif')?>"  width="20" height="20"> </div>
<script type="text/javascript" src="<?= base_url('publico/js_vistas/js/GestionAuxiliar_asistencia.js')?>"></script>