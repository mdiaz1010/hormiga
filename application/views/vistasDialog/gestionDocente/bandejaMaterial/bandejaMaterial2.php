<?php
if (count($bodyData->results)==0) {
    echo "<div class='alert_result'>No se encuentro ningun material registrado.</div>";
} else {
    ?>
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
                        <a href="javascript:" data-id="<?=$result['id']?>" data-bimestre="<?=$bodyData->arrayBusqueda['id_bimestre']?>" data-curso="<?=$bodyData->arrayBusqueda['id_curso']?>"
                            data-seccion="<?=$bodyData->arrayBusqueda['id_seccion']?>" data-grado="<?=$bodyData->arrayBusqueda['id_grado']?>"
                            class="editarMaterial" class="img-responsive center-block">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <a href="javascript:" data-id="<?=$result['id']?>" data-bimestre="<?=$bodyData->arrayBusqueda['id_bimestre']?>" data-curso="<?=$bodyData->arrayBusqueda['id_curso']?>"
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
<?php
}

?>
<div id="DIVELIMINARMATERIAL" title="INTRANET EDUCATIVA :: ELIMINAR MATERIAL"></div>
<div id="DIVEDITARMATERIAL" title="INTRANET EDUCATIVA :: EDITAR MATERIAL"></div>
<div id="DIVcargando" title="EN PROCESO">

    <center>
        <strong>Esperes estamos cargando la informacion...</strong>
        <span class="fa fa-spinner fa-pulse fa-2x fa-fw"></span>
    </center>
</div>
<script type="text/javascript">
    $('#DIVcargando').dialog({
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
    $('#DIVcargando').dialog({
        draggable: false
    });
    $('#DIVcargando').dialog({
        resizable: false
    });

    $("#DIVEDITARMATERIAL").dialog({
        autoOpen: false,
        hide: "drop",
        width: 340,
        height: 200,
        closeOnEscape: false,
        open: function (event, ui) {
            $(this).closest(".ui-dialog").find(".ui-dialog-titlebar-close").hide();
        },
        modal: true,
        buttons: {
            "SI": function () {
                var ide = $("#codigo").val();
                var seccion = $("#txtseccion").val();
                var grado = $("#txtgrado").val();
                var curso = $("#txtcurso").val();
                var bimestre = $("#txtbimestre").val();
                $.ajax({
                    type: 'POST',
                    url: "editarMateriales",
                    data: $("#editarMaterial").serialize(),
                    beforeSend: function () {
                        $("#DIVcargando").dialog("open");

                    },
                    success: function () {
                        $("#DIVcargando").dialog("close");
                        $("#bandejaMaterial2").load(
                            "<?= site_url('GestionDocente/verbandejaprof') ?>", {
                                grado:grado,
                                bimestre: bimestre,
                                curso: curso,
                                seccion: seccion
                            });
                    }
                });

                $(this).dialog("close");
            },

            "NO": function () {
                $(this).dialog("close"); //Se cancela operación

            }
        }
    });

    $("#DIVEDITARMATERIAL").dialog({
        draggable: false
    });
    $("#DIVEDITARMATERIAL").dialog({
        resizable: false
    });

    $("#DIVELIMINARMATERIAL").dialog({
        autoOpen: false,
        hide: "drop",
        width: 340,
        height: 130,
        closeOnEscape: false,
        open: function (event, ui) {
            $(this).closest(".ui-dialog").find(".ui-dialog-titlebar-close").hide();
        },
        modal: true,
        buttons: {
            "SI": function () {
                var ide = $("#codigo").val();
                var seccion = $("#txtseccion").val();
                var grado = $("#txtgrado").val();
                var curso = $("#txtcurso").val();
                var bimestre = $("#txtbimestre").val();
                var ruta = $("#txtruta").val();
                $.ajax({
                    type: 'POST',
                    url: "eliminarMateriales",
                    data: {
                        codigo: ide,
                        ruta: ruta
                    },
                    success: function () {
                        $("#DIVcargando").dialog("open");
                    },
                    success: function () {
                        $("#DIVcargando").dialog("close");
                        $("#bandejaMaterial2").load(
                            "<?= site_url('GestionDocente/verbandejaprof/') ?>", {
                                grado:grado,
                                bimestre: bimestre,
                                curso: curso,
                                seccion: seccion
                            });
                    }
                });

                $(this).dialog("close");
            },

            "NO": function () {
                $(this).dialog("close"); //Se cancela operación

            }
        }
    });

    $("#DIVELIMINARMATERIAL").dialog({
        draggable: false
    });
    $("#DIVELIMINARMATERIAL").dialog({
        resizable: false
    });

    $(".editarMaterial").click(function () {
        var id = $(this).data("id");
        var grado = $(this).data("grado");
        var curso = $(this).data("curso");
        var seccion = $(this).data("seccion");
        var bimestre = $(this).data("bimestre");
        $.ajax({
            type: 'POST',
            url: "editarMaterial",
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
                    $('#DIVEDITARMATERIAL').dialog('open');
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
            url: "eliminarMaterial",
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
                    $('#DIVELIMINARMATERIAL').dialog('open');
                }
                return false;
            }
        });
    });
</script>