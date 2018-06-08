<?php ?>
<link href="<?= base_url('publico/js_vistas/css/password.css') ?>" rel="stylesheet">
<script src="<?= base_url('publico/js/strength.js')?>"></script>
<div class="row">
</div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>
                    <span class="fa fa-search"></span> INTRANET EDUCATIVO - Consultar Informacion </h2>
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
                <div class="col-xs-10">
                    <form method="post" name="crearusuario" id="crearusuario">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                Nombre:
                                <input name="nombre" id="nombre" placeholder="Nombres" class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"
                                    value="<?=$bodyData->results['nombre']?>" readonly>
                            </label>
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                Apellido Paterno:
                                <input name="apepat" id="apepat" placeholder="Apellido paterno" class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"
                                    value="<?=$bodyData->results['apepat']?>" readonly>
                            </label>
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                Apellido Materno:
                                <input name="apemat" id="apemat" placeholder="Apellido materno" class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"
                                    value="<?=$bodyData->results['apemat']?>" readonly>
                            </label>
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                Rol:
                                <input name="rol" id="rol" placeholder="Rol" class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"
                                    value="<?=$bodyData->results['usuari']?>" readonly>
                            </label>
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                Telefono:
                                <input name="telefono" id="telefono" placeholder="Telefono" type="text" class="form-control" value="<?=$bodyData->results['telefo']?>"
                                    readonly>
                            </label>
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                Dni:
                                <input name="documento" id="documento" placeholder="documento" type="text" class="form-control" required value="<?=$bodyData->results['docume']?>"
                                    readonly>
                            </label>
                            <label class="control-label col-md-6 col-sm-6 col-xs-12">
                                email:
                                <input name="email" id="email" placeholder="email" type="email " class="form-control" required value="<?=$bodyData->results['correo']?>"
                                    readonly>
                            </label>

                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                Fecha de Nacimiento:
                                <input name="fecha" id="fecha" type="date" placeholder="fecha" class="form-control" required value="<?=$bodyData->results['fecha']?>">
                            </label>
                            <label class="control-label col-md-9 col-sm-9 col-xs-12">
                                Direccion:
                                <textarea name="direccion" id="direccion" placeholder="Direccion " class="form-control" style="text-transform:uppercase;"
                                    onkeyup="javascript:this.value=this.value.toUpperCase();" rows="1">
                                    <?=$bodyData->results['direcc']?>
                                </textarea>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-6 col-sm-6 col-xs-12">
                                Foto:
                                <input name="docAdj" id="docAdj" type="file" class="form-control">
                            </label>
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <div class="col-xs-2">
                        <div id="centrador" class="thumbnail">
                            <a href="#" style=" outline: none;" class="img-rounded">
                                <img id="imagen" src="<?= base_url($bodyData->results['ruta'])?>" class="img-responsive center-block" align="top" alt="Lights"
                                    style="width:100%" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>
                    <span class="fa fa-user-secret"></span> Cambio de Password </h2>
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
                <div class="password-container">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">
                        Clave:
                        <input id="myPassword" type="password" name="myPassword" class="form-control" value="<?=$bodyData->results['claves']?>">
                    </label>
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">
                        Confirmar Clave:
                        <input id="clave" name="clave" type="password" name="" class="form-control" value="<?=$bodyData->results['claves']?>">
                        <p id="result_error"></p>
                    </label>

                    <label class="control-label col-md-3 col-sm-3 col-xs-12">
                        <br>
                        <input id="btneditar" type="submit" name="btneditar" class="btn btn-danger" value="Editar">
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .right {
        float: right;

    }

    .left {
        float: left;

    }

    #centrador {
        text-align: center;
        width: 150px;
        height: 180px;

    }

    #imagen {
        width: 100px;
    }
</style>
<script type="text/javascript">
    $("#btneditar").click(function () {
        var fecha = $("#fecha").val();
        var direccion = $("#direccion").val();
        var clave = $("#myPassword").val();
        var clave2 = $("#clave").val();
        if (clave === clave2) {
            var fecha = $("#fecha").val();
            var direccion = $("#direccion").val();
            var clave = $("#myPassword").val();
            var DocAdj = $("#docAdj").val();

            var inputimage = document.getElementById('docAdj'),

                formdata = new FormData();
            var i = 0,
                len = inputimage.files.length,
                img, reader, file;
            for (; i < len; i++) {
                file = inputimage.files[i];
                if (formdata)
                    formdata.append('images[]', file);
            }

            formdata.append('fecha', fecha);
            formdata.append('direccion', direccion);
            formdata.append('clave', clave);
            $.ajax({
                type: 'POST',
                url: "editarInfo",
                data: formdata,
                processData: false,
                contentType: false,
                success: function () {
                    location.reload();
                }
            });

        } else {
            $('#result_error').html("<font color='red'>Las claves no coinciden</font>");
        }


    });
    $(document).ready(function ($) {
        $("#myPassword").strength();
    });
</script>