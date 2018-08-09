<?php if ($bodyData->respuesta==1) {
    ?>
<div class="row">
    <div class="col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>GESTION DE ASITENCIA</h2>
                <ul class="nav navbar-right panel_toolbox">


                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <form method="post" name="crearusuario" id="crearusuario">
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">
                            Grado:
                            <select name="rol_grado" class="form-control" id='rol_grado' required>
                                <option>Seleccione</option>
                                <?php
                        foreach ($bodyData->valores as $rolesTemp) {
                            ?>
                                    <option name='opciones' value="<?=$rolesTemp->id?>">
                                        <?=$rolesTemp->nom_grado?>
                                    </option>
                                    <?php
                        } ?>
                            </select>
                        </label>
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">
                            Seccion:
                            <select name="rol_seccion" class="form-control" id='rol_seccion' required></select>
                        </label>
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">
                            Curso:
                            <select name="rol_curso" class="form-control" id='rol_curso' required></select>
                        </label>
                    </div>
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




</div>

<div id="DIVVERDETALLE" title="INTRANET :: Ver asistencia"></div>
<div id="DIVcargas" title="EN PROCESO ... ">
    Espere mientras se gestiona la informaci&oacute;n.
    <span class="fa fa-spinner fa-pulse fa-2x fa-fw"></span>
</div>

<script type="text/javascript" src="<?= base_url('publico/js_vistas/js/GestionDocente_asistencia.js')?>"></script>
<?php
} else { echo "No cuenta con la información necesaria registrada para mostrar esta interfaz."; } ?>