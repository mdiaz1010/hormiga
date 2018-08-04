<?php ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="<?= base_url('publico/html_libs/jquery/dist/jquery.min.js')?>"></script>
    <script src="<?=base_url('publico/login/js/index.js')?>"></script>
    <script src="<?= base_url('publico/js/jquery-ui.js')?>"></script>
    <link href="<?=base_url('publico/css/jquery-ui.css')?>" rel="stylesheet">
    <link rel="icon" href="<?=base_url('publico/media/indice.ico')?>" type="image/x-icon" />
    <link href="<?= base_url('publico/html_libs/bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url('publico/login/css/style.css')?>">
    <link rel="stylesheet" href="<?=base_url('publico/css/site-demos.css')?>">
    <script src="<?= base_url('publico/js/jquery.validate.min.js')?>"></script>
    <!-- Font Awesome -->
    <link href="<?=base_url('publico/html_libs/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet">
    <title>Inicio Sesion | EDUMPRO</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">

</head>

<body class="body">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <!-- Include the above in your HEAD tag -->

    <section class="login-block">

        <div class="container">

            <div class="row">

                <div class="col-md-4 login-sec">
                    <h2 class="text-center">Iniciar Sesión</h2>
                    <div class="alert alert-success" id='exitos'>
                        <strong>¡Correcto!</strong> Usuario y contraseña correctas.
                    </div>
                    <div class="alert alert-danger" id="errors">
                        <strong>¡Error!</strong> Usuario o contraseña incorrectos.
                    </div>
                    <form class="login-form" method='POST' id="loginf" name="loginf" autocomplete="off">
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="text-uppercase">Usuario:</label>
                            <input name="user" id="user" type="text" class="form-control" placeholder="" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1" class="text-uppercase">Contraseña:</label>
                            <input name="pass" id="pass" type="password" class="form-control" placeholder="" autocomplete="off">
                        </div>

                        <div class="form-check">
                            <input type="button" name="btnIngresar" id="btnIngresar" style="background-color:#DE6262;border-color:#DE6262;" class="btn btn-danger float-right" value="Ingresar">
                        </div>
                    </form>
                    <div class="form-group">
                        <a href="#" class="recuperar_contrasena" style="color:#DE6262">¿Se olvidó la contraseña.?</a>
                    </div>
                    <div class="copy-text">Elaborado por
                        <a href="http://edumpro.com" target="_blank">edumpro.com</a>
                    </div>
                </div>

                <div class="col-md-8 banner-sec">

                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">


                        </ol>
                    </div>

                    <div class="carousel-inner">

                        <div class="carousel-item active">
                            <img class="d-block img-fluid" src="<?= base_url('publico/login/carrusel/fondo1.jpg')?>" alt="First slide">
                            <div class="carousel-caption d-none d-md-block">
                                <!--
                                    <h2>Edumpro</h2>
                                    <p>Aplicativo de seguimiento  del aprendizaje de los estudiantes</p>
                            -->
                            </div>
                        </div>




                    </div>

                </div>


            </div>

        </div>

        <div id="DIVcargando">
            <h5>
                <center>
                    <strong>Esperes estamos cargando la informacion...</strong>
                    <span class="fa fa-spinner fa-pulse fa-2x fa-fw"></span>
                </center>
            </h5>
        </div>

    </section>
</body>

</html>