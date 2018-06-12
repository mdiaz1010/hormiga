<form action="/editarAsistenciasAl" method="post" name="registrarArchivo" id="registrarArchivo" enctype="multipart/form-data">

    <input type="hidden" id='txtid' class="form-control" name="txtid" value="<?= trim($bodyData->codigo)?>" readonly>
    <input type="hidden" id='txtfec' class="form-control" name="txtfec" value="<?= trim($bodyData->fecha)?>" readonly>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Mensaje
            <span class="required">*</span>
        </label>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <input type="text" id="mensaje" name="mensaje" required="required" class="form-control col-md-7 col-xs-12" value="<?=trim($bodyData->mensaje)?>">
        </div>
    </div>
    <div class="col-sm-12">
                    <label class="custom-file  col-sm-12">
                        <input type="file" name="docAdj[]" id="docAdj">
                        <span class="custom-file-control"></span>
                    </label>
    </div>


    <span id="response"></span>



</form>