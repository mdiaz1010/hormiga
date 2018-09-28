
<div class="row"></div>
<div class="clearfix"></div>
<div class="row">
  <div class="col-md-12">
    <div class="x_panel">
      <div class="x_content">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12 ">
            <div class="title_left">
              <h3><b></b></h3>
            </div>
            <ul class="pagination pagination-split">

            </ul>
          </div>

          <div class="clearfix" style="text-align: center;"></div>


                    <?php foreach ($bodyData->list_hijos as $key => $value):?>
          <div class=" col-md-4 col-sm-4 col-xs-12 profile_details">
            <div class="well profile_view">
              <div class="col-sm-12">
                <h4 class="brief">
                  <i>

                  </i>
                </h4>
                <div class="left col-xs-7">
                  <h4>
                    <?=$value['ape_pat_per']?>
                  </h4>
                </div>
                <div class="right col-xs-5 text-center">
                                                            <?php if (isset($value['ruta'])==false) {?>
                                                            <img src=" <?= base_url('publico/media/user.png')?>" alt="profile" class="img-circle">
                                                            <?php } else { ?>
                                                            <img src="<?= base_url($value['ruta'])?>" alt="profile" class="img-circle">
                                                            <?php } ?>
                </div>
              </div>
              <div class="col-xs-12 bottom text-center" id="">
                <div class="col-xs-12 col-sm-6 emphasis">
                </div>
                <div class="col-xs-12 col-sm-6 emphasis">
                  <button type="button" data-boolean="" class="btn btn-primary btn-xs busqueda" data-usu="<?=$value['codigo']?>" >
                    <i class="fa fa-user "> </i> Consultar información
                  </button>
                </div>
              </div>
            </div>
          </div>

          <?php endforeach; ?>



        </div>
      </div>
    </div>

  </div>

</div>
    <div class="col-xs-12 col-md-12 col-sm-12 animated fadeInRight">

        <div class="" id="bandejaprincipal"></div>


    </div>
</div>
<div id="DIVcargas_general" title="EN PROCESO">
  <center>
    <strong>Espere estamos cargando la informacion...</strong>
    <span class="fa fa-spinner fa-pulse fa-2x fa-fw"></span>
  </center>
</div>
<input type="hidden" name="url" id="url" value="<?=base_url();?>">
<script type="text/javascript" src="<?= base_url('publico/js_vistas/js/cargar_data.js')?>"></script>
<script type="text/javascript">

  $(".busqueda").click(function () {
    var nombre = $(this).data("usu");
    var pass = $(this).data("clav");
    var url= $("#url").val();

      $.ajax({
        type: 'POST',
        url: url + 'GestionPadre/buscarUser',
        data: {
          user: nombre,
          pass: pass
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

  });

</script>

 <style>
.padre {

  height: 150px;
  /*IMPORTANTE*/
  display: flex;
  justify-content: center;
  align-items: center;
}
 </style>








<!--

En construcción...
-->