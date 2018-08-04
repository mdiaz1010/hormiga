<div class="clearfix"></div>
<div class="row">
  <div class="col-md-12">
    <div class="x_panel">
      <div class="x_content">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12 text-center">
            <ul class="pagination pagination-split">

            </ul>
          </div>

          <div class="clearfix"></div>


          <?php $i=0; foreach ($bodyData->datos as $dato):?>
          <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
            <div class="well profile_view">
              <div class="col-sm-12">
                <h4 class="brief">
                  <i>
                    <?=$dato->usuari?>
                  </i>
                </h4>
                <div class="left col-xs-7">
                  <h4>
                    <?=$dato->apepat?>
                  </h4>
                  <ul class="list-unstyled">
                    <li>
                      <i class="fa fa-phone"></i> Telefono #:
                      <?= $dato->telefo?>
                    </li>
                  </ul>
                </div>
                <div class="right col-xs-5 text-center">
                  <?php if (isset($dato->RUTA)==false) {
    ?>
                  <img src=" <?= base_url('publico/media/user.png')?>" alt="..." class="img-circle profile_img">
                  <?php
} else {
        ?>
                    <img src="<?= base_url($dato->RUTA)?>" alt="..." class="img-circle  profile_img">
                    <?php
    } ?>
                </div>
              </div>
              <div class="col-xs-12 bottom text-center" id="consultar_dir<?= $i++;?>">
                <div class="col-xs-12 col-sm-6 emphasis">
                </div>
                <div class="col-xs-12 col-sm-6 emphasis">
                  <button type="button" data-boolean="<?=$bodyData->boolean?>" class="btn btn-primary btn-xs busqueda" data-nombre="<?=$dato->apepat.' '.$dato->apemat.' '.$dato->nombre?>">
                    <i class="fa fa-user "> </i> Consultar
                  </button>
                </div>
              </div>
            </div>
          </div>
          <input type="hidden" name="booleano[]" id="booleano" value="<?=$bodyData->boolean?>">
          <?php endforeach; ?>



        </div>
      </div>
    </div>

  </div>

</div>
</div>
<div id="DIVcargas_general" title="EN PROCESO">
    <center>
        <strong>Espere estamos cargando la informacion...</strong>
        <span class="fa fa-spinner fa-pulse fa-2x fa-fw"></span>
    </center>
</div>
<script type="text/javascript" src="<?= base_url('publico/js_vistas/js/cargar_data.js')?>"></script>
<script type="text/javascript">
  var i = 0;
  $('input[name="booleano[]"]').map(function () {
    if (this.value == "true") {
      $("#consultar_dir" + i).hide();
    }
    i++;

  }).get();
  $(".busqueda").click(function () {
    var nombre = $(this).data("nombre");

    if ($(this).data("boolean") == false) {
      $.ajax({
        type: 'POST',
        url: url+'GestionEducativa/buscarUser',
        data: {
          nombre: nombre
        },
        beforeSend: function (data) {
          $('#DIVcargas_general').dialog('open');
        },
        success: function (data) {
          $('#DIVcargas_general').dialog('close');
          $("#bandejaprincipal").html(data);
          return false;
        }
      });
    } else {
      alert("No existe información disponible para estos usuarios");
    }
  });
  var profesores = [];

  $("input[name='profesores[]']").each(function () {
    var value = $(this).val();
    profesores.push(value);
  });

  $("#buscarUsuario").autocomplete({
    source: profesores,
    minLength: 5
  });
</script>