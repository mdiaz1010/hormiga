<?php if ($bodyData->respuesta>0) {
    ?>
<div class="row col-md-12 col-sm-12 col-xs-12">

  <div class="col-md-6 col-sm-6 col-xs-12">


    <div class="x_panel">
      <div class="x_title">

        <h2>
          <i class="fa fa-bullhorn"></i> Notificaciones</h2>
        <ul class="nav navbar-right panel_toolbox">
          <li>
            <a class="collapse-link">
              <i class="fa fa-chevron-up"></i>
            </a>
          </li>

        </ul>

        <div class="clearfix"></div>
      </div>
        <div class="x_content" id="notificacion_general">



        </div>

    </div>


    <div class="x_panel">
      <div class="x_title">
        <div id="horarios">
          <center>
            <i id="horarios-load" class="fa fa-circle-o-notch fa-spin" style="font-size:24px;color:#ec7063"></i>
          </center>
        </div>
      </div>
    </div>


  </div>


  <div class="modal fade bs-example_final-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <h3>Promedios finales</h3>
          <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel"></h4>
        </div>
        <div class="modal-body" id="DIVVERDETALLE_FINAL">

        </div>
        <div class="modal-footer">

          <button type="button" data-dismiss="modal" class="btn btn" style="color: #fff;background-color: #2A3F54;">Cerrar</button>
        </div>

      </div>
    </div>
  </div>


  <div class="modal fade bs-example2_final-modal-lg" id="repositorio" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <h3>Revisar en el repositorio</h3>
          <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel"></h4>
        </div>
        <div class="modal-body" id="DIVVERDETALLE_REPOSITORIO">

        </div>
        <div class="modal-footer">

          <button type="button" data-dismiss="modal" class="btn btn" style="color: #fff;background-color: #2A3F54;">Cerrar</button>
        </div>

      </div>
    </div>
  </div>


  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>
          <i class="fa fa-list-alt"></i> Orden de merito</h2>
        <ul class="nav navbar-right panel_toolbox">
          <li>
            <a class="collapse-link">
              <i class="fa fa-chevron-up"></i>
            </a>
          </li>

        </ul>
        <div class="clearfix"></div>
      </div>
      <div id="puestos">
        <center>
          <i id="puestos-load" class="fa fa-circle-o-notch fa-spin" style="font-size:24px;color:#ec7063"></i>
        </center>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>
          <i class="fa fa-line-chart"></i> Rendimiento academico</h2>
        <ul class="nav navbar-right panel_toolbox">
          <li>
            <a class="collapse-link">
              <i class="fa fa-chevron-up"></i>
            </a>
          </li>

        </ul>
        <div class="clearfix"></div>
      </div>
      <div id="rendimiento">
        <center>
          <i id="rendimiento-load" class="fa fa-circle-o-notch fa-spin" style="font-size:24px;color:#ec7063"></i>
        </center>

      </div>
    </div>
  </div>

  <div class="clearfix"></div>


</div>
<script>
  $.post('notificacion_general', function (data) {
    $("#notificacion_general").html(data);
  });

</script>
<?php
} else {
        echo "No cuenta con la información necesaria para mostrar esta interfaz.";
    }
?>