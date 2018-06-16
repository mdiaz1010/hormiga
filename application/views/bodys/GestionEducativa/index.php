<?php ?>
<div class="row">

  <div class="col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>GESTION EDUCATIVA</h2>
        <ul class="nav navbar-right panel_toolbox">
          <li>
            <a class="collapse-link">
              <i class="fa fa-chevron-up"></i>
            </a>
          </li>
          <li>
            <a class="close-link">
              <i class="fa fa-close"></i>
            </a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">

        <form action="" method="post" name="crearcliente" id="crearcliente" enctype="multipart/form-data">
          <div class="form-group">

            <div class="control-label col-md-2 col-sm-2 col-xs-10">
              <div class="form-group">
                <button type="button" id='btn_grado' name='btn_grado' class="btn btn-round btn-danger" value="GRADO">
                  <strong> GRADO
                    <span class="fa fa-list-alt"></span>
                  </strong>
                </button>
              </div>
            </div>
            <div class="control-label col-md-2 col-sm-2 col-xs-10">
              <div class="form-group">
                <button type="button" id='btn_seccion' name='btn_seccion' class="btn btn-round btn-danger" value="SECCION">
                  <strong> SECCION
                    <span class="fa fa-pencil"></span>
                  </strong>
                </button>
              </div>
            </div>
            <div class="control-label col-md-2 col-sm-2 col-xs-10">
              <div class="form-group">
                <button type="button" id='btn_cursos' name='btn_cursos' class="btn btn-round btn-danger" value="CURSOS">
                  <strong> CURSOS
                    <span class="fa fa-book"></span>
                  </strong>
                </button>
              </div>
            </div>
            <div class="control-label col-md-2 col-sm-2 col-xs-10">
              <div class="form-group">
                <button type="button" id='btn_bimestre' name='btn_bimestre' class="btn btn-round btn-danger" value="CURSOS">
                  <strong> SEMESTRE
                    <span class="fa fa-calendar"></span>
                  </strong>
                </button>
              </div>
            </div>
            <div class="control-label col-md-2 col-sm-2 col-xs-10">
              <div class="form-group">
                <button type="button" id='btn_notas' name='btn_notas' class="btn btn-round btn-danger" value="CURSOS">
                  <strong> NOTAS
                    <span class="fa fa-pencil-square"></span>
                  </strong>
                </button>
              </div>
            </div>

          </div>
        </form>


      </div>
    </div>
  </div>
  <div class="col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>
          <a href="#" class="registrar_aulas">
            <h2 class="panel-title">REGISTRO DE AULA</h1>
          </a>
          </h2>
          <ul class="nav navbar-right panel_toolbox">
            <li>
              <a class="collapse-link">
                <i class="fa fa-chevron-up"></i>
              </a>
            </li>
            <li>
              <a class="close-link">
                <i class="fa fa-close"></i>
              </a>
            </li>
          </ul>
          <div class="clearfix"></div>
      </div>
      <div class="x_content">

        <div class="panel-body" id="bandejaAula">Cargando...</div>
        <div class="col-xs-12">
          <?=($this->session->flashdata('flashdata_respuesta')!=null)? '<h4 class="text-danger" >'.$this->session->flashdata('flashdata_respuesta')."</h4>":'' ?>
        </div>


      </div>
    </div>
  </div>



  <div class="col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Historial de aulas</h2>
        <ul class="nav navbar-right panel_toolbox">
          <li>
            <a class="collapse-link">
              <i class="fa fa-chevron-up"></i>
            </a>
          </li>
          <li>
            <a class="close-link">
              <i class="fa fa-close"></i>
            </a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div id="bandejaprincipal">Cargando...</div>


      </div>
    </div>
  </div>
</div>


<div id='DIVcarga' title="EN PROCESO ... "> Espere mientras se gestiona la informaci&oacute;n. </div>
<div id="ContainerProd" title="POPUP:: VALIDACION">
  <strong>Cargando...</strong>
</div>
<div id="ContainerGrado" title="INTRANET EDUCATIVA :: GESTIONAR GRADOS">
  <strong>Cargando...</strong>
</div>
<div id="ContainerSeccion" title="INTRANET EDUCATIVA :: GESTIONAR SECCIONES">
  <strong>Cargando...</strong>
</div>
<div id="ContainerCurso" title="INTRANET EDUCATIVA :: GESTIONAR SECCIONES">
  <strong>Cargando...</strong>
</div>
<div id="ContainerBimestre" title="INTRANET EDUCATIVA :: GESTIONAR SEMESTRE">
  <strong>Cargando...</strong>
</div>
<div id="ContainerNotas" title="INTRANET EDUCATIVA :: GESTIONAR NOTAS">
  <strong>Cargando...</strong>
</div>
<script type="text/javascript" src="<?= base_url('publico/js_vistas/js/GestionEducativa_index.js')?>"></script>