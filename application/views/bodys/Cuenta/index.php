<?php ?>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>
                    <span class="fa fa-search"></span> INTRANET EDUCATIVO - Carga Individual </h2>
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

                <form method="post" name="crearusuario" id="crearusuario">
                    <div class="form-group">
                        <label class="control-label col-md-6 col-sm-6 col-xs-12">
                            Apellidos y nombres:
                            <input name="apepat" id="apepat" placeholder="Apellidos y nombres" class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"
                                required>
                        </label>

                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                            Rol:
                            <select name="rol" class="form-control" id='rol' required>
                                <option></option>
                                <?php
                        foreach ($bodyData->roles as $rolesTemp) {
                            ?>
                                    <option name='opciones' value="<?=$rolesTemp->id?>">
                                        <?=$rolesTemp->nombre?>
                                    </option>
                                    <?php
                        }
                        ?>
                            </select>
                        </label>

                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                            Nombre de Usuario:
                            <input name="usuario" id="usuario" placeholder="Usuario de Acceso" class="form-control" required>
                        </label>

                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                            Contraseña:
                            <input name="pass" id="pass" placeholder="Contraseña de Acceso" type="password" class="form-control" required>
                        </label>
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                            Telefono:
                            <input name="telefono" id="telefono" placeholder="Telefono" type="text" class="form-control">
                        </label>
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                            Estado:
                            <select name="rol1" class="form-control" id='rol1' required>
                                <option name='opciones1' value="1">ACTIVO</option>
                                <option name='opciones1' value="2">INACTIVO</option>
                            </select>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                            Dni:
                            <input name="documento" id="documento" placeholder="documento" type="text" class="form-control" required>
                        </label>
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                            email:
                            <input name="email" id="email" placeholder="email" type="email " class="form-control" required>
                        </label>
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                            Direccion:
                            <input name="direccion" id="direccion" placeholder="Direccion " type="text " class="form-control" style="text-transform:uppercase;"
                                onkeyup="javascript:this.value=this.value.toUpperCase();">
                        </label>
                        <div class="col-xs-6 col-md-3">
                            <textarea class="form-control  col-md-6" name="descripcion" id="descripcion" type="text" placeholder="Breve descripcion..."
                                rows="2" id="comment"></textarea>
                        </div>
                    </div>

                    <div class="container" id="SoloCliente" style="display:none;">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                            Grado:
                            <select name="gradorol" class="form-control" id='gradorol' required>
                                <option disabled selected></option>
                                <?php
                        foreach ($bodyData->rolesGrado as $rolesTemp) {
                            ?>
                                    <option name='opciones' value="<?=$rolesTemp->id?>">
                                        <?=$rolesTemp->nom_grado?>
                                    </option>
                                    <?php
                        }
                        ?>
                            </select>

                            Seccion:
                            <select name="seccionrol" class="form-control" id='seccionrol' required>
                                <option disabled selected></option>
                                <?php
                        foreach ($bodyData->rolesSeccion as $rolesTemp) {
                            ?>
                                    <option name='opciones' value="<?=$rolesTemp->id?>">
                                        <?=$rolesTemp->nom_seccion?>
                                    </option>
                                    <?php
                        }
                        ?>
                            </select>
                        </label>
                    </div>

                    <label class="control-label col-md-6 col-sm-6 col-xs-12">
                        <button type="button" name="btnregistrar" id="btnregistrar" value="Registrar" class="form-control btn-success">
                            <strong>REGISTRAR</strong>
                            <span class="glyphicon glyphicon-ok"></span>
                        </button>
                    </label>
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">
                        <p id="result_error"></p>
                    </label>
                </form>
                <div class="col-xs-12">
                    <?=($this->session->flashdata('flashdata_respuesta')!=null)? '<h4 class="text-danger" >'.$this->session->flashdata('flashdata_respuesta')."</h4>":'' ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>
                    <span class="fa fa-search"></span> INTRANET EDUCATIVO - Carga Masiva profesores</h2>
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
                <label class="control-label col-md-6 col-sm-6 col-xs-12">Cargar Archivo:
                    <input type="file" name="archiMas" id="archiMas">
                </label>
                <br>
                <label class="control-label col-md-6 col-sm-6 col-xs-12">
                    <button type="button" name="btnMasivo" id="btnMasivo" value="Registrar" class="form-control btn-primary">
                        <strong>REGISTRAR</strong>
                        <span class="glyphicon glyphicon-ok"></span>
                    </button>
                </label>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>
                    <span class="fa fa-search"></span> INTRANET EDUCATIVO - Carga Masiva alumno</h2>
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
                <label class="control-label col-md-6 col-sm-6 col-xs-12">Cargar Archivo:
                    <input type="file" name="archiMasAlu" id="archiMasAlu">
                </label>
                <br>
                <label class="control-label col-md-6 col-sm-6 col-xs-12">
                    <button type="button" name="btnMasivoalu" id="btnMasivoalu" value="Registrar" class="form-control btn-primary">
                        <strong>REGISTRAR</strong>
                        <span class="glyphicon glyphicon-ok"></span>
                    </button>
                </label>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>
                    </span> Historial de Usuario</h2>
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
                <div class="table-responsive" id="bandejaprincipal"></div>

            </div>
        </div>
    </div>

</div>
<div id="DIVEDITARCUENTA" title="INTRANET :: Edicion de cuenta"></div>
<div id="DIVcargas" title="EN PROCESO">
    <center>
        <strong>Espere estamos cargando la informacion...</strong>
        <span class="fa fa-spinner fa-pulse fa-2x fa-fw"></span>
    </center>
</div>
<?php
    $headColor = array(1=>' panel-primary ',2=>' panel-success ',3=>' panel-info ',4=>' panel-warning ',5=>' panel-warning ',6=>' panel-warning ');
 ?>
<!-- MODALS -->


<script type="text/javascript" src="<?= base_url('publico/js_vistas/js/cuenta_index.js')?>"></script>