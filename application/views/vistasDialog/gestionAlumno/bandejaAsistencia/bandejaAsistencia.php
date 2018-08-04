
<link rel="stylesheet" href="<?=base_url('publico/kartik-file/css/fileinput.min.css')?>" />
<script src="<?=base_url('publico/kartik-file/js/fileinput.min.js')?>"></script>
<form action="/editarAsistenciasAl" method="post" name="registrarArchivo" id="registrarArchivo" enctype="multipart/form-data">

    <input type="hidden" id='txtid' class="form-control" name="txtid" value="<?= trim($bodyData->codigo)?>" readonly>
    <input type="hidden" id='txtfec' class="form-control" name="txtfec" value="<?= trim($bodyData->fecha)?>" readonly>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Mensaje<span class="required">*</span></label>
    <textarea class="form-control" id="mensaje" rows="3"><?=(ltrim($bodyData->mensaje))?></textarea>
  </div>

    <div class="col-sm-12">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Adjuntar documento:
            <span class="required">*</span>
        </label><hr>
                        <input type="file" name="docAdj[]" id="docAdj" class=" file col-md-12 col-sm-12 col-xs-12" data-edit="insertImage">


    </div>


    <span id="response"></span>



</form>


<?php
if (count($bodyData->results)==0 || $bodyData->results==0) {
    echo "<div class='alert_result'>No se encontro ningun material registrado.</div>";
} else {
    ?>

    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="first-name">Archivos adjuntos:
                    <span class="required">*</span>
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

        <div class="col-md-55">
            <div class="thumbnail">
                <div class="image view view-first">

                    <img id="imagen" src="<?= $resultado; ?>" class="img-responsive center-block" align="top" alt="Lights" style="width:100%" />
                    <div class="mask">
                        <p>Evidencia</p>
                        <div class="tools tools-bottom">
                            <a href="<?= base_url(trim($result->ruta))?>" target="_blank" style=" outline: none;">
                                <i class="fa fa-link"></i>
                            </a>
                            <a data-toggle="modal" data-target=".bs-example3-modal-lg"  href="#" data-id="<?=$result->id?>" data-ruta="<?=$result->ruta?>" data-fec="<?=$result->fecha_jus?>" class="eliminarMaterial">
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

<div class="modal fade bs-example3-modal-lg" id="modal_x" tabindex="-1"  aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Eliminar archivo</h4>
      </div>
      <div class="modal-body" id="DIVELIMINARMATERIAL1">

      </div>

      <div class="modal-footer">
        <button name="btn_si_eliminar" id="btn_si_eliminar" type="button" class="btn btn-default" data-dismiss="modal">SI</button>
        <button name="btnNo" id="btnNo" type="button" class="btn btn-primary" data-dismiss="modal">NO</button>
      </div>

    </div>
  </div>
</div>

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
            $("#btn_si_eliminar").click(function(){

                                var ide = $("#codigo").val();
                                var fecha = $("#fecha").val();
                                var ruta = $("#ruta").val();
                                $.ajax({
                                    type: 'POST',
                                    url: url+'GestionAlumno/eliminarMaterialesAs',
                                    data: {
                                        codigo: ide,
                                        ruta: ruta
                                    },
                                    success: function () {
                                        $("#DIVVERASISTENCIA").load("verAsistenciaAl", $.param({
                                            id: ide,
                                            fecha: fecha
                                        }));
                                        location.reload();
                                    }
                                });

            });

        $(".eliminarMaterial").click(function () {
            var id = $(this).data("id");
            var fec = $(this).data("fec");
            var ruta = $(this).data("ruta");
            $.ajax({
                type: 'POST',
                url: url+'GestionAlumno/eliminarMaterialAs',
                data: {
                    id: id,
                    fecha: fec,
                    ruta: ruta
                },
                success: function (datos) {
                    if (datos.length > 0) {
                        $('#DIVELIMINARMATERIAL1').html(datos);

                    }
                    return false;
                }
            });
        });
    </script>