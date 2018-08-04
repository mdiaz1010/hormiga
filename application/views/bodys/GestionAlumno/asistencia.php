<?php if ($bodyData->respuesta>0) {
    ?>
<div class="row">
    <div class="col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>CONSULTAR ASISTENCIA DE SALONES</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li>
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </li>

                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">


                <form method="post" name="crearusuario" id="crearusuario">
                    <div class="form-group">
                        <label class="control-label col-md-12 col-sm-12 col-xs-12">
                            Curso:
                            <select name="rol_curso" class="form-control" id='rol_curso' required>
                                <option value="total">TOTAL</option>
                                <?php foreach ($bodyData->cursos as $cursos):?>
                                <option name='opciones' value="<?=$cursos->id?>">
                                    <?=$cursos->nom_cursos?>
                                </option>
                                <?php endforeach; ?>

                            </select>
                        </label>

                    </div>


                </form>

            </div>
        </div>
    </div>


    <div class="col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>ASISTENCIA</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li>
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </li>

                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">


                <div class="table-responsive" id="bandejaAsistenciaAlu"></div>

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
<script type="text/javascript" src="<?= base_url('publico/js_vistas/js/GestionAlumno_asistencia.js')?>"></script>
<?php
} else {
        echo "No cuenta con la información necesaria para mostrar esta interfaz.";
    }
?>