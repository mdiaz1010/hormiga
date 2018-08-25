<?php ?>
<!DOCTYPE html>
<html lang="es" class="no-js">
<?=$this->load->view("plantillas_base/standar/head", (isset($head))? array('headData'=> &$head):'', true);?>
    <style>
        body {
            padding-right: 0 !important
        }
    </style>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <section id="main-wrapper" class="theme-default">
                    <?=$this->load->view("plantillas_base/standar/top_navbar", (isset($navbar))?array('navbarData'=> &$navbar):'', true);?>
                        <?=$this->load->view("plantillas_base/standar/panel_izq", (isset($panel))?array('panelData'=> &$panel):'', true);?>


                            <section class="main-content-wrapper">

                                <section id="cuerpo" class=" right_col animated fadeInUp" role="main" style="padding: 30px 50px 0;">

                                    <?=$this->load->view("bodys/".$body, (isset($bodyData))? array('bodyData'=> &$bodyData):'', true);?>

                                </section>
                                <?=$this->load->view("plantillas_base/standar/footer", (isset($footer))?array('footerData'=> &$footer):'', true);?>
                                <?=$this->load->view("plantillas_base/standar/js", (isset($js))? array('jsData'=> &$js) :'', true);?>
                            </section>
                            <!--main content end-->

                </section>
            </div>
        </div>
    </body>



    <script type="text/javascript">
        $(document).ready(function () {





            var nombre = "<?=$this->session->webCasSession->usuario->NOMBRE?>";
            var ruta = "<?=base_url('publico/media/escudo.png')?>"

            $.notify.addStyle('bienvenida', {
                html: '<div><div class="bienvenida"><div class="escudo"><img src=' + ruta +
                    ' height="50%" width="50%" /></div><div class="datos"><div class="row">Bienvenido(a):</div><div class="campo">' +
                    nombre +
                    '</div><div class="campo" style="font-size: 12px;">Profersor(a)</div></div></div></div>'
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