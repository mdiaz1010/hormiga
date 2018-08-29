
<link rel="stylesheet" href="<?=base_url('publico/kartik-file/css/fileinput.min.css')?>" />
<script src="<?=base_url('publico/kartik-file/js/fileinput.min.js')?>"></script>
<form action="/editarAsistenciasAl" method="post" name="registrarArchivo" id="registrarArchivo" enctype="multipart/form-data">

    <input type="hidden" id='txtid' class="form-control" name="txtid" value="<?= trim($bodyData->codigo)?>" readonly>
    <input type="hidden" id='txtfec' class="form-control" name="txtfec" value="<?= trim($bodyData->fecha)?>" readonly>
  <div class="form-group">
    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="first-name">
    Mensaje<span class="required">*</span>
    <textarea class="form-control" id="mensaje" name="mensaje" rows="3"><?=(ltrim($bodyData->mensaje))?></textarea>
    </label>
  </div>

    <div class="form-group">
        <label class="control-label col-md-12 col-sm-12 col-xs-12" for="first-name">
            Adjuntar documento:
            <input type="file" name="docAdj[]" id="docAdj" class=" file " data-edit="insertImage">
        </label><hr>


    </div>


    <span id="response"></span>



</form>


<?php
if (count($bodyData->results)==0 || $bodyData->results==0) {
    echo "<div class='alert_result'>No se encontro ningun material registrado.</div>";
} else {
    ?>

    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="first-name">Archivos adjuntos:<div id="eliminar_mate" name="eliminar_mate"></div>
<br><br><br><br>

    </label>
    <div class="col-md-12">
        <?php foreach ($bodyData->results as $result) {
        if (substr($result->nombre, -4)=='docx') {
            $resultado=base_url("temp/word.png");
        } elseif (substr($result->nombre, -4)=='xlsx') {
            $resultado=base_url("temp/excel.png");
        } elseif (substr($result->nombre, -4)=='xlsx') {
            $resultado=base_url("temp/excel.png");
        } elseif (substr($result->nombre, -3)=='xls') {
            $resultado=base_url("temp/excel.png");
        } elseif (substr($result->nombre, -3)=='pdf') {
            $resultado=base_url("temp/pdf.png");
        } elseif (substr($result->nombre, -4)=='pptx') {
            $resultado=base_url("temp/ppt.png");
        } elseif (substr($result->nombre, -3)=='txt') {
            $resultado=base_url("temp/txt.png");
        } else {
            $resultado= base_url(trim($result->ruta));
        } ?>

        <div class="col-md-55" >
            <div class="thumbnail">

                <div class="image view view-first">

                    <img id="imagen" src="<?= $resultado; ?>" class="img-responsive center-block" align="top" alt="Lights" style="width:100%" />
                    <div class="mask">
                        <p>Evidencia</p>
                        <div class="tools tools-bottom">
                            <a href="<?= base_url(trim($result->ruta))?>" target="_blank" style=" outline: none;">
                                <i class="fa fa-link"></i>
                            </a>
                            <a class="eliminar_justificacion"  href="javascript:" data-id="<?=$result->id?>" data-ruta="<?=$result->ruta?>" data-fec="<?=$result->fecha_jus?>" >
                                <i class="fa fa-times"></i>
                            </a>

                        </div>
                    </div>
                </div>
                <div class="caption">
                    <p><?=$result->nombre.'<br>'.$result->fec_creacion?></p>
                </div>
            </div>



        </div>
        <?php
    } ?>
    </div>
    <?php
}
?>


    <style>
        .right {
            float: right;
        }

        .left {
            float: left;
        }

        #centrador {
            text-align: center;
            width: 150px;
            height: 280px;
        }

        #imagen {
            width: 100px;
        }
    </style>
    <script type="text/javascript">

$(".eliminar_justificacion").click(function(){
            var id = $(this).data("id");
            var fec = $(this).data("fec");
            var ruta = $(this).data("ruta");
        $.notify.addStyle('foo', {
        html:
            "<div>" +
            "<div class='clearfix'>" +
                "<div class='title' data-notify-html='title'/>" +
                "<div class='buttons'>" +
                "<button class='btn btn-danger no'>Cancelar</button>" +
                "<button class='btn btn-primary yes' data-id="+id+" data-fec="+fec+" data-ruta="+ruta+" data-notify-text='button'></button>" +
                "</div>" +
            "</div>" +
            "</div>"
        });
        $("#eliminar_mate").notify({
        title: '¿Eliminar el material seleccionado ?',
        button: 'Si'
        }, {
        style: 'foo',
        autoHide: false,
        clickToHide: false
        });
});


    jQuery.validator.setDefaults({
    debug: true,
    success: "valid"
    });
$("#registrarArchivo").validate({

        rules: {
            mensaje:{
            required: true,
            maxlength:220
            },
            docAdj:{
            required: true,
            extension: "jpg|png|jpeg"
            }
        },
        messages: {
            mensaje: {
            required: " Este campo es obligatorio",
            maxlength: "Solo puede ingresar un máximo de 220 caracteres."
            },
            docAdj :{
            required :"Este campo es obligatorio",
            extension: "El documento que intenta ingresar no , está dentro de las extensiones permitidas"
            }
        }

});
$(document).on('click', '.notifyjs-foo-base .no', function() {
  //programmatically trigger propogating hide event
  $(this).trigger('notify-hide');
});
$(document).on('click', '.notifyjs-foo-base .yes', function() {
            var id = $(this).data("id");
            var fec = $(this).data("fec");
            var ruta = $(this).data("ruta");

                                $.ajax({
                                    type: 'POST',
                                    url: url+'GestionAlumno/eliminarMaterialesAs',
                                    data: {
                                        codigo: id,
                                        ruta: ruta
                                    },
                                    success: function () {

                                        $.notify("Se eliminó su justificación satisfactoriamente", {
                                            position: 'b r',
                                            className: 'success',
                                            autoHideDelay: 10 * 1000,
                                            clickToHide: true
                                        });
                                        $('#subir_justificacion').modal('hide');
                                        $('body').removeClass('modal-open');
                                            $('.modal-backdrop').remove();
                                        var uri="<?=base_url('GestionAlumno/consultarAsistencia')?>";
                                        $("#main-content").load(uri);
                                            return true;
                                    }
                                });

});


    $(document).ready(function () {
        $('#subir_justificacion').on('hidden.bs.modal', function (e) {
            /*LIMPIAR DISPARADORES */
            $(this).find('button').unbind();
            $(this).find('.modal-body').html('<center><img src="<?= base_url('publico/media/ajax-loader2.gif')?>" width="80" height="80" ></center>');
            $(this).find('.modal-footer .nombre').html('');
        });
    });

    </script>
    <script>//tinymce.init({ selector:'textarea' });</script>

<style>
.notifyjs-foo-base {
  opacity: 0.85;
  width: 200px;
  background: #F5F5F5;
  padding: 5px;
  border-radius: 10px;
}

.notifyjs-foo-base .title {
  width: 100px;
  float: left;
  margin: 10px 0 0 10px;
  text-align: right;
}

.notifyjs-foo-base .buttons {
  width: 70px;
  float: right;
  font-size: 9px;
  padding: 5px;
  margin: 2px;
}

.notifyjs-foo-base button {
  font-size: 9px;
  padding: 5px;
  margin: 2px;
  width: 60px;
}
</style>