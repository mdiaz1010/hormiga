<?php if ($bodyData->resultado<1) {
    ?>

<div class="row">
    <div class="col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>GENERACIÓN DE LIBRETAS</h2>
                <ul class="nav navbar-right panel_toolbox">

                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">


                <form method="post" name="crearusuario" id="crearusuarioss">
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">
                            GRADO
                            <select name="rol_grado" class="form-control" id='rol_grado' required></select>
                        </label>
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">
                            SECCION
                            <select name="rol_seccion" class="form-control" id='rol_seccion' required></select>
                        </label>
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">
                            BIMESTRE
                            <select name="rol_bimestre" class="form-control" id='rol_bimestre' required></select>
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
                <h2>Generación de libretas
                    <?=$bodyData->anos?>
                </h2>
                <ul class="nav navbar-right panel_toolbox">

                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <div class="table-responsive" id="bandejaGeneral">Ingresar El bimestre...</div>



            </div>
        </div>
    </div>



</div>
<div id="DIVcargas"       title="EN PROCESO ... ">
 Espere mientras se gestiona la informaci&oacute;n.
<span class="fa fa-spinner fa-pulse fa-2x fa-fw"></span>
</div>
<script type="text/javascript" src="<?= base_url('publico/js_vistas/js/GestionEducativa_notasTQ.js')?>"></script>
<?php
} else {
                                            echo "No se cuenta con la informacion necesaria registrada.";
                                        } ?>