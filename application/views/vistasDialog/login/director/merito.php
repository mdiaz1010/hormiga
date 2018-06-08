<table class="table table-bordered table-hover table-striped tablesorter">
  <thead>
    <tr>
      <th>Puesto </th>
      <th>Usuario </th>
      <th>Grado y Seccion </th>
      <th>Puntaje </th>
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
    </tr>
    <?php  $p++; endforeach;?>
  </tbody>

</table>