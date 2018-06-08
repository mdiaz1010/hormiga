<?php if ($bodyData->respuesta==1) {
    ?>
<div class="row">
    <div class="col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>REPORTE DE NOTAS</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li>
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </li>
                    <li>
                        <a class="close-link">
                            <i class="fa fa-close"></i>
                        </a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <div class="form-group">
                    <div class="col-sm-12">
                        <form method="post" name="reporteNotas" id="reporteNotas">
                            <div class="container">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                    Seccion:
                                    <select name="rol_seccion" class="form-control" id='rol_seccion' required></select>
                                </label>
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                    Curso:
                                    <select name="rol_curso" class="form-control" id='rol_curso' required></select>
                                </label>
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                    Bimestre:
                                    <select name="rol_bimestre" class="form-control" id='rol_bimestre' required></select>

                                </label>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xs-12">
        <div class="x_panel">
            <div class="x_title">

                <ul class="nav navbar-right panel_toolbox">
                    <li>
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </li>
                    <li>
                        <a class="close-link">
                            <i class="fa fa-close"></i>
                        </a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">



                <div class="table-responsive" id="bandejaReportN"></div>


            </div>
        </div>
    </div>

</div>
<script type="text/javascript" src="<?= base_url('publico/js_vistas/js/GestionDocente_reporteN.js')?>"></script>
<?php
} else {
                            echo "No cuenta con la información necesaria registrada para mostrar esta interfaz.";
                        } ?>