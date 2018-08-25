
<!--<link href="<?= base_url('publico/trumbowyg/ui/trumbowyg.css')?>" rel="stylesheet"<!>-->
<link rel="stylesheet" href="<?=base_url('publico/kartik-file/css/fileinput.min.css')?>" />
<!--    <script src="<?=base_url('publico/trumbowyg/trumbowyg.js')?>"></script>-->
    <script src="<?=base_url('publico/kartik-file/js/fileinput.min.js')?>"></script>
<form  method="post" name="archivoprof" id="archivoprof"  data-parsley-validate autocomplete="off">

<div class="col-xs-12">
        <div class="form-group">
           <label class="control-label col-md-12 col-sm-12 col-xs-12">
               Nombre:
               <input type="text" id='txtarchivo' name="txtarchivo"   maxlength="20" class="form-control" required>
           </label>

           <label class="control-label col-md-12 col-sm-12 col-xs-12">
               Descripcion:
               <textarea name="editor" id="editor" class="form-control textarea-content" maxlength="220" required></textarea>
           </label>
        </div>


    <input type="hidden" id='txtgrado' class="form-control" name="txtgrado" value="<?php echo $bodyData->archivos["grado"]?>" readonly>
    <input type="hidden" id='txtseccion' class="form-control" name="txtseccion" value="<?php echo $bodyData->archivos["seccion"]?>" readonly>
    <input type="hidden" id='txtcurso' class="form-control" name="txtcurso" value="<?php echo $bodyData->archivos["curso"]?>" readonly>
    <input type="hidden" id='txtbimestre' class="form-control" name="txtbimestre" value="<?php echo $bodyData->archivos["bimestre"]?>" readonly>

    <div class="form-group">
        <label class=" col-md-12 col-sm-12 col-xs-12">
            Extensiones permitidas: docx,txt,jpg,png,jpeg,pptx,pdf
            <input type="file" name="docAdj[]" id="docAdj"  class="file" data-edit="insertImage"/>
        </label>
    </div>
</div>

</form>
<div id="mensaje"></div>
<span id="response"></span>

<script type="text/javascript">


    jQuery.validator.setDefaults({
    debug: true,
    success: "valid"
    });
$("#archivoprof").validate({

        rules: {
            txtarchivo: {
            required:true,
            minlength:5,
            maxlength:20
            },
            editor:{
            required: true,
            maxlength:220
            },
            docAdj:{
            required: true,
            extension: "docx|txt|jpg|png|jpeg|pptx|pdf"
            }
        },
        messages: {
            txtarchivo:{
            required: " Este campo es obligatorio",
            minlength: " El nombre del archivo debe de tener como mínimo 5 caracteres",
            maxlength: " El nombre del archivo debe de tener como máximo 20 caracteres"
            },
            editor: {
            required: " Este campo es obligatorio",
            maxlength: "Solo puede ingresar un máximo de 220 caracteres."
            },
            docAdj :{
            required :"Este campo es obligatorio",
            extension: "El documento que intenta ingresar no , está dentro de las extensiones permitidas"
            }
        }

});
//$(".textarea-content").trumbowyg();
</script>
<script>tinymce.init({ selector:'textarea' });</script>