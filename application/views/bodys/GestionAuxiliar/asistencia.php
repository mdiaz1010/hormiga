                <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="">
                    <h2>GESTION DE ASITENCIA</h2>
                    <ul class="nav navbar-right panel_toolbox">

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                <form  method="post"  name="crearusuario" id="crearusuario" >

                <label class="control-label col-md-6 col-sm-6 col-xs-12">
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
                <label class="control-label col-md-6 col-sm-6 col-xs-12">
                    Seccion:
                    <select name="rol_seccion"  class="form-control" id='rol_seccion' required></select>
                </label>





                </form>
                  </div>




                  </div>
                </div>
              <input type="hidden" name="url" id="url" value="<?= base_url(); ?>">
               <div class="col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>ASISTENCIA</h2>
                    <ul class="nav navbar-right panel_toolbox">

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
<div id="DIVcargas"       title="EN PROCESO ... ">
 Espere mientras se gestiona la informaci&oacute;n.
<span class="fa fa-spinner fa-pulse fa-2x fa-fw"></span>
</div>

<script type="text/javascript" src="<?= base_url('publico/js_vistas/js/GestionAuxiliar_asistencia.js')?>"></script>