<?php?>
    <div class="panel-heading">
        <h1 class="panel-title">
            <strong>
                <center>EDICION MATERIALES</center>
            </strong>
        </h1>
    </div>
    <form action="" method="post" name="editarMaterial" id="editarMaterial">
        <table class="col-lg-12">
            <tr>
                <td class="col-lg-3">
                    <label>Nombre:</label>
                </td>
                <td>
                    <input type="hidden" name="id" id="id" value="<?=$bodyData->id?>">
                    <input type="hidden" name="txtcurso" id="txtcurso" value="<?=$bodyData->arrayEliminar['curso']?>">
                    <input type="hidden" name="txtgrado" id="txtgrado" value="<?=$bodyData->arrayEliminar['grado']?>">
                    <input type="hidden" name="txtseccion" id="txtseccion" value="<?=$bodyData->arrayEliminar['seccion']?>">
                    <input type="hidden" name="txtbimestre" id="txtbimestre" value="<?=$bodyData->arrayEliminar['bimestre']?>">
                    <input type="text" name="archivo" id="archivo" class="form-control" value="<?=$bodyData->nomArchivo?>">
                </td>
            </tr>

        </table>
    </form>