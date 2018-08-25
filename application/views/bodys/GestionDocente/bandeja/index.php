



    <section id="main-wrapper" class="theme-default">



        <style type="text/css">




body {
    }

.theme-default #header, .bienvenida {
    }

</style>







        <!--sidebar left end-->
        <!--main content start-->
        <section class="main-content-wrapper">
            <!-- <div class="pageheader">
                <h1>Intranet</h1>
                <p class="description">Bienvenidos a la Intranet CUBICOL</p>
                <div class="breadcrumb-wrapper hidden-xs">
                    <span class="label">Estas aquí:</span>
                    <ol class="breadcrumb">
                        <li class="active">Inicio</li>
                    </ol>
                </div>
            </div> -->

            <section id="main-content" class="animated fadeInUp" style="">

                                <style type="text/css">
                    .display-none {
                        display: none !important;
                    }

                    #jqxTreeEtiquetas ul.folder-list {
                        margin: 4px 0px 0px 0px;
                    }

                    #jqxTreeEtiquetas ul.folder-list li.list-group-item {
                        padding: 5px 4px;
                    }

                    #jqxTreeEtiquetas ul.folder-list li.list-group-item:hover {
                        background-color: inherit;
                    }
                </style>

                <div class="row row-offcanvas row-offcanvas-left" id="mensajeria-intranet">
                    <div class="col-md-2 col-sm-3 sidebar-offcanvas animated fadeInLeft" id="sidebar">
                        <div class="col-md-12 col-sm-12 col-xs-12 ibox float-e-margins" style="padding: 0px;">
                            <div class="col-md-12 col-sm-12 col-xs-12 ibox-content mailbox-content">
                                <div class="col-md-12 col-sm-12 col-xs-12 file-manager">
                                    <input type="hidden" id="txtEtiquetaid" value="1">


                                    <div class="pull-right">
                                        <div class="btn-group pull-right">
                                            <button data-toggle="dropdown" class="btn btn-default btn-sm dropdown-toggle"><i class="fa fa-cog fa-lg"></i> <span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                                <li><a id="itemConfGenerales" href="javascript:;">Configuraciones</a></li>
                                            </ul>
                                        </div>
                                    </div>


                                    <a id="btnCrearMensaje" class="btn btn-block btn-primary compose-mail" href="javascript:;" style="float: left; margin-bottom: 20px;">Crear mensaje</a>
                                    <ul class="folder-list m-b-md">
                                        <li><a href="javascript:;" etiqueta="1" etiquetades="Recibidos"><i class="fa fa-inbox"></i> Recibidos <span class="badge pull-right"></span></a></li>
                                        <li><a href="javascript:;" etiqueta="2" etiquetades="Enviados"><i class="fa fa-envelope-o"></i> Enviados <span class="badge pull-right"></span></a></li>
                                        <li><a href="javascript:;" etiqueta="3" etiquetades="Borradores"><i class="fa fa-file-text-o"></i> Borradores <span class="badge pull-right">3</span></a></li>
                                        <li><a href="javascript:;" etiqueta="4" etiquetades="Papelera"><i class="fa fa-trash-o"></i> Papelera <span class="badge pull-right"></span></a></li>                                    </ul>

                                    <div class="space-25"></div>

                                    <div class="head-division">
                                        <button id="btnEliminarCarpeta" class="btn btn-white btn-sm " data-toggle="tooltip" data-placement="bottom" title="Eliminar carpeta"><i class="fa fa-minus"></i> </button>
                                        <button id="btnAgregarCarpeta" class="btn btn-white btn-sm " data-toggle="tooltip" data-placement="bottom" title="Crear carpeta"><i class="fa fa-plus"></i> </button>
                                        <h5>Carpetas</h5>
                                    </div>

                                    <div id="jqxTreeEtiquetas"></div>



                                    <!-- <h5 class="tag-title">Etiquetas</h5>
                                    <ul class="tag-list" style="padding: 0">
                                        <li><a href=""><i class="fa fa-tag"></i> Family</a></li>
                                        <li><a href=""><i class="fa fa-tag"></i> Work</a></li>
                                        <li><a href=""><i class="fa fa-tag"></i> Home</a></li>
                                        <li><a href=""><i class="fa fa-tag"></i> Children</a></li>
                                        <li><a href=""><i class="fa fa-tag"></i> Holidays</a></li>
                                        <li><a href=""><i class="fa fa-tag"></i> Music</a></li>
                                        <li><a href=""><i class="fa fa-tag"></i> Photography</a></li>
                                        <li><a href=""><i class="fa fa-tag"></i> Film</a></li>
                                    </ul> -->
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>




                    <div id="contenedor-mensajeria" class="col-md-10 col-sm-9">
                        <div id="mensajeria-listado" class="col-md-6 col-sm-6 animated fadeInRight">
                            <div class="mail-box-content col-md-12 col-sm-12 col-xs-12">

                                <div class="mail-box-header col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <button class="btn btn-primary btn-sm visible-xs pull-left" data-toggle="offcanvas" id="btnCanvas"><i class="fa fa-bars"></i></button>
                                        <h2 style="margin-top: 6px; margin-bottom: 4px;">
                                            Recibidos                                         </h2>
                                    </div>

                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <!--<form method="get" action="index.html" style="margin-bottom: 4px;">  onkeyup="buscarMensaje($('#txtEtiquetaid').val(), this.value);" -->
                                            <div class="input-group">
                                                <input type="text" class="form-control input-sm" id="txtsearch" placeholder="Buscar mensaje" >
                                                <div class="input-group-btn">
                                                    <button id="btnBuscarMensaje" type="button" class="btn btn-sm btn-primary">Buscar</button>
                                                </div>
                                            </div>
                                        <!--</form>-->
                                    </div>


                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <!-- <div class="btn-group pull-right">
                                            <button type="button" class="btn btn-sm btn-default" title="Primera página"><i class="fa fa-angle-double-left"></i></button>
                                            <button type="button" class="btn btn-sm btn-default"><i class="fa fa-angle-left"></i></button>
                                            <button type="button" class="btn btn-sm btn-primary">1</button>
                                            <button type="button" class="btn btn-sm btn-default">2</button>
                                            <button type="button" class="btn btn-sm btn-default">3</button>
                                            <button type="button" class="btn btn-sm btn-default"><i class="fa fa-angle-right"></i></button>
                                            <button type="button" class="btn btn-sm btn-default"><i class="fa fa-angle-double-right"></i></button>
                                        </div> -->



                                        <div class="btn-group">
                                            <span class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" style="padding: 4px 10px 5px;">
                                                <input type="checkbox" class="i-check-master" style="margin: 0px;" />
                                                <span class="caret" style="margin-left: 3px;"></span>
                                            </span>
                                            <ul class="dropdown-menu" role="menu">
                                                <li>
                                                    <a href="javascript:;" class="accionesMarcar" accion="todo">Todo</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;" class="accionesMarcar" accion="nada">Nada</a>
                                                </li>
                                                <li class="divider"></li>
                                                <li>
                                                    <a href="javascript:;" class="accionesMarcar" accion="leido">Leído</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;" class="accionesMarcar" accion="no-leido">No leído</a>
                                                </li>
                                            </ul>
                                        </div>


                                        <button id="btnActualizarBandeja" class="btn btn-default btn-sm tooltip-hover" data-original-title="Actualizar"><i class="fa fa-refresh"></i> </button>
                                        <button class="btn btn-default btn-sm tooltip-hover" data-original-title=""><i class="fa fa-eye"></i> </button>
                                        <button id="btnEliminarMensaje" class="btn btn-default btn-sm tooltip-hover" data-original-title="Mover a la papelera"><i class="fa fa-trash-o"></i> </button>
                                        <button id="btnMoverMensaje" class="btn btn-default btn-sm tooltip-hover" data-original-title="Mover a ..."><i class="fa fa-folder-open"></i> </button>
                                    </div>


                                </div>



                                <!-- <div class="col-md-12 col-sm-12 col-xs-12 mail-box mensajes-scroll" style="padding: 0px; min-height: 700px; height: 700px; max-height: 700px; overflow-y: auto;"> -->
                                <div class="mail-box mensajes-scroll" style="float: left; width: 100%; min-height: 713px; height: 713px; max-height: 713px; overflow-y: scroll;">


