<div class="row row-offcanvas row-offcanvas-left" id="mensajeria-intranet">
    <div class="col-md-2 col-sm-3 sidebar-offcanvas animated fadeInLeft" id="sidebar">
        <div class="col-md-12 col-sm-12 col-xs-12 ibox float-e-margins" style="padding: 0px;">
            <div class="col-md-12 col-sm-12 col-xs-12 ibox-content mailbox-content">
                <div class="col-md-12 col-sm-12 col-xs-12 file-manager">
                    <input type="hidden" id="txtEtiquetaid" value="1">


                    <div class="pull-right">
                        <div class="btn-group pull-right">
                            <button data-toggle="dropdown" class="btn btn-default btn-sm dropdown-toggle">
                                <i class="fa fa-cog fa-lg"></i>
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a id="itemConfGenerales" href="javascript:;">Configuraciones</a>
                                </li>
                            </ul>
                        </div>
                    </div>


                    <a id="btnCrearMensaje" class="btn btn-block btn-primary compose-mail" href="javascript:;" style="float: left; margin-bottom: 20px;">Crear mensaje</a>
                    <ul class="folder-list m-b-md">
                        <li>
                            <a href="javascript:;" etiqueta="1" etiquetades="Recibidos">
                                <i class="fa fa-inbox"></i> Recibidos
                                <span class="badge pull-right"></span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;" etiqueta="2" etiquetades="Enviados">
                                <i class="fa fa-envelope-o"></i> Enviados
                                <span class="badge pull-right"></span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;" etiqueta="3" etiquetades="Borradores">
                                <i class="fa fa-file-text-o"></i> Borradores
                                <span class="badge pull-right">3</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;" etiqueta="4" etiquetades="Papelera">
                                <i class="fa fa-trash-o"></i> Papelera
                                <span class="badge pull-right"></span>
                            </a>
                        </li>
                    </ul>

                    <div class="space-25"></div>

                    <div class="head-division">
                        <button id="btnEliminarCarpeta" class="btn btn-white btn-sm " data-toggle="tooltip" data-placement="bottom" title="Eliminar carpeta">
                            <i class="fa fa-minus"></i>
                        </button>
                        <button id="btnAgregarCarpeta" class="btn btn-white btn-sm " data-toggle="tooltip" data-placement="bottom" title="Crear carpeta">
                            <i class="fa fa-plus"></i>
                        </button>
                        <h5>Carpetas</h5>
                    </div>

                    <div id="jqxTreeEtiquetas"></div>


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
                        <button class="btn btn-primary btn-sm visible-xs pull-left" data-toggle="offcanvas" id="btnCanvas">
                            <i class="fa fa-bars"></i>
                        </button>
                        <h2 style="margin-top: 6px; margin-bottom: 4px;">
                            Recibidos </h2>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <!--<form method="get" action="index.html" style="margin-bottom: 4px;">  onkeyup="buscarMensaje($('#txtEtiquetaid').val(), this.value);" -->
                        <div class="input-group">
                            <input type="text" class="form-control input-sm" id="txtsearch" placeholder="Buscar mensaje">
                            <div class="input-group-btn">
                                <button id="btnBuscarMensaje" type="button" class="btn btn-sm btn-primary">Buscar</button>
                            </div>
                        </div>
                        <!--</form>-->
                    </div>


                    <div class="col-md-12 col-sm-12 col-xs-12">



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


                        <button id="btnActualizarBandeja" class="btn btn-default btn-sm tooltip-hover" data-original-title="Actualizar">
                            <i class="fa fa-refresh"></i>
                        </button>
                        <button class="btn btn-default btn-sm tooltip-hover" data-original-title="">
                            <i class="fa fa-eye"></i>
                        </button>
                        <button id="btnEliminarMensaje" class="btn btn-default btn-sm tooltip-hover" data-original-title="Mover a la papelera">
                            <i class="fa fa-trash-o"></i>
                        </button>
                        <button id="btnMoverMensaje" class="btn btn-default btn-sm tooltip-hover" data-original-title="Mover a ...">
                            <i class="fa fa-folder-open"></i>
                        </button>
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
                    Nada para leer.
                    <br /> Seleccione algún mensaje del listado anterior. </div>
            </div>
        </div>
    </div>

    <div id="contenedor-adicional" class="col-md-10 col-sm-8">

    </div>







</div>