<div class="panel-heading">
    <h1 class="panel-title">
        <strong>
            <center>SUBIR ARCHIVOS</center>
        </strong>
    </h1>
</div>
<form action="/editarAsistenciasAl" method="post" name="registrarArchivo" id="registrarArchivo" enctype="multipart/form-data">
    <table class="col-lg-6">
        <tr>
            <td class="col-lg-3">
                <input type="hidden" id='txtid' class="form-control" name="txtid" value="<?php echo $bodyData->codigo?>" readonly>
                <input type="hidden" id='txtfec' class="form-control" name="txtfec" value="<?php echo $bodyData->fecha?>" readonly>
            </td>
        </tr>

        <tr>
            <td class="col-lg-3">
                <font style="font-style: italic;">Mensaje:</font>
            </td>
            <td>
                <textarea class="form-control" id="mensaje" name="mensaje" style=" height: 51px; width: 200px;">
                    <?=ltrim($bodyData->mensaje)?>
                </textarea>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td>
                <div class="col-sm-12">
                    <label class="custom-file  col-sm-12">
                        <input type="file" name="docAdj[]" id="docAdj">
                        <span class="custom-file-control"></span>
                    </label>
                </div>
                <span id="response"></span>
            </td>
        </tr>
    </table>
</form>