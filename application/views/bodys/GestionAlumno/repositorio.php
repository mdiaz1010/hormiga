<?php if($bodyData->respuesta>0){ ?>
<div class="row">

                <div class="col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>REPOSITORIO VIRTUAL DEL <?=$bodyData->grado[0]->nom_grado.'°'.$bodyData->seccion[0]->nom_seccion.' DE SECUNDARIA'?></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

            <form  method="post"  name="mostramaterial" id="mostramaterial">
   
                <input type="hidden" name='txtgrado'   id="txtgrado"   value="<?=$bodyData->grado[0]->id?>" >
                <input type="hidden" name='txtseccion' id="txtseccion" value="<?=$bodyData->seccion[0]->id?>" >
                
            </form>           
                    <div class="form-group" >
                    <div class="col-xs-12">     
                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                    Curso:
                    <select name="rol_curso"    class="form-control" id='rol_curso' required>
                        <option name="select"  value="">Seleccione</option>
                        <?php foreach($bodyData->curso as $curso):?>
                        <option name="select"  value="<?=$curso->id?>"><?=$curso->nom_cursos?></option>
                        
                        <?php endforeach;?>
                        
                    </select>
                    
                </label> 
                               
                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                    Bimestre:
                    <select name="rol_bimestre"    class="form-control" id='rol_bimestre' required></select>
                
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
                    </div>
                    </div>                                                

                  </div>
                </div>
              </div> 


   <div class="col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                      <h2>MATERIAL DE CURSO</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                      <div class="table-responsive" id="bandejaMaterialAlumno"></div>
                  </div>
                </div>
              </div>                                                 
   </div>
<script type="text/javascript" src="<?= base_url('publico/js_vistas/js/GestionAlumno_material.js')?>"></script>
<?php }else{
echo "No cuenta con la información necesaria para mostrar esta interfaz.";    
}
?>