<div class="no-messages">
    No existen mensajes en esta carpeta.</div>


                                </div>

                            </div>
                        </div>









                        <div id="mensajeria-visor" class="col-md-6 col-sm-6 col-xs-12 animated fadeInRight">
                            <div class="mail-view-empty">
                                <div class="info">
                                    Nada para leer.                                    <br />
                                    Seleccione algún mensaje del listado anterior.                                </div>
                            </div>
                                                    </div>
                    </div>

                    <div id="contenedor-adicional" class="col-md-10 col-sm-8">

                    </div>







                </div>




                <!-- modales -->
                <div id="confirmacionEliminacionEtiqueta" class="modal fade">
                    <div class="modal-dialog">

                        <div class="modal-content">

                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h3 class="modal-title"></h3>
                            </div>

                            <div class="modal-body">
                                <p id="info"></p>
                                <p id="nodos"></p>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary">Eliminar</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            </div>

                        </div>

                    </div>
                </div>

                <div id="wEtiqueta">
                    <div></div>
                    <div></div>
                </div>

                <div id="wDestinatarios">
                    <div></div>
                    <div></div>
                </div>

                <div id="wPestana">
                    <div></div>
                    <div></div>
                </div>

                <div id="wPestanaDetalle">
                    <div></div>
                    <div></div>
                </div>

                <div id="wPestanasPerfil">
                    <div></div>
                    <div></div>
                </div>

                <div id="wSeleccionarContactos">
                    <div></div>
                    <div></div>
                </div>

                <div id="wMover">
                    <div></div>
                    <div></div>
                </div>


            </section>
            <section id="balloons-container" style="height: 410px !important;">

            </section>
        </section>
        <!--main content end-->
    </section>





    <!--sidebar right start-->
    <aside id="sidebar-right">
    <!-- <aside id="sidebar-right"> -->
        <h4 class="sidebar-title">
            Cursos que dicto        </h4>
        <div id="widget-list-wrapper">






            <div class="heading">
                <ul>
                    <!-- <li class="new-contact"><a href="javascript:void(0)"><i class="fa fa-plus"></i></a>
                    </li> -->
                    <li>


                        <input type="text" class="search" placeholder="Filtrar cursos">


                    </li>
                </ul>
            </div>
            <div id="widget-list" class="nano">
                <div class="nano-content">
                    <ul>


                        <li curso="007" salon="2018009" tabindex="100" style="background-color: rgba(, , , 0.2);">
                            <a href="/intranet/curso/007/2018009" class="tooltip-hover-body" data-placement="top" data-html="true" data-original-title='<span style="font-weight: 600; font-size: 13px;">LÓGICO MATEMÁTICO</span><br />Inicial 5 años Lealtad Azul'>
                                <div class="row">
                                    <!-- <div class="col-md-3 col-sm-3 col-xs-3">
                                        <span class="avatar">
                                            <img src="" class="img-circle" alt="">
                                        </span>
                                    </div> -->
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="nombre-curso" style="color: rgba(, , , 1);">LÓGICO MATEMÁTICO</div>
                                        <small class="nombre-salon">Inicial 5 años Lealtad Azul</small>
                                    </div>
                                </div>
                            </a>
                        </li>


                        <li curso="008" salon="2018009" tabindex="100" style="background-color: rgba(, , , 0.2);">
                            <a href="/intranet/curso/008/2018009" class="tooltip-hover-body" data-placement="top" data-html="true" data-original-title='<span style="font-weight: 600; font-size: 13px;">COMUNICACIÓN INTEGRAL</span><br />Inicial 5 años Lealtad Azul'>
                                <div class="row">
                                    <!-- <div class="col-md-3 col-sm-3 col-xs-3">
                                        <span class="avatar">
                                            <img src="" class="img-circle" alt="">
                                        </span>
                                    </div> -->
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="nombre-curso" style="color: rgba(, , , 1);">COMUNICACIÓN INTEGRAL</div>
                                        <small class="nombre-salon">Inicial 5 años Lealtad Azul</small>
                                    </div>
                                </div>
                            </a>
                        </li>


                        <li curso="009" salon="2018009" tabindex="100" style="background-color: rgba(, , , 0.2);">
                            <a href="/intranet/curso/009/2018009" class="tooltip-hover-body" data-placement="top" data-html="true" data-original-title='<span style="font-weight: 600; font-size: 13px;">PERSONAL SOCIAL</span><br />Inicial 5 años Lealtad Azul'>
                                <div class="row">
                                    <!-- <div class="col-md-3 col-sm-3 col-xs-3">
                                        <span class="avatar">
                                            <img src="" class="img-circle" alt="">
                                        </span>
                                    </div> -->
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="nombre-curso" style="color: rgba(, , , 1);">PERSONAL SOCIAL</div>
                                        <small class="nombre-salon">Inicial 5 años Lealtad Azul</small>
                                    </div>
                                </div>
                            </a>
                        </li>


                        <li curso="010" salon="2018009" tabindex="100" style="background-color: rgba(, , , 0.2);">
                            <a href="/intranet/curso/010/2018009" class="tooltip-hover-body" data-placement="top" data-html="true" data-original-title='<span style="font-weight: 600; font-size: 13px;">CIENCIA Y AMBIENTE</span><br />Inicial 5 años Lealtad Azul'>
                                <div class="row">
                                    <!-- <div class="col-md-3 col-sm-3 col-xs-3">
                                        <span class="avatar">
                                            <img src="" class="img-circle" alt="">
                                        </span>
                                    </div> -->
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="nombre-curso" style="color: rgba(, , , 1);">CIENCIA Y AMBIENTE</div>
                                        <small class="nombre-salon">Inicial 5 años Lealtad Azul</small>
                                    </div>
                                </div>
                            </a>
                        </li>


                        <li curso="005" salon="2018009" tabindex="100" style="background-color: rgba(, , , 0.2);">
                            <a href="/intranet/curso/005/2018009" class="tooltip-hover-body" data-placement="top" data-html="true" data-original-title='<span style="font-weight: 600; font-size: 13px;">FORMACIÓN CRISTIANA</span><br />Inicial 5 años Lealtad Azul'>
                                <div class="row">
                                    <!-- <div class="col-md-3 col-sm-3 col-xs-3">
                                        <span class="avatar">
                                            <img src="" class="img-circle" alt="">
                                        </span>
                                    </div> -->
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="nombre-curso" style="color: rgba(, , , 1);">FORMACIÓN CRISTIANA</div>
                                        <small class="nombre-salon">Inicial 5 años Lealtad Azul</small>
                                    </div>
                                </div>
                            </a>
                        </li>


                        <li curso="028" salon="2018009" tabindex="100" style="background-color: rgba(, , , 0.2);">
                            <a href="/intranet/curso/028/2018009" class="tooltip-hover-body" data-placement="top" data-html="true" data-original-title='<span style="font-weight: 600; font-size: 13px;">PSICOMOTRICIDAD</span><br />Inicial 5 años Lealtad Azul'>
                                <div class="row">
                                    <!-- <div class="col-md-3 col-sm-3 col-xs-3">
                                        <span class="avatar">
                                            <img src="" class="img-circle" alt="">
                                        </span>
                                    </div> -->
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="nombre-curso" style="color: rgba(, , , 1);">PSICOMOTRICIDAD</div>
                                        <small class="nombre-salon">Inicial 5 años Lealtad Azul</small>
                                    </div>
                                </div>
                            </a>
                        </li>


                        <li curso="004" salon="2018009" tabindex="100" style="background-color: rgba(, , , 0.2);">
                            <a href="/intranet/curso/004/2018009" class="tooltip-hover-body" data-placement="top" data-html="true" data-original-title='<span style="font-weight: 600; font-size: 13px;">INGLÉS</span><br />Inicial 5 años Lealtad Azul'>
                                <div class="row">
                                    <!-- <div class="col-md-3 col-sm-3 col-xs-3">
                                        <span class="avatar">
                                            <img src="" class="img-circle" alt="">
                                        </span>
                                    </div> -->
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="nombre-curso" style="color: rgba(, , , 1);">INGLÉS</div>
                                        <small class="nombre-salon">Inicial 5 años Lealtad Azul</small>
                                    </div>
                                </div>
                            </a>
                        </li>


                    </ul>
                </div>
            </div>






            <div id="widget-user">
                <div class="item-user item-user-cursos active tooltip-hover-body" data-placement="top" data-original-title="Cursos que dicto"><span><i class="icon-notebook"></i></span>
                </div>
                <a href="/intranet/mensajeria" class="item-user item-user-mensajes tooltip-hover-body" data-placement="top" data-original-title="Mensajes"><span><i class="icon-envelope"></i></span>
                </a>
                <div class="item-user item-user-chat tooltip-hover-body" data-placement="top" data-original-title="Chat (Próximamente)"><span><i class="icon-bubble"></i></span>
                </div>
            </div>
        </div>
    </aside>
    <!--/sidebar right end-->







    <!--Config demo-->
    <!-- <div id="config" class="config hidden-xs">
        <h4>Settings<a href="javascript:void(0)" class="config-link closed"><i class="icon-settings"></i></a></h4>
        <div class="config-swatch-wrap">
            <div class="row">
                <div class="col-xs-6">
                    <ul class="options">
                        <li>
                            <div class="theme-style-wrapper" data-theme="theme-default">
                                <span class="header bg-white"></span>
                                <span class="header bg-white"></span>
                                <span class="nav bg-dark"></span>
                            </div>
                        </li>
                        <li>
                            <div class="theme-style-wrapper" data-theme="theme-dark">
                                <span class="header bg-dark"></span>
                                <span class="header bg-white"></span>
                                <span class="nav bg-dark"></span>
                            </div>
                        </li>
                        <li>
                            <div class="theme-style-wrapper" data-theme="theme-blue">
                                <span class="header bg-info"></span>
                                <span class="header bg-white"></span>
                                <span class="nav bg-dark"></span>
                            </div>
                        </li>
                        <li>
                            <div class="theme-style-wrapper" data-theme="theme-blue-full">
                                <span class="header bg-info"></span>
                                <span class="header bg-info"></span>
                                <span class="nav bg-dark"></span>
                            </div>
                        </li>
                        <li>
                            <div class="theme-style-wrapper" data-theme="theme-grey">
                                <span class="header bg-grey"></span>
                                <span class="header bg-white"></span>
                                <span class="nav bg-dark"></span>
                            </div>
                        </li>
                        <li>
                            <div class="theme-style-wrapper" data-theme="theme-grey-full">
                                <span class="header bg-grey"></span>
                                <span class="header bg-grey"></span>
                                <span class="nav bg-dark"></span>
                            </div>
                        </li>

                    </ul>
                </div>
                <div class="col-xs-6">
                    <ul class="options">
                        <li>
                            <div class="theme-style-wrapper" data-theme="theme-dark-full">
                                <span class="header bg-dark"></span>
                                <span class="header bg-dark"></span>
                                <span class="nav bg-dark"></span>
                            </div>
                        </li>
                        <li>
                            <div class="theme-style-wrapper" data-theme="theme-green">
                                <span class="header bg-green"></span>
                                <span class="header bg-white"></span>
                                <span class="nav bg-dark"></span>
                            </div>
                        </li>
                        <li>
                            <div class="theme-style-wrapper" data-theme="theme-green-full">
                                <span class="header bg-green"></span>
                                <span class="header bg-green"></span>
                                <span class="nav bg-dark"></span>
                            </div>
                        </li>
                        <li>
                            <div class="theme-style-wrapper" data-theme="theme-red">
                                <span class="header bg-red"></span>
                                <span class="header bg-white"></span>
                                <span class="nav bg-dark"></span>
                            </div>
                        </li>
                        <li>
                            <div class="theme-style-wrapper" data-theme="theme-red-full">
                                <span class="header bg-red"></span>
                                <span class="header bg-red"></span>
                                <span class="nav bg-dark"></span>
                            </div>
                        </li>
                        <li>
                            <div class="theme-style-wrapper" data-theme="theme-dark-blue-full">
                                <span class="header bg-dark-blue"></span>
                                <span class="header bg-dark-blue"></span>
                                <span class="nav bg-dark"></span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div> -->


    <div id="message-succes"></div>
    <div id="message-error"></div>
    <div id="message-warning"></div>
    <div id="message-info"></div>








    <script type="text/javascript" src="http://www.cubicol.pe/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/jquery-ui-1.11.4/jquery-ui.min.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/bootstrap.min.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/jqwidgets/jqxcore.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/jqwidgets/jqxdata.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/jquery.i18n.js"></script>
