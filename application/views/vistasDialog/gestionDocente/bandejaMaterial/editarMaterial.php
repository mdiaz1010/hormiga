<form action="" method="post" name="editarMaterial" id="editarMaterial">

    <div class="col-xs-12">
        <div class="form-group">
            <label class="control-label col-md-12 col-sm-12 col-xs-12">
                Nombre:
                <input type="text" id='archivo' name="archivo" value="<?=$bodyData->nomArchivo['archivo']?>" maxlength="20" class="form-control" required>
            </label>

            <label class="control-label col-md-12 col-sm-12 col-xs-12">
                Descripcion:
                <textarea name="editor" id="editor" class="form-control" maxlength="220" required><?=$bodyData->nomArchivo['descripcion']?></textarea>
            </label>
        </div>
    </div>

    <input type="hidden" name="id" id="id" value="<?=$bodyData->id?>">
    <input type="hidden" name="txtcurso" id="txtcurso" value="<?=$bodyData->arrayEliminar['curso']?>">
    <input type="hidden" name="txtgrado" id="txtgrado" value="<?=$bodyData->arrayEliminar['grado']?>">
    <input type="hidden" name="txtseccion" id="txtseccion" value="<?=$bodyData->arrayEliminar['seccion']?>">
    <input type="hidden" name="txtbimestre" id="txtbimestre" value="<?=$bodyData->arrayEliminar['bimestre']?>">

</form>

<script type="text/javascript">


    jQuery.validator.setDefaults({
    debug: true,
    success: "valid"
    });
$("#editarMaterial").validate({

        rules: {
            archivo: {
            required:true,
            minlength:5,
            maxlength:20
            },
            editor:{
            required: true,
            maxlength:220
            }
        },
        messages: {
            archivo:{
            required: " Este campo es obligatorio",
            minlength: " El nombre del archivo debe de tener como mínimo 5 caracteres",
            maxlength: " El nombre del archivo debe de tener como máximo 20 caracteres"
            },
            editor: {
            required: " Este campo es obligatorio",
            maxlength: "Solo puede ingresar un máximo de 220 caracteres."
            }
        }

});

</script>