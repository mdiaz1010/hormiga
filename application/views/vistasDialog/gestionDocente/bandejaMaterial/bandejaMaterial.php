<script type="text/javascript" src="<?= base_url('publico/js/bootstrap-filestyle.min.js')?>">
</script>
<div class="container" id="materialDocentesubir" style="display:none;">
    <div class="list-group right">
        <a class="btn btn-danger btnArchivo"  data-toggle="modal" data-target=".bs-example-modal-lg" href="javascript:" data-grado="<?php echo $bodyData->GRADO?>" data-seccion="<?php echo $bodyData->SECCION?>"
            data-curso="<?php echo $bodyData->CURSOS?>" data-bimestre="<?php echo $bodyData->BIMESTRE?>" aria-label="Archivo"
            style="clear: right;">
            <i class="fa fa-pencil" aria-hidden="true" style="clear: right;"></i>
        </a>
    </div>
    <div id="bandejaMaterial2"></div>
</div>

<div id="DIVcarga" title="EN PROCESO">
    <center>
        <strong>Espere estamos cargando la informacion...</strong>
        <span class="fa fa-spinner fa-pulse fa-2x fa-fw"></span>
    </center>
</div>


<div class="modal fade bs-example-modal-lg" id="subar" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Subir archivo</h4>
      </div>
      <div class="modal-body" id="DIVSUBIDA" title="INTRANET EDUCATIVA :: SUBIR ARCHIVOS ">

      </div>
      <div class="modal-footer">
        <button type="button" name="btncargar" id="btncargar"  class="btn btn-primary">Cargar archivo</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>
<script type="text/javascript">

$("#btncargar").click(function(){

                var DocAdj = $("#docAdj").val();
                if (DocAdj.length > 0) {
                    var inputimage = document.getElementById('docAdj'),

                        formdata = new FormData();
                    var i = 0,
                        len = inputimage.files.length,
                        img, reader, file;
                    document.getElementById('response').innerHTML = 'Subiendo...';
                    for (; i < len; i++) {
                        file = inputimage.files[i];
                        if (formdata)
                            formdata.append('images[]', file);
                    }
                    var seccion = $("#txtseccion").val();
                    var grado = $("#txtgrado").val();
                    var curso = $("#txtcurso").val();
                    var bimestre = $("#txtbimestre").val();
                    var descripcion =  $("#editor").val();;
                    var txtarchivo = $("#txtarchivo").val();
                    if(txtarchivo==''){
                        $("#mensaje").html('<div class="alert alert-danger" role="alert">Ingresar un Nombre* al archivo</div>');
                        return true;
                    }

                    formdata.append('txtseccion', seccion);
                    formdata.append('txtgrado', grado);
                    formdata.append('txtcurso', curso);
                    formdata.append('txtbimestre', bimestre);
                    formdata.append('txtdescripcion', descripcion);
                    formdata.append('txtarchivo', txtarchivo);
                    $.ajax({
                        type: 'POST',
                        url: url+"GestionDocente/registrarArchivoProf",
                        data: formdata,
                        processData: false,
                        contentType: false,
                        beforeSend: function (dato) {
                            $("#DIVcarga").dialog("open");
                        },
                        success: function (dato) {

                            $("#DIVcarga").dialog("close");
                            if(dato=="n"){
                                alert("El archivo que intenta subir no es permitido, por favor verificar el tipo de extensión. Extensiones permitidas: ('pdf','docx','png','jpg','jpeg','pptx','txt')");
                                return true;
                            }else if (dato=="x"){
                                alert("El archivo que intenta subir supera el peso permitido, por favor verificar que el peso del archivo sea menor o igual a 1MB");
                                return true;
                            }
                             $('#subar').modal('toggle');
                            $("#bandejaMaterial2").load(
                                "<?= base_url('GestionDocente/verbandejaprof') ?>", {
                                    curso: curso,
                                    grado: grado,
                                    seccion: seccion,
                                    bimestre: bimestre
                                });

                        }
                    });
                }else{
                    $("#mensaje").html('<div class="alert alert-danger" role="alert">Adjuntar el documento a compartir</div>');
                }

});
    $('#DIVcarga').dialog({
        autoOpen: false,
        hide: 'drop',
        width: 360,
        height: 80,
        closeOnEscape: false,
        open: function (event, ui) {
            $(".ui-dialog-titlebar-close").hide();
        },
        modal: true
    });
    $('#DIVcarga').dialog({
        draggable: false
    });
    $('#DIVcarga').dialog({
        resizable: false
    });



    $(".btnArchivo").click(function () {
        var curso = $(this).data("curso");
        var grado = $(this).data("grado");
        var seccion = $(this).data("seccion");
        var bimestre = $(this).data("bimestre");
        $.ajax({
            type: 'POST',
            url: url+"GestionDocente/subirArchivoProf",
            data: {
                curso: curso,
                grado: grado,
                seccion: seccion,
                bimestre: bimestre
            },
            beforeSend: function () {
                $("#DIVcarga").dialog("open");
            },
            success: function (datos) {
                $("#DIVcarga").dialog("close");
                if (datos.length > 0) {
                    $('#DIVSUBIDA').html(datos);
                }
                return false;
            }
        });
    });
    $(":file").filestyle({
        buttonName: "btn-primary"
    });
</script>
<style>
    .right {
        float: right;

    }

    .left {
        float: left;

    }

    #centrador {
        text-align: center;
        width: 160px;
        height: 280px;

    }

    #imagen {
        width: 100px;
    }
</style>