<script type="text/javascript" src="http://emanuel.cubicol.pe/principal/idioma"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/jquery.slimscroll.min.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/bootbox.min.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/formvalidation/formValidation.min.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/formvalidation/framework/bootstrap.min.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/jquery.navgoco.min.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/modernizr-2.6.2.min.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/pace.min.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/jquery.fullscreen-min.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/switchery.min.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/jqwidgets/jqxnotification.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/jquery.cookie.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/app.js?afaa9b4a48993833ef46bbb2ea287407"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/jquery.scrolling-tabs.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/jquery.nanoscroller.min.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/messenger-1.4.1/build/js/messenger.min.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/messenger-1.4.1/build/js/messenger-theme-flat.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/tipped/js/tipped.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/notify.min.js"></script>
<!--[if lt IE 9]><script type="text/javascript" src="http://www.cubicol.pe/js/respond.min.js"></script><![endif]-->
<!--[if lt IE 9]><script type="text/javascript" src="http://www.cubicol.pe/js/html5shiv.js"></script><![endif]-->
<script type="text/javascript" src="http://www.cubicol.pe/js/util/funciones.js?7bd0b9bc538b496b2ac6b46c2be5b591"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/init.js?fa6ec8e596de9e22be031b3f08b9aa9b"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/bootstrap-treeview/dist/bootstrap-treeview.min.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/icheck/icheck.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/readmore.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/jquery.ui.widget.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/load-image.all.min.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/canvas-to-blob.min.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/jQuery-File-Upload-9.11.2/js/jquery.fileupload.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/jQuery-File-Upload-9.11.2/js/jquery.fileupload-process.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/jQuery-File-Upload-9.11.2/js/jquery.fileupload-validate.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/jqwidgets/jqxbuttons.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/jqwidgets/jqxscrollbar.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/jqwidgets/jqxlistbox.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/jqwidgets/jqxcheckbox.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/jqwidgets/jqxdatatable.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/jqwidgets/jqxtreegrid.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/jqwidgets/jqxwindow.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/jqwidgets/jqxpanel.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/jqwidgets/jqxmenu.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/jqwidgets/jqxgrid.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/jqwidgets/jqxgrid.sort.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/jqwidgets/jqxgrid.filter.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/jqwidgets/jqxgrid.storage.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/jqwidgets/jqxgrid.columnsresize.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/jqwidgets/jqxgrid.columnsreorder.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/jqwidgets/jqxgrid.pager.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/jqwidgets/jqxgrid.edit.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/jqwidgets/jqxgrid.selection.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/jqwidgets/jqxdropdownlist.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/jqwidgets/jqxdatetimeinput.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/jqwidgets/jqxcalendar.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/jqwidgets/jqxtree.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/jqwidgets/jqxexpander.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="http://emanuel.cubicol.pe/js/tinymce/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/bootstrap-tokenfield/dist/bootstrap-tokenfield.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/bootstrap-tokenfield/docs-assets/js/scrollspy.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/bootstrap-tokenfield/docs-assets/js/affix.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/bootstrap-tokenfield/docs-assets/js/typeahead.bundle.min.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/bootstrap-tokenfield/docs-assets/js/docs.min.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/intranet/mensajeria.js?cc07752aa8c4b6f05b9f7e257327b120"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/jquery.jscroll.min.js"></script>
<script type="text/javascript" src="http://www.cubicol.pe/js/jquery.printarea.js"></script>
<script type="text/javascript">
    //<!--
        //$(document).ready(function(){



/*if($('.jscroll-added').length > 0){
    $('.jscroll-added:last div.message:eq(0)').focus();
}*/

/*if($('div#mensajeria-listado').find('div.mail-box').parent().hasClass('slimScrollDiv')){
    $('div#mensajeria-listado').find('div.mail-box').parent().replaceWith($('div#mensajeria-listado').find('div.mail-box'));
}*/
/*$('div#mensajeria-listado').find('div.mail-box').slimScroll({
    height: 713,
    alwaysVisible: true,
    touchScrollStep: 80,
    wheelStep: 12,
    //start: $('div.mail-box div.message:eq(0)')
});*/




/*$('div#mensajeria-listado').find('div.mail-box').slimScroll().bind('slimscroll', function(e, pos){
    if(pos == 'bottom' && $('div.cargando-mensajes').length == 0){
        console.log('click ');
        $('a.jScroll:last').click();
    }
});*/









iChecksListadoMensajes();
asociarEventosListadoMensajes();
asociarEventoEliminarMensaje();




    //});

    //-->
</script>
<script type="text/javascript">
    //<!--
                    //<script type="text/javascript">
                var currentNodeId = null;
                var intervalo;


                /*$('#jqxTreeEtiquetas').jqxTree({
                    source: arbolEtiquetas,
                    width: '100%',
                    height: '300px'
                });

                $('#jqxTreeEtiquetas').on('select', function(e){
                    var item = $('#jqxTreeEtiquetas').jqxTree('getItem', e.args.element);
                    verContenidoEtiqueta(item.id, item.value);
                });*/

                generarArbolEtiquetas([]);

                $('button#btnBuscarMensaje').click(function(){
                    //buscarMensaje($("input#txtEtiquetaid").val(), $("input#txtsearch").val());
                    verContenidoEtiqueta($("input#txtEtiquetaid").val(), '', $("input#txtsearch").val());
                });

                $('#wEtiqueta').jqxWindow({
                    height: 280,
                    bootstrapCssCol: 'col-md-5 col-sm-6 col-xs-11',
                    title: '',
                    autoOpen: false,
                    isModal: true,
                    initContent: function () {
                        $('#wEtiqueta').jqxWindow('focus');
                    }
                });

                $('button#btnActualizarBandeja').click({etiqueta: 1, descripcion: 'Recibidos'}, function(e){
                    verContenidoEtiqueta(e.data.etiqueta, e.data.descripcion);
                });

                /*$('div#mensajeria-listado').find('div.mail-box').slimScroll({
                    height: 708,
                    alwaysVisible: true,
                    touchScrollStep: 200,
                    wheelStep: 12
                });*/

                //$('div#mensajeria-listado').find('div.mail-box').scrollbar();

                /*$('div#mensajeria-listado').find('div.mail-box').mCustomScrollbar({
                    setHeight: 713,
                    theme: 'minimal-dark',
                    callbacks: {
                        onTotalScroll:function(){
                            $('a.jScroll:last').click();
                        }
                    }
                });*/

                $('#wDestinatarios').jqxWindow({
                    height: 400,
                    bootstrapCssCol: 'col-md-7 col-sm-7 col-xs-11',
                    title: 'Destinatarios',
                    autoOpen: false,
                    isModal: true,
                    initContent: function () {
                        $('#wDestinatarios').jqxWindow('focus');
                    }
                });

                $('#wPestana').jqxWindow({
                    height: 210,
                    bootstrapCssCol: 'col-md-5 col-sm-6 col-xs-11',
                    title: '',
                    autoOpen: false,
                    isModal: true,
                    initContent: function () {
                        $('#wPestana').jqxWindow('focus');
                    }
                });

                $('#wPestanaDetalle').jqxWindow({
                    height: 450,
                    bootstrapCssCol: 'col-md-5 col-sm-6 col-xs-11',
                    title: 'Detalle de la pestaña',
                    autoOpen: false,
                    isModal: true,
                    initContent: function () {
                        $('#wPestanaDetalle').jqxWindow('focus');
                    }
                });

                $('#wPestanasPerfil').jqxWindow({
                    height: 450,
                    bootstrapCssCol: 'col-md-5 col-sm-6 col-xs-11',
                    title: 'Pestanas relacionadas al perfil',
                    autoOpen: false,
                    isModal: true,
                    initContent: function () {
                        $('#wPestanasPerfil').jqxWindow('focus');
                    }
                });

                $('#wSeleccionarContactos').jqxWindow({
                    height: 600,
                    bootstrapCssCol: 'col-md-9 col-sm-9 col-xs-11',
                    title: 'Selección de contactos',
                    autoOpen: false,
                    isModal: true,
                    resizable: false,
                    initContent: function () {
                        $('#wSeleccionarContactos').jqxWindow('focus');
                    }
                });

                $('#wMover').jqxWindow({
                    height: 180,
                    bootstrapCssCol: 'col-md-5 col-sm-6 col-xs-11',
                    title: 'Mover a ...',
                    autoOpen: false,
                    isModal: true,
                    initContent: function () {
                        $('#wMover').jqxWindow('focus');
                    }
                });

                $('button#btnMoverMensaje').click(function(){
                    var existenMarcados = false;
                    $('.i-checks').each(function(index, element){
                        if($(element).is(':checked')){
                            existenMarcados = true;

                            return false;
                        }
                    });

                    if(existenMarcados){
                        $('#wMover').jqxWindow('open');
                        $.ajax({
                            type: 'POST',
                            url: '/intranet/mensajeria/mover',
                            data: {
                                etiqueta: 1
                            },
                            beforeSend: function(jqXHR, settings){
                                $('#wMover').jqxWindow('setContent', $.i18n._('Cargando ...'));
                            },
                            success: function(data, textStatus, jqXHR){
                                $('#wMover').jqxWindow('setContent', data);
                            },
                            error: function(jqXHR, textStatus, errorThrown){
                                $('#wMover').jqxWindow('setContent', 'Error!');
                            }
                        });
                    }
                });


                function iCheckSeleccionarMensajes(marcar, clase){
                    clase = typeof clase == 'undefined' ? '' : clase;
                    $('.i-checks').each(function(index, element){
                        $(element).iCheck('uncheck');
                        $(element).parents('.message').removeClass('selected');

                        var marcarCheck = marcar;
                        if(marcar && clase != ''){
                            marcarCheck = $(element).parents('.message').hasClass(clase);
                        }

                        if(marcarCheck){
                            $(element).iCheck('check');
                            $(element).parents('.message').addClass('selected');
                        }
                    });
                }


                $('.i-check-master').iCheck({
                    checkboxClass: 'icheckbox_minimal-grey',
                    radioClass: 'iradio_minimal-grey'
                });

                $('.i-check-master').on('ifChanged', function(e){
                    iCheckSeleccionarMensajes($(e.target).is(':checked'));
                });

                $('.accionesMarcar').each(function(index, element){
                    var accion = $(element).attr('accion');
                    $(element).click({accion: accion}, function(e){
                        switch(e.data.accion){
                            case 'todo':
                                iCheckSeleccionarMensajes(true);
                                break;
                            case 'nada':
                                iCheckSeleccionarMensajes(false);
                                break;
                            case 'leido':
                                iCheckSeleccionarMensajes(true, 'read');
                                break;
                            case 'no-leido':
                                iCheckSeleccionarMensajes(true, 'unread');
                                break;
                        }
                    });
                });


                asociarEventoEliminarMensaje(1);





                /*$('.mCSB_container').jscroll({
                    //autoTriggerUntil: 2,
                    autoTrigger: false,
                    loadingHtml: '<div class="panel panel-default cargando-mensajes"><div class="panel-body text-center"><i class="fa fa-refresh fa-spin"></i></div></div>',
                    nextSelector: 'a.jScroll:last',
                    padding: 1000,
                    //contentSelector: 'div.mail-box'
                });*/


                $('.mensajes-scroll').jscroll({
                    //autoTriggerUntil: 2,
                    autoTrigger: false,
                    loadingHtml: '<div class="panel panel-default cargando-mensajes"><div class="panel-body text-center"><i class="fa fa-refresh fa-spin"></i></div></div>',
                    nextSelector: 'a.jScroll:last',
                    //padding: 1000,
                    //contentSelector: 'div.mail-box'
                });



    //-->
</script>
    <script type="text/javascript">

        $(document).ready(function(){


            navgoco_nanoScroller('intranet');


            $('body').tooltip({
                selector: ".tooltip-hover-body",
                container: "body",
                placement: function(tooltip, element){
                    var p = "bottom";
                    if(typeof $(element).attr('data-placement') != 'undefined'){
                        p = $(element).attr('data-placement');
                    }

                    return p;
                }
            });

            $('.main-content-wrapper').tooltip({
                selector: ".tooltip-hover",
                container: ".main-content-wrapper",
                placement: function(tooltip, element){
                    var p = "bottom";
                    if(typeof $(element).attr('data-placement') != 'undefined'){
                        p = $(element).attr('data-placement');
                    }

                    return p;
                }
            });



            Messenger.options = { theme: 'flat' };





            $('#widget-list-wrapper .heading .search').keyup(function(e){
                var texto = $.trim($(this).val());

                $('div#widget-list div.nano-content ul > li').show();
                if(texto !== ''){
                    $('div#widget-list div.nano-content ul > li').each(function(index, element){
                        var show = $(element).find('a .nombre-curso').text().toUpperCase().search(texto.toUpperCase()) > -1
                                    || $(element).find('a .nombre-profesor').text().toUpperCase().search(texto.toUpperCase()) > -1;

                        $(element).css('display', !show ? 'none' : '');
                    });
                }
            });













            var usuariosAvatar;
            $('#widget-list .avatar').each(function(index, el){
                if(typeof usuariosAvatar == 'undefined'){
                    usuariosAvatar = [];
                }

                var usuario = $(el).attr('usuario');
                if(usuario == '' || usuario == null){
                    return true;
                }

                var consulta = $.grep(usuariosAvatar, function(u){ return u == usuario; });
                if(consulta.length == 0){
                    //console.log('#widget-list .avatar[usuario="' + usuario + '"]');
                    Tipped.create('#widget-list .avatar[usuario="' + usuario + '"]', {
                        ajax: {
                            url: '/intranet/perfil/perfil',
                            type: 'post',
                            data: {
                                usuario: usuario
                            }
                        },
                        skin: 'light',
                        size: 'large',
                        radius: false,
                        position: 'topleft'
                    });
                    usuariosAvatar.push(usuario);
                }
            });

        });


        function configurarNotificaciones(){
            $('#wConfigurarNotificaciones').jqxWindow('open');
            $.ajax({
                type: 'POST',
                url: '/intranet/configuracion/notificaciones',
                data: {

                },
                beforeSend: function(jqXHR, settings){
                    $('#wConfigurarNotificaciones').jqxWindow('setContent', 'Cargando ...');
                },
                success: function(data, textStatus, jqXHR){
                    $('#wConfigurarNotificaciones').jqxWindow('setContent', data);
                },
                error: function(jqXHR, textStatus, errorThrown){
                    $('#wConfigurarNotificaciones').jqxWindow('setContent', 'Error');
                }
            });
        }


    </script>


<script type="text/javascript">

    $(document).ready(function(){

        $('#cumple').modal('show');
        //$('#cumple').delay(2000).fadeOut();

        //setTimeout( function(){$('#cumple').modal('hide');} , 10000);
        $('#close').on( "click", function( event ) {
             $('#cumple').modal('hide');
        });

        //$('.modal-backdrop').remove();
        $('#menu-drop').on('show.bs.dropdown', function () {
             var divNano = $(this).find('div.dropdown-menu').find('div.nano');
             setTimeout(function(){
                 divNano.nanoScroller();
             }, 100);
         });









    });

</script>
