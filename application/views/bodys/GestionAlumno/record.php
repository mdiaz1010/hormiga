<div class="row">
    <div class="col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>CONSULTA DE NOTAS</h2>
                <ul class="nav navbar-right panel_toolbox">

                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <form method="post" name="consultarNotas" id="consultarNotas">
                    <div class="form-group">
                        <label class="control-label col-md-6 col-sm-6 col-xs-12">
                            A&ntilde;o de estudio:
                            <select name="rol_ano" class="form-control" id='rol_ano' required>
                                <option>Seleccione</option>
                                <?php
                        foreach ($bodyData->valores as $rolesTemp) {
                            ?>
                                    <option name='opciones' value="<?=$rolesTemp['ano']?>">
                                        <?=$rolesTemp['ano'].' '.$rolesTemp['grado'].'°'.$rolesTemp['seccion']?>
                                    </option>
                                    <?php
                        }
                        ?>
                            </select>
                        </label>
                        <label class="control-label col-md-6 col-sm-6 col-xs-12">
                            Cursos:
                            <select name="rol_curso" class="form-control" id='rol_curso' required></select>
                        </label>


                    </div>


                </form>

            </div>
        </div>
    </div>


    <div class="col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>HISTÓRICO</h2>
                <ul class="nav navbar-right panel_toolbox">


                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <div class="table-responsive" id="bandejaNotasRecord"></div>
            </div>
        </div>
    </div>



</div>

<div id="DIVVERDETALLE" title="INTRANET :: Ver asistencia"></div>
<input type="hidden" name="url" id="url" value="<?=site_url()?>">
<div id="DIVcargas" title="EN PROCESO ... ">
    Espere mientras se gestiona la informaci&oacute;n.
    <span class="fa fa-spinner fa-pulse fa-2x fa-fw"></span>
</div>
<script type="text/javascript" src="<?= base_url('publico/js_vistas/js/GestionAlumno_record.js')?>"></script>