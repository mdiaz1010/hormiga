<div class="panel-heading">
    <h1 class="panel-title">
        <strong>
            <center>SUBIR ARCHIVOS</center>
        </strong>
    </h1>
</div>
<form action="/GestionDocente" method="post" name="archivoprof" id="archivoprof" enctype="multipart/form-data">
    <table class="col-lg-9">
        <tr>
            <td class="col-lg-3">
                <input type="hidden" id='txtgrado' class="form-control" name="txtgrado" value="<?php echo $bodyData->archivos["
                    grado "]?>" readonly>
            </td>
            <td class="col-lg-3">
                <input type="hidden" id='txtseccion' class="form-control" name="txtseccion" value="<?php echo $bodyData->archivos["
                    seccion "]?>" readonly>
            </td>
            <td class="col-lg-3">
                <input type="hidden" id='txtcurso' class="form-control" name="txtcurso" value="<?php echo $bodyData->archivos["
                    curso "]?>" readonly>
            </td>
            <td class="col-lg-3">
                <input type="hidden" id='txtbimestre' class="form-control" name="txtbimestre" value="<?php echo $bodyData->archivos["
                    bimestre "]?>" readonly>
            </td>
        </tr>
        <tr>
            <td class="col-lg-3">
                <font style="font-style: italic;">Archivo:</font>
            </td>
            <td class="col-lg-9">
                <input type="text" id='txtarchivo' class="form-control" name="txtarchivo" style="text-align:left; width: 200px; height: 35px;"
                    value="">
            </td>
        </tr>
        <tr>
            <td class="col-lg-3">
                <font style="font-style: italic;">Descripcion:</font>
            </td>
            <td class="col-lg-9">
                <textarea placeholder="DESCRIPCION..." class="form-control" name="txtdescripcion" id="txtdescripcion" style="text-align:left; width: 200px; height: 30px;">
                </textarea>
                <br>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td>
                <div class="col-sm-6">
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