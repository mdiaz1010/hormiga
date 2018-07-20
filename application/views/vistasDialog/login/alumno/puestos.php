<div class="x_content">
  <div class="table-responsive">
    <table class="table table-bordered table-hover table-striped tablesorter">
      <thead>
        <tr class="headings">
          <th class="flat" title="Puesto ocupado en el salon">Puesto salon </th>
          <th class="flat" title="Puesto ocupado en todo el grado en el que se encuentra">Puesto Grado </th>
          <th class="flat" title="Puesto ocupado en todo el colegio">Puesto Colegio </th>

          <th>Puntaje </th>
          <th>Ver detalle </th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <center>
              <?=$bodyData->salon['puesto']?>/
                <?=$bodyData->total['salon']?>
            </center>
          </td>
          <td>
            <center>
              <?=$bodyData->grado['puesto']?>/
                <?=$bodyData->total['grado']?>
            </center>
          </td>
          <td>
            <center>
              <?=$bodyData->colegio['puesto']?>/
                <?=$bodyData->total['colegio']?>
            </center>
          </td>
          <td>
            <center>
              <strong>
                <?=$bodyData->colegio['nota']?>
              </strong>
            </center>
          </td>
          <td>
            <center>
              <strong>
              <a data-toggle="modal" data-target=".bs-example-modal-lg" data-codigo="<?=$bodyData->codigo?>" class="Detalle"  href="javascript:void(0)">
               <span class="fa fa-search"></span>
               </a>
              </strong>
            </center>
          </td>
        </tr>
      </tbody>

    </table>
  </div>
</div>
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