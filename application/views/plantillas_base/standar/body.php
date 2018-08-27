<?php ?>
<!DOCTYPE html>
<html lang="es" class="no-js">
<?=$this->load->view("plantillas_base/standar/head", (isset($head))? array('headData'=> &$head):'', true);?>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <section id="main-wrapper" class="theme-default">
                    <?=$this->load->view("plantillas_base/standar/top_navbar", (isset($navbar))?array('navbarData'=> &$navbar):'', true);?>

                        <aside class="sidebar sidebar-left nano">
                            <div class="nano-content">
                                <div class="sidebar-profile">
                                    <div class="avatar" align="center">
                                        <?php if (isset($this->session->webCasSession->usuario->RUTA)==false) {?>
                                        <img src=" <?= base_url('publico/media/user.png')?>" alt="profile" class="img-responsive avatar-view">
                                        <?php } else { ?>
                                        <img src="<?= base_url($this->session->webCasSession->usuario->RUTA)?>" alt="profile" class="img-responsive avatar-view"
                                            height="100" width="100">
                                        <?php } ?>

                                    </div>
                                    <div class="profile-body dropdown">

                                        <h4>
                                            <span class="col-md-12 col-sm-12 col-xs-12 name " data-html="true">
                                                <?=$this->session->webCasSession->usuario->NOMBRE?>
                                            </span>

                                        </h4>

                                        <small class="title" id="rol" name="rol"></small>


                                    </div>
                                </div>

                                <?=$this->load->view("plantillas_base/standar/panel_izq", (isset($panel))?array('panelData'=> &$panel):'', true);?>




                            </div>
                        </aside>


                        <section class="main-content-wrapper">

                            <section id="main-content" class="animated fadeInUp">

                                <?=$this->load->view("bodys/".$body, (isset($bodyData))? array('bodyData'=> &$bodyData):'', true);?>

                            </section>
                            <!-- <?php #$this->load->view("plantillas_base/standar/footer", (isset($footer))?array('footerData'=> &$footer):'', true);?>-->
                                <?=$this->load->view("plantillas_base/standar/js", (isset($js))? array('jsData'=> &$js) :'', true);?>
                        </section>
                        <!--main content end-->

                </section>
            </div>
        </div>

    </body>


    <script type="text/javascript">
        $(".body_load").click(function () {
            var uri = $(this).data('uri');
            $("#main-content").load(uri);
        });
        $(document).ready(function () {





            var nombre = "<?=$this->session->webCasSession->usuario->NOMBRE?>";
            var codigo = "<?=$this->session->webCasSession->usuario->ROLES?>";
            var ruta = "<?=base_url('publico/media/escudo.png')?>"
            var rol="";
            switch (codigo) {
                case "1":rol='Administrador';break;
                case "2":rol='Director';break;
                case "4":rol='Profesor(a)';break;
                case "5":rol='Auxiliar';break;
                case "6":rol='Alumno(a)';break;
            }
            $("#rol").html('<p>'+rol+'</p>');
            $.notify.addStyle('bienvenida', {
                html: '<div><div class="bienvenida"><div class="escudo"><img src=' + ruta +
                    ' height="50%" width="50%" /></div><div class="datos"><div class="row">Bienvenido(a):</div><div class="campo">' +
                    nombre +
                    '</div><div class="campo" style="font-size: 12px;">'+rol+'</div></div></div></div>'
            });

            $.notify("Bienvenido", {
                position: 'b r',
                style: 'bienvenida',
                autoHideDelay: 10 * 1000,
                clickToHide: true
            });




        });
    </script>

</html>