<?php if ($bodyData->respuesta>0) {
    ?>
<div class="row">

    <div class="col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>REPOSITORIO VIRTUAL DEL
                    <?=$bodyData->grado[0]->nom_grado.'°'.$bodyData->seccion[0]->nom_seccion.' DE SECUNDARIA'?>
                </h2>
                <ul class="nav navbar-right panel_toolbox">

                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <form method="post" name="mostramaterial" id="mostramaterial">
                    <div class="form-group">
                    <input type="hidden" name='txtgrado' id="txtgrado" value="<?=$bodyData->grado[0]->id?>">
                    <input type="hidden" name='txtseccion' id="txtseccion" value="<?=$bodyData->seccion[0]->id?>">
                    </div>
                </form>
                <div class="form-group">
                    <div class="col-xs-12">
                        <label class="control-label col-md-6 col-sm-6 col-xs-12">
                            Curso:
                            <select name="rol_curso" class="form-control" id='rol_curso' required>
                                <option name="select" value="">Seleccione</option>
                                <?php foreach ($bodyData->curso as $curso):?>
                                <option name="select" value="<?=$curso->id?>">
                                    <?=$curso->nom_cursos?>
                                </option>

                                <?php endforeach; ?>

                            </select>

                        </label>

                        <label class="control-label col-md-6 col-sm-6 col-xs-12">
                            Bimestre:
                            <select name="rol_bimestre" class="form-control" id='rol_bimestre' required></select>

                        </label>

                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>REPOSITORIO</h2>
                <ul class="nav navbar-right panel_toolbox">


                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <div class="table-responsive" id="bandejaMaterialAlumno"></div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="url" id="url" value="<?=site_url()?>">
<div id="DIVcargas" title="EN PROCESO ... ">
    Espere mientras se gestiona la informaci&oacute;n.
    <span class="fa fa-spinner fa-pulse fa-2x fa-fw"></span>
</div>
<script type="text/javascript" src="<?= base_url('publico/js_vistas/js/GestionAlumno_material.js')?>"></script>
<?php
} else {
        echo "No cuenta con la información necesaria para mostrar esta interfaz.";
    }
?>