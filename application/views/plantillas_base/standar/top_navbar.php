<?php ?>
<!-- top navigation -->

<header id="header">
  <!--logo start-->
  <div class="brand">


    <a  class="logo">
      <img src="<?=base_url('publico/media/logo_edumpro.png')?>" />
    </a>

  </div>
  <!--logo end-->
  <ul class="nav navbar-nav navbar-left">

    <li class="toggle-navigation toggle-left">
      <button class="sidebar-toggle tooltip-hover-body" id="toggle-left" title="Contraer/Expandir Menú">
        <i class="fa fa-bars"></i>
      </button>
    </li>

    <li class="profile hidden-xs">
      <a href="javascript:" class="btn btn-transparent tooltip-hover-body inicio_docente" data-uri="<?=base_url('GestionDocente/reportPrincipal')?>" title="Ir al inicio">
        <i class="fa fa-home"></i>
      </a>
    </li>


    <!-- <li class="toggle-profile hidden-xs">
            <button type="button" class="btn btn-default tooltip-hover-body" id="toggle-profile" data-original-title="Ocultar datos de usuario">
                <i class="icon-user"></i>
            </button>
        </li> -->

    <li class="profile list-inline-item dropdown notification-list hidden-xs" id="menu-drop">
      <a class="btn btn-transparent tooltip-hover-body mensajeria_docente" href="javascript:"  data-uri="<?=base_url('GestionDocente/bandeja')?>" role="button" aria-haspopup="false" aria-expanded="false"
        title="Mensajería">
        <i class="fa fa-envelope noti-icon"></i>
      </a>




    </li>




    <li class="profile hidden-xs">
      <a href="javascript:" class="btn btn-transparent tooltip-hover-body reporte_docentes" data-uri="<?=base_url('GestionDocente/reportNotas')?>" title="Reportes">
        <i class="fa fa fa-file-text-o"></i>
      </a>
    </li>





  </ul>
  <ul class="nav navbar-nav navbar-right">
    <li class="profile hidden-xs">
    </li>
    <li class="dropdown profile hidden-xs">
      <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
        <span class="meta">
          <span class="avatar">
                                        <?php if (isset($this->session->webCasSession->usuario->RUTA)==false) {?>
                                        <img src=" <?= base_url('publico/media/user.png')?>" alt="profile" class="img-circle">
                                        <?php } else { ?>
                                        <img src="<?= base_url($this->session->webCasSession->usuario->RUTA)?>" alt="profile" class="img-circle">
                                        <?php } ?>


          </span>
          <span class="text"><?=$this->session->webCasSession->usuario->NOMBRE?></span>
          <span class="caret"></span>
        </span>
      </a>
      <ul class="dropdown-menu animated fadeInRight" role="menu">
        <li>
          <span class="arrow top"></span>
          <!--
                    <h5>
                        <span>80%</span>
                        <small class="text-muted">Profile complete</small>
                    </h5>
                    <div class="progress progress-xs">
                        <div class="progress-bar progress-bar" style="width: 80%">
                        </div>
                    </div>
                     -->
        </li>
        <li class="divider"></li>
        <li>
          <a class="mensajeria_docente" href="javascript:"  data-uri="<?=base_url('GestionDocente/bandeja')?>">
            <span class="icon">
              <i class="fa fa-envelope"></i>
            </span>Mis Mensajes</a>
        </li>
        <!--
                <li>
                    <a href="javascript:void(0);">
                        <span class="icon"><i class="fa fa-cog"></i>
                        </span>Ajustes</a>
                </li> -->

        <!-- AQUI -->



        <li class="divider"></li>
        <li>
          <a href="<?= site_url('login/logout')?>">
            <span class="icon">
              <i class="fa fa-sign-out"></i>
            </span>Cerrar sesión</a>
        </li>
      </ul>
    </li>


    <li class="toggle-fullscreen hidden-xs">
      <button type="button" class="btn btn-default expand tooltip-hover-body" id="toggle-fullscreen" data-original-title="Ver en pantalla completa">
        <i class="fa fa-expand"></i>
      </button>
    </li>
  </ul>
</header>
<script>
  var codigo = "<?=$this->session->webCasSession->usuario->ROLES?>";
if(codigo=='4'){
    $(".reporte_docentes").click(function(){
      uri= "<?=base_url('GestionDocente/reportNotas')?>";

      $("#main-content").load(uri);
    });
    $(".inicio_docente").click(function(){
      uri= "<?=base_url('GestionDocente/reportPrincipal')?>";
      $("#main-content").load(uri);
    });
    $(".mensajeria_docente").click(function(){
      uri= "<?=base_url('GestionDocente/bandeja')?>";
      $("#main-content").load(uri);
    });

}else if (codigo == '2'){
    $(".reporte_docentes").click(function(){
      uri= "<?=base_url('GestionEducativa/notasGeneral')?>";

      $("#main-content").load(uri);
    });
    $(".inicio_docente").click(function(){
      uri= "<?=base_url('GestionEducativa/vistaDirector')?>";
      $("#main-content").load(uri);
    });
    $(".mensajeria_docente").click(function(){
      uri= "<?=base_url('GestionEducativa/bandeja_2')?>";
      $("#main-content").load(uri);
    });
}else if (codigo == '5'){

    $(".inicio_docente").click(function(){
      uri= "<?=base_url('GestionAuxiliar/index')?>";
      $("#main-content").load(uri);
    });
    $(".mensajeria_docente").click(function(){
      uri= "<?=base_url('GestionAuxiliar/bandeja')?>";
      $("#main-content").load(uri);
    });
    $(".reporte_docentes").hide();
}else if (codigo == '6'){
    $(".reporte_docentes").click(function(){
      uri= "<?=base_url('GestionAlumno/consultarRecordAcade')?>";

      $("#main-content").load(uri);
    });
    $(".inicio_docente").click(function(){
      uri= "<?=base_url('GestionAlumno/index')?>";
      $("#main-content").load(uri);
    });
    $(".mensajeria_docente").click(function(){
      uri= "<?=base_url('GestionAlumno/bandeja')?>";
      $("#main-content").load(uri);
    });
}
</script>