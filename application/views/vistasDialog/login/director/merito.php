<table class="table table-bordered table-hover table-striped tablesorter">
  <thead>
    <tr>
      <th>Puesto </th>
      <th>Usuario </th>
      <th>Grado y Seccion </th>
      <th>Puntaje </th>
      <th>Ver detalle </th>
    </tr>
  </thead>
  <tbody>
    <?php $p=1; foreach ($bodyData->merito as $merito):?>
    <tr>
      <td>
        <center>
          <strong>
            <?=$p?>
          </strong>
        </center>
      </td>
      <td>
        <?=$merito['alumno']?>
      </td>
      <td>
        <center>
          <strong>
            <?=$merito['grado']?>
          </strong>
        </center>
      </td>
      <td>
        <center>
          <strong>
            <?=$merito['nota']?>
          </strong>
        </center>
      </td>
      <td>
        <center>
          <strong>
            <a data-toggle="modal" data-target=".bs-example-modal-lg" data-codigo="<?=$merito['id_alumno']?>" class="Detalle"  href="javascript:void(0)"><span class="fa fa-search"></span></a>
          </strong>
        </center>
      </td>
    </tr>
    <?php  $p++; endforeach;?>
  </tbody>

</table>
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel"></h4>
                </div>
                <div class="modal-body" id="DIVVERDETALLE">

                </div>
                <div class="modal-footer">

                    <button type="button"  data-dismiss="modal" class="btn btn" style="color: #fff;background-color: #2A3F54;">Cerrar</button>
                </div>

            </div>
        </div>
    </div>
    <script type="text/javascript">

                $(".Detalle").click(function () {
                  var codigo = $(this).data("codigo");
                    $.ajax({
                        type: 'POST',
                        url: "verdetalleAlumnoDir",
                        data:{
                          codigo : codigo
                        },
                        beforeSend: function () {
                            $('#DIVcargas').dialog('open');
                        },
                        success: function (datos) {
                            if (datos.length > 0) {
                                $('#DIVcargas').dialog('close');
                                $('#DIVVERDETALLE').html(datos);

                            }
                            return false;
                        }
                    });
                });
    </script>