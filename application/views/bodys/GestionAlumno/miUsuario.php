<?php ?>

<link rel="stylesheet" href="<?=base_url('publico/kartik-file/css/fileinput.min.css')?>" />
<script src="<?=base_url('publico/kartik-file/js/fileinput.min.js')?>"></script>
<!--<link href="<?= base_url('publico/js_vistas/css/password.css') ?>" rel="stylesheet">-->
<!--<script src="<?= base_url('publico/js/strength.js')?>"></script>
 <link href="https://bootswatch.com/yeti/bootstrap.min.css" rel="stylesheet">

-->
<link rel="stylesheet" href="<?=base_url('publico/kartik-file/css/fileinput.min.css')?>" />

<div class="row">
</div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>
                    <span class="fa fa-search"></span> INTRANET EDUCATIVO - Información personal </h2>
                <ul class="nav navbar-right panel_toolbox">


                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form method="post" name="crearusuario" id="crearusuario"  data-parsley-validate autocomplete="off">
                    <div class="col-xs-10">
                        <div class="form-group">
                            <label class="control-label col-md-12 col-sm-12 col-xs-12">
                                Apellidos y Nombres:
                                <input name="apepat" id="apepat" placeholder="Apellido paterno" class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"
                                    value="<?=$bodyData->results['apepat']?>" readonly required>
                            </label>
                            <label class="control-label col-md-12 col-sm-12 col-xs-12">
                                Rol:
                                <input name="rol" id="rol" placeholder="Rol" class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"
                                    value="<?=$bodyData->results['usuari']?>" readonly required>
                            </label>
                            <label class="control-label col-md-12 col-sm-12 col-xs-12">
                                Dni:
                                <input name="documento" id="documento" placeholder="documento" type="number" class="form-control"  value="<?=$bodyData->results['docume']?>" readonly required>
                            </label>
                            <label class="control-label col-md-12 col-sm-12 col-xs-12">
                                Telefono:
                                <input name="telefono" id="telefono" placeholder="Telefono" type="number" class="form-control" value="<?=$bodyData->results['telefo']?>" required>
                            </label>
                            <label class="control-label col-md-12 col-sm-12 col-xs-12">
                                email:
                                <input name="email" id="email" placeholder="tucorreo@dominio.com" type="email" class="form-control"  value="<?=$bodyData->results['correo']?>" required >
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-12 col-sm-12 col-xs-12">
                                Fecha de Nacimiento:
                                <input name="fecha" id="fecha" type="date" placeholder="fecha" class="form-control"  value="<?=$bodyData->results['fecha']?>" required>
                            </label>
                            <label class="control-label col-md-12 col-sm-12 col-xs-12">
                                Direccion:
                                <textarea name="direccion" id="direccion" placeholder="Direccion " maxlength="220" class="form-control" style="text-transform:uppercase;"
                                    onkeyup="javascript:this.value=this.value.toUpperCase();" rows="1" required><?=ltrim($bodyData->results['direcc'])?></textarea>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class=" col-md-12 col-sm-12 col-xs-12">
                                Foto: <small> Extensiones permitidas: jpg,png,jpeg</small>
                                <input type="file" name="docAdj[]" id="docAdj"  class="file" data-edit="insertImage" />
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-12 col-sm-12 col-xs-12">
                                Clave:
                                <input id="myPassword" type="password" name="myPassword" maxlength="15" class="form-control" value="<?=$bodyData->results['claves']?>" required>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-12 col-sm-12 col-xs-12">
                                Confirmar Clave:
                                <input id="clave" name="clave" type="password" name="" class="form-control" value="<?=$bodyData->results['claves']?>" required>
                                <p id="result_error"></p>
                            </label>
                        </div>
                    </div>


                    <div class="col-md-2 col-sm-12 col-xs-12 table-responsive">
                        <div id="centrador" class="thumbnail ">

                                <img id="imagen" src="<?= base_url($bodyData->results['ruta'])?>" class="img-responsive center-block" align="top" alt="Lights"
                                    style="width:100%" required="required" />

                        </div>
                    </div>


                    <label class="control-label col-md-12 col-sm-12 col-xs-12">
                        <br>
                        <input id="btneditar" type="submit" name="btneditar" class="btn btn-danger" value="Editar">
                    </label>
                </div>
            </form>
        </div>
    </div>

</div>
<input type="hidden" name="url" id="url" value="<?= base_url(); ?>">
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
        height: 150px;

    }

    #imagen {
        width: 100px;
    }
</style>


<script type="text/javascript">
    $.validator.methods.email = function( value, element ) {
    return this.optional( element ) || /[a-zA-Z0-9_.+-]+@[a-z]+\.[a-z]+/.test( value );
    }

    $.validator.addMethod("maxDate", function(value, element) {
        var curDate = new Date();
        var inputDate = new Date(value);
        if (inputDate < curDate)
            return true;
        return false;
    });
    jQuery.validator.setDefaults({
    debug: true,
    success: "valid"
    });
    var url = $("#url").val();
    $("#crearusuario").validate({

        rules: {
            telefono: {
            required:true,
            minlength:7,
            maxlength:9,
            number: true
            },
            documento:{
            required:true,
            minlength:8,
            maxlength:12
            },
            email: {
            required: true,
            email: true
            },
            fecha:{
            required: true,
            date: true,
            maxDate: true
            },
            direccion:{
            required: true,
            maxlength:220
            },
            myPassword:{
            required: true,
            minlength: 6
            },
            clave: {
            equalTo: "#myPassword"
            }

        },
        messages: {
            telefono:{
            required: " Este campo es obligatorio",
            minlength: " El telefóno a ingresar debe de contar como mínimo con 7 dígitos",
            maxlength: " El telefóno a ingresar debe de contar como máximo con 9 dígitos",
            number: " Por favor ingresar solo números"
            },
            documento:{
            required: " Este campo es obligatorio",
            minlength: " El documento a ingresar debe de tener como mínimo 8  dígitos",
            maxlength: " El documento a ingresar debe de tener como máximo 12 dígitos"
            },
            email: {
            required: " Este campo es obligatorio",
            email: " El correo a ingresar debe de tener el siguiente formato name@dominio.com"
            },
            fecha: {
            required: " Este campo es obligatorio",
            date: " La fecha de nacimiento debe de tener el siguiente formato dd/mm/aaaa",
            maxDate: "Ingresar su fecha de nacimiento"
            },
            direccion: {
            required: " Este campo es obligatorio",
            maxlength: "Solo puede ingresar un máximo de 220 caracteres."
            },
            myPassword:{
            required: " Este campo es obligatorio",
            minlength: " La contraseña debe de tener como mínimo 6  dígitos"
            },
            clave: {
            equalTo:  "Las contraseñas no coinciden"
            }

        },
        submitHandler: function(form) {


            var fecha = $("#fecha").val();
            var direccion = $("#direccion").val();
            var documento = $("#documento").val();
            var email = $("#email").val();
            var telefono = $("#telefono").val();
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
            formdata.append('telefono', telefono);
            formdata.append('documento', documento);
            formdata.append('email', email);
            formdata.append('direccion', direccion);
            formdata.append('clave', clave);

            $.ajax({
                type: 'POST',
                url: url+"GestionAlumno/editarInfo",
                data: formdata,
                processData: false,
                contentType: false,
                success: function (data) {
                    if(data=='n')
                    {
                     alert("Está intentando subir un archivo con extensión no permitida"); return true;
                    }
                    alert("Se editaron los datos satisfactoriamente, para verificar los cambios vuelva a iniciar sesión");
                    location.reload();
                }
            });

        }


    });


</script>
<script>tinymce.init({ selector:'textarea' });</script>