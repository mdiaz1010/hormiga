<?php if ($bodyData->resultado<1) {
    ?>
<div class="row">
    <div class="col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>REPORTE DE NOTAS POR GRADO</h2>
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


                <form method="post" name="crearusuario" id="crearusuarioss">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                            AÑO
                            <select name="rol_ano" class="form-control" id='rol_ano' required>
                                <option>Seleccione</option>
                                <?php
                                        foreach ($bodyData->ano as $rolesTemp) {
                                            ?>
                                    <option name='opciones' value="<?=$rolesTemp->ano?>">
                                        <?=$rolesTemp->ano?>
                                    </option>
                                    <?php
                                        } ?>
                            </select>
                        </label>
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                            GRADO
                            <select name="rol_grado" class="form-control" id='rol_grado' required></select>
                        </label>
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                            BIMESTRE
                            <select name="rol_bimestre" class="form-control" id='rol_bimestre' required></select>
                        </label>
                    </div>
                </form>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">
                        <label>Fecha:</label>
                        <div class='input-group date'>
                            <input type='text' name="fecha" id='fecha' class="form-control " disabled="true" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </label>
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">
                        <label>Hora:</label>
                        <div class='input-group date' name="horadiv" id="horadiv">
                            <input type='text' name="hora" id='hora' class="form-control " disabled="true" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </label>
                </div>


            </div>
        </div>
    </div>


    <div class="col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Reporte de Notas
                    <?=$bodyData->anos?>
                </h2>
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

                <div class="table-responsive" id="bandejaGeneral">Ingresar El bimestre...</div>



            </div>
        </div>
    </div>



</div>
<script type="text/javascript" src="<?= base_url('publico/js_vistas/js/GestionEducativa_notasG.js')?>"></script>
<?php
} else {
                                            echo "No se cuenta con la informacion necesaria registrada.";
                                        } ?>