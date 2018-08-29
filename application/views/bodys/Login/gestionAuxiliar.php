<div class="page-title">
  <div class="title_left">
    <h3> </h3>
  </div>



        <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search animated fadeInRight">

                <div class="input-group">
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Apellido y nombre...">
                    <div class="input-group-btn">
                        <button  type="button" class="btn btn-sm btn-primary consulta">Buscar</button>
                    </div>
                </div>

            </div>
        </div>
<div class="row">
  <div class="animated flipInY col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="tile-stats">
      <div class="icon">
        <a href="javascript:" class="inasistencia">
          <i class="fa fa-ambulance"></i>
        </a>
      </div>
      <div class="count">
        <h2>
          <span class="badge bg-red">
            <a href="javascript:" data-codigo="1" class="inasistencia">
              <font color=white>
                <?=$bodyData->cantidad?>
              </font>
            </a>
          </span>
          <span class="badge bg-blue">
            <a href="javascript:" data-codigo="1" class="inasistencia">
              <font color=white>
                <?=$bodyData->cantidadR?>
              </font>
            </a>
          </span>

        </h2>
      </div>
      <a href="javascript:" class="inasistencia" data-codigo="1">
        <h3>Inasistencia justificada</h3>
      </a>
    </div>
  </div>
  <div class="animated flipInY col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="tile-stats">
      <div class="icon">
        <a href="javascript:" class="evasion">
          <i class="fa fa-frown-o"></i>
        </a>
      </div>
      <div class="count">
        <h2>
          <span class="badge bg-red">
            <a href="javascript:" class="evasion">
              <font color=white>
                <?=$bodyData->cantidad2?>
              </font>
            </a>
          </span>
          <span class="badge bg-blue">
            <a href="javascript:" class="evasion">
              <font color=white>
                <?=$bodyData->cantidad2Azul?>
              </font>
            </a>
          </span>
          <span class="badge bg-blue">
            <a href="javascript:" data-codigo="1" class="evasion">
              <font color=white>Historial</font>
            </a>
          </span>
        </h2>
      </div>
      <a href="javascript:" class="evasion">
        <h3>Posibles evasiones</h3>
      </a>
    </div>
  </div>
  <div class="animated flipInY col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="tile-stats">
      <div class="icon">
        <a href="javascript:" class="asistencia">
          <i class="fa fa-group"></i>
        </a>
      </div>
      <div class="count">
        <h2>
          <span class="badge bg-red">
            <a href="javascript:" class="asistencia">
              <font color=white>
                <?=$bodyData->asistencia?>
              </font>
            </a>
          </span>
        </h2>
      </div>
      <a href="javascript:" class="asistencia">
        <h3>Registro de asistencia</h3>
      </a>
    </div>
  </div>


  <?php $i=0;  foreach ($bodyData->usuarios as $profesores): ?>
  <input type="hidden" name="profesores[]" id="profesores<?php $i; ?>" value="<?php echo $profesores->ape_pat_per ?>" />
  <?php $i++; endforeach; ?>

  <div class="col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2></h2>
        <ul class="nav navbar-right panel_toolbox">

        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">

        <div class="table-responsive">
          <div id="bandejaAuxiliar"></div>


        </div>
      </div>
    </div>
  </div>
</div>
</div>


<input type="hidden" name="url" id="url" value="<?=base_url();?>">
<input type="hidden" name="uri" id="uri" value="<?=base_url('GestionAuxiliar/asistencia')?>">
<script type="text/javascript" src="<?= base_url('publico/js_vistas/js/GestionAuxiliar_index.js')?>"></script>