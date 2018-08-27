<?php ?>
<link href="<?= base_url('publico/js_vistas/css/password.css') ?>" rel="stylesheet">
<script src="<?= base_url('publico/js/strength.js')?>"></script>
<div class="row">
</div>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>
                <span class="fa fa-search"></span> INTRANET EDUCATIVO - Consultar Informacion </h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="col-xs-10">
                <form method="post" name="crearusuario" id="crearusuario">
                    <div class="form-group">
                        <label class="control-label col-md-9 col-sm-9 col-xs-12">
                            Apellido Paterno:
                            <input name="apepat" id="apepat" placeholder="Apellido paterno" class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"
                                value="<?=$bodyData->results['apepat']?>" readonly>
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
                            <input  readonly name="fecha" id="fecha" type="date" placeholder="fecha" class="form-control" required value="<?=$bodyData->results['fecha']?>">
                        </label>
                        <label class="control-label col-md-9 col-sm-9 col-xs-12">
                            Direccion:
                            <textarea readonly name="direccion" id="direccion" placeholder="Direccion " class="form-control" style="text-transform:uppercase;"
                                onkeyup="javascript:this.value=this.value.toUpperCase();" rows="1"><?=$bodyData->results['direcc']?></textarea>
                        </label>
                    </div>
                    <div class="form-group">

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