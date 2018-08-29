<div class="col-md-12">
    <?php foreach ($bodyData->results as $result) {
        if (substr($result['nombre'], -4)=='docx') {
            $resultado=base_url("temp/word.png");
        } elseif (substr($result['nombre'], -4)=='xlsx') {
            $resultado=base_url("temp/excel.png");
        } elseif (substr($result['nombre'], -4)=='xlsx') {
            $resultado=base_url("temp/excel.png");
        } elseif (substr($result['nombre'], -3)=='xls') {
            $resultado=base_url("temp/excel.png");
        } elseif (substr($result['nombre'], -3)=='pdf') {
            $resultado=base_url("temp/pdf.png");
        } elseif (substr($result['nombre'], -4)=='pptx') {
            $resultado=base_url("temp/ppt.png");
        } elseif (substr($result['nombre'], -3)=='txt') {
            $resultado=base_url("temp/txt.png");
        } else {
            $resultado= base_url(trim($result['ruta']));
        } ?>


    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="thumbnail">
            <div class="image view view-first">
                <img style="width: 100%; display: block;" src="<?= $resultado; ?>" alt="image" id="imagen" />
                <div class="mask">
                    <p>
                        <?=$result['nom_archivo']?>
                    </p>
                    <div class="tools tools-bottom">
                        <a href="<?= base_url(trim($result['ruta']))?>" target="_blank" style=" outline: none;" class="fa fa-link"></a>
                        <a data-toggle="modal" data-target="#modal_editar" href="javascript:" data-id="<?=$result['id']?>" data-bimestre="<?=$bodyData->arrayBusqueda['id_bimestre']?>" data-curso="<?=$bodyData->arrayBusqueda['id_curso']?>"
                            data-seccion="<?=$bodyData->arrayBusqueda['id_seccion']?>" data-grado="<?=$bodyData->arrayBusqueda['id_grado']?>"
                            class="editarMaterial" class="img-responsive center-block">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <a data-toggle="modal" data-target="#modal_eliminar" href="javascript:" data-id="<?=$result['id']?>" data-bimestre="<?=$bodyData->arrayBusqueda['id_bimestre']?>" data-curso="<?=$bodyData->arrayBusqueda['id_curso']?>"
                            data-seccion="<?=$bodyData->arrayBusqueda['id_seccion']?>" data-grado="<?=$bodyData->arrayBusqueda['id_grado']?>"
                            class="eliminarMaterial" class="img-responsive center-block" data-ruta="<?=$result['ruta']?>">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="caption">
                <?=$result['nom_archivo'].'<br>'.$result['fec_modificacion']?>
            </div>
        </div>
    </div>


    <?php
    } ?>
</div>

<div class="modal" id="modal_editar" tabindex="-1" role="dialog" >
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Editar información</h4>
      </div>
      <div class="modal-body" id="DIVEDITARMATERIAL" title="INTRANET EDUCATIVA :: EDITAR ARCHIVOS ">

      </div>

      <div class="modal-footer">
        <button name="btnSi" id="btnSi" type="button" class="btn btn-default" data-dismiss="modal" >SI</button>
        <button name="btnNo" id="btnNo" type="button" class="btn btn-primary" data-dismiss="modal">NO</button>
      </div>

    </div>
  </div>
</div>

<div class="modal " id="modal_eliminar" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Eliminar material</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="DIVELIMINARMATERIAL">

      </div>
      <div class="modal-footer">
        <button type="button" id="btnEliminar" data-dismiss="modal" class="btn btn-primary">Si</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">cancelar</button>
      </div>
    </div>
  </div>
</div>

<div id="DIVcargando5" title="EN PROCESO">

    <center>
        <strong>Esperes estamos cargando la informacion...</strong>
        <span class="fa fa-spinner fa-pulse fa-2x fa-fw"></span>
    </center>
</div>
<input type="hidden" name="url" id="url" value="<?= base_url(); ?>">
<script type="text/javascript">

    $('#DIVcargando5').dialog({
        autoOpen: false,
        hide: 'drop',
        width: 360,
        height: 80,
        closeOnEscape: true,
        open: function (event, ui) {
            $(".ui-dialog-titlebar-close").hide();
        },
        modal: true
    });
    $('#DIVcargando5').dialog({
        draggable: false
    });
    $('#DIVcargando5').dialog({
        resizable: false
    });

    var url= $("#url").val();
          $("#btnSi").click(function(){

                var ide = $("#codigo").val();
                var seccion = $("#txtseccion").val();
                var grado = $("#txtgrado").val();
                var curso = $("#txtcurso").val();
                var bimestre = $("#txtbimestre").val();
                $.ajax({
                    type: 'POST',
                    url: url+"GestionDocente/editarMateriales",
                    data: $("#editarMaterial").serialize(),
                    beforeSend: function () {
                        $("#DIVcargando5").dialog("open");

                    },
                    success: function (data) {
                        $("#DIVcargando5").dialog("close");
                        if(data=='0'){
                                    $.notify("No se han hecho modificaciones debido a que no se permite campos vacíos", {
                                        position: 'b l',
                                        className:'warn',
                                        autoHideDelay: 10 * 1000,
                                        clickToHide: true
                                    });
                            return true;
                        }



                                    $.notify("Se editó la información satisfactoriamente.", {
                                        position: 'b l',
                                        className:'success',
                                        autoHideDelay: 10 * 1000,
                                        clickToHide: true
                                    });
                        $("#bandejaMaterial2").load("<?= site_url('GestionDocente/verbandejaprof') ?>", {
                                grado:grado,
                                bimestre: bimestre,
                                curso: curso,
                                seccion: seccion
                            });
                    }
                });

            });


    $("#btnEliminar").click(function(){



                    var ide = $("#codigo").val();
                    var seccion = $("#txtseccion").val();
                    var grado = $("#txtgrado").val();
                    var curso = $("#txtcurso").val();
                    var bimestre = $("#txtbimestre").val();
                    var ruta = $("#txtruta").val();
                    $.ajax({
                        type: 'POST',
                        url: url+"GestionDocente/eliminarMateriales",
                        data: {
                            codigo: ide,
                            ruta: ruta
                        },
                        success: function () {
                            $("#DIVcargando5").dialog("open");
                        },
                        success: function () {
                            $("#DIVcargando5").dialog("close");

                                    $.notify("Se eliminó el material satisfactoriamente.", {
                                        position: 'b l',
                                        className:'success',
                                        autoHideDelay: 10 * 1000,
                                        clickToHide: true
                                    });
                            $("#bandejaMaterial2").load(
                                "<?= site_url('GestionDocente/verbandejaprof/') ?>", {
                                    grado:grado,
                                    bimestre: bimestre,
                                    curso: curso,
                                    seccion: seccion
                                });
                        }
                    });


    });
    $(".editarMaterial").click(function () {

        var id = $(this).data("id");
        var grado = $(this).data("grado");
        var curso = $(this).data("curso");
        var seccion = $(this).data("seccion");
        var bimestre = $(this).data("bimestre");
        $.ajax({
            type: 'POST',
            url: url+"GestionDocente/editarMaterial",
            data: {
                id: id,
                curso: curso,
                grado: grado,
                seccion: seccion,
                bimestre: bimestre
            },
            success: function (datos) {
                if (datos.length > 0) {
                    $('#DIVEDITARMATERIAL').html(datos);

                }
                return false;
            }
        });
    });
    $(".eliminarMaterial").click(function () {
        var id = $(this).data("id");
        var grado = $(this).data("grado");
        var curso = $(this).data("curso");
        var seccion = $(this).data("seccion");
        var bimestre = $(this).data("bimestre");
        var ruta = $(this).data("ruta");
        $.ajax({
            type: 'POST',
            url: url+"GestionDocente/eliminarMaterial",
            data: {
                id: id,
                curso: curso,
                grado: grado,
                seccion: seccion,
                bimestre: bimestre,
                ruta: ruta
            },
            success: function (datos) {
                if (datos.length > 0) {
                    $('#DIVELIMINARMATERIAL').html(datos);

                }
                return false;
            }
        });
    });
</script>