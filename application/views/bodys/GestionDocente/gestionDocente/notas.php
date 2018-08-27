<?php if ($bodyData->respuesta==1) {
    ?>
<div class="col-xs-12 col-md-12 col-sm-12 animated fadeInRight">

    <div class="x_panel">

        <div class="x_title">
            <h2>GESTION DE NOTAS</h2>

            <ul class="nav navbar-right panel_toolbox">




            </ul>

            <div class="clearfix"></div>

        </div>

        <div class="x_content">


            <form method="post" name="crearusuario" id="crearusuario">

                <div class="form-group">

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


    <div class="col-xs-12 col-md-12 col-sm-12 animated fadeInRight">

        <div class="x_panel ">
            <div class="x_title">
                <h2>NOTAS</h2>
                <div class="actions pull-right">
                <ul class="nav navbar-right panel_toolbox">


                    <!-- <i class="fa fa-times"></i>-->
                </ul>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <div id="bandejaNotas"></div>
            </div>

        </div>



    </div>
</div>

<div id="DIVcargas" title="EN PROCESO ... ">
    Espere mientras se gestiona la informaci&oacute;n.
    <span class="fa fa-spinner fa-pulse fa-2x fa-fw"></span>
</div>
<input type="hidden" name="url" id="url" value="<?= base_url(); ?>">
<script type="text/javascript" src="<?= base_url('publico/js_vistas/js/GestionDocente_notas.js')?>"></script>
<?php
} else {
                            echo "No cuenta con la información necesaria registrada para mostrar esta interfaz.";
                        } ?>