<div class="x_content">
  <div class="table-responsive">
    <table class="table table-bordered table-hover table-striped tablesorter">
      <thead>
        <tr class="headings">
          <th class="flat" title="Puesto ocupado en el salon">Puesto salon </th>
          <th class="flat" title="Puesto ocupado en todo el grado en el que se encuentra">Puesto Grado </th>
          <th class="flat" title="Puesto ocupado en todo el colegio">Puesto Colegio </th>

          <th>Puntaje </th>
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
        </tr>
      </tbody>

    </table>
  </div>
</div>