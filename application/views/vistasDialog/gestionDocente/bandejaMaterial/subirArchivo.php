<link href="<?= base_url('publico/trumbowyg/ui/trumbowyg.css')?>" rel="stylesheet">
<link rel="stylesheet" href="<?=base_url('publico/kartik-file/css/fileinput.min.css')?>" />
    <script src="<?=base_url('publico/kartik-file/js/fileinput.min.js')?>"></script>
<form action="/GestionDocente" method="post" name="archivoprof" id="archivoprof" enctype="multipart/form-data">

    <div class="form-group" class="col-md-12 col-sm-12 col-xs-12">
        <label class="control-label " for="first-name">Nombre
            <span class="required">*</span>
        </label>

        <input type="text" id='txtarchivo' name="txtarchivo" required="required" class="form-control">

    </div>

    <div class="form-group" class="col-md-12 col-sm-12 col-xs-12">
        <label class="control-label " for="first-name">Descripcion
            <span class="required">*</span>
        </label>

    <textarea name="txtdescripcion" id="txtdescripcion" required="required" class="textarea-content form-control">
    </textarea>

    </div>
    <input type="hidden" id='txtgrado' class="form-control" name="txtgrado" value="<?php echo $bodyData->archivos["grado"]?>" readonly>
    <input type="hidden" id='txtseccion' class="form-control" name="txtseccion" value="<?php echo $bodyData->archivos["seccion"]?>" readonly>
    <input type="hidden" id='txtcurso' class="form-control" name="txtcurso" value="<?php echo $bodyData->archivos["curso"]?>" readonly>
    <input type="hidden" id='txtbimestre' class="form-control" name="txtbimestre" value="<?php echo $bodyData->archivos["bimestre"]?>" readonly>


    <div class='form-group' class="col-md-12 col-sm-12 col-xs-12">
        <input type="file" name="docAdj[]" id="docAdj"  class="file" data-edit="insertImage"/>
    </div>







    <div class="ln_solid"></div>


    <span id="response"></span>

</form>
<script src="<?= base_url('publico/trumbowyg/trumbowyg.js')?>"></script>
<script>
$('.textarea-content').trumbowyg();
</script>