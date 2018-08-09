<?php if ($bodyData->respuesta==1) {
    ?>
<div class="row">
            <div class="col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>CONFIGURACION DE NOTAS</h2>
                    <ul class="nav navbar-right panel_toolbox">

                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">


            <form  method="post"  name="crearusuario" id="crearusuario" >
                <div class="form-group" >

                <label class="control-label col-md-4 col-sm-4 col-xs-12">
                    Grado:
                    <select name="rol_grado"  class="form-control" id='rol_grado' required>
                        <option >Seleccione</option>
                        <?php
                        foreach ($bodyData->valores as $rolesTemp) {
                            ?>
                            <option name='opciones' value="<?=$rolesTemp->id?>"><?=$rolesTemp->nom_grado?></option>
                        <?php
                        } ?>
                    </select>
                </label>
                <label class="control-label col-md-4 col-sm-4 col-xs-12">
                    Curso:
                    <select name="rol_seccion"  class="form-control" id='rol_seccion' required></select>
                </label>
                <label class="control-label col-md-4 col-sm-4 col-xs-12">
                    Nota:
                    <select name="rol_nota"    class="form-control" id='rol_nota' required></select>
                </label>
                </div>
                       </form>



                  </div>
                </div>
              </div>
                <div class="col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>AGREGAR NOTAS</h2>
                    <ul class="nav navbar-right panel_toolbox">
                    <li><button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm">Leyenda de Notas</button></li>

                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="table-responsive" id="bandejaNotas"></div>
                  </div>
                </div>
              </div>
</div>


<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel2">Leyenda de notas</h4>
      </div>
      <div class="modal-body">


        <table>
              <thead align="center">
                <tr align="center">
                <td>  </td>
                        <td colspan="2"> <p class="circulo"></p>   </td>

                        <td >   Nota eliminada       </td>

                </tr>

                <tr ></tr>

                <tr align="center">
                <td></td>
                        <td colspan="2">  <p class="circulo2"></p>   </td>

                        <td > Nota  registrada    </td>
                </tr>
                </thead>
        </table>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>

      </div>

    </div>
  </div>
</div>
<div id="DIVcargas"       title="EN PROCESO ... ">
 Espere mientras se gestiona la informaci&oacute;n.
<span class="fa fa-spinner fa-pulse fa-2x fa-fw"></span>
</div>

<script type="text/javascript" src="<?= base_url('publico/js_vistas/js/GestionDocente_configuracion.js')?>"></script>
<?php
} else {
                            echo "No cuenta con la información necesaria registrada para mostrar esta interfaz.";
                        } ?>
<input type="hidden" name="url" id="url" value="<?= base_url(); ?>">
<style>
.circulo {
     width: 40px;
     height: 40px;
     -moz-border-radius: 50%;
     -webkit-border-radius: 50%;
     border-radius: 50%;
     background: #F8E0E0;
}
.circulo2 {
     width: 40px;
     height: 40px;
     -moz-border-radius: 50%;
     -webkit-border-radius: 50%;
     border-radius: 50%;
     background: #E0ECF8;
}
</style>