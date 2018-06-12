<form action="/GestionDocente" method="post" name="archivoprof" id="archivoprof" enctype="multipart/form-data">
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nombre
            <span class="required">*</span>
        </label>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <input type="text" id='txtarchivo' name="txtarchivo" required="required" class="form-control col-md-7 col-xs-12">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Descripcion
            <span class="required">*</span>
        </label>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <input type="text" name="txtdescripcion" id="txtdescripcion" placeholder="DESCRIPCION" required="required" class="form-control col-md-7 col-xs-12">
        </div>
    </div>
    <input type="hidden" id='txtgrado' class="form-control" name="txtgrado" value="<?php echo $bodyData->archivos["grado"]?>" readonly>
    <input type="hidden" id='txtseccion' class="form-control" name="txtseccion" value="<?php echo $bodyData->archivos["seccion"]?>" readonly>
    <input type="hidden" id='txtcurso' class="form-control" name="txtcurso" value="<?php echo $bodyData->archivos["curso"]?>" readonly>
    <input type="hidden" id='txtbimestre' class="form-control" name="txtbimestre" value="<?php echo $bodyData->archivos["bimestre"]?>" readonly>





    <div class="btn-group">
        <a class="btn" title="Insert picture (or just drag & drop)" id="pictureBtn">
            <i class="fa fa-picture-o"></i>
        </a>
        <input type="file" name="docAdj[]" id="docAdj" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage"
        />
    </div>


    <div class="ln_solid"></div>


    <span id="response"></span>

</form>