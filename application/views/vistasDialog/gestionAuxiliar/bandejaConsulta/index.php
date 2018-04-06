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
                      <?php foreach ($bodyData->datos as $dato):?>
                      <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                        <div class="well profile_view">
                          <div class="col-sm-12">
                            <h4 class="brief"><i><?=$dato->usuari?></i></h4>
                            <div class="left col-xs-7">
                              <h4><?=$dato->apepat.' '.$dato->apemat.' '.$dato->nombre?></h4>
                              <ul class="list-unstyled">                                
                                  <li><i class="fa fa-phone"></i> Telefono #: <small><?= $dato->telefo?></small></li>  
                              </ul>
                            </div>
                            <div class="right col-xs-5 text-center">
                                    <?php if(isset($dato->RUTA)==false){?>
                                  <img src=" <?= base_url('publico/media/user.png')?>" alt="..." class="img-circle profile_img">
                                    <?php }else{?>
                                  <img src="<?= base_url($dato->RUTA)?>" alt="..." class="img-circle  profile_img">  
                                    <?php } ?>
                            </div>
                          </div>
                          <div class="col-xs-12 bottom text-center">
                            <div class="col-xs-12 col-sm-6 emphasis">
                            </div>
                            <div class="col-xs-12 col-sm-6 emphasis">
                              <button type="button" class="btn btn-primary btn-xs busqueda" data-nombre1="<?=$dato->apepat.' '.$dato->apemat.' '.$dato->nombre?>">
                                <i class="fa fa-user "> </i> Consultar
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
       
          </div>    </div>

<script type="text/javascript">
    
    $(".busqueda").click(function(){
        var nombre= $(this).data("nombre1");
        
        $.ajax({
            type: 'POST',
            url:  '<?=base_url('GestionEducativa/buscarUser') ?>',
            data: {nombre:nombre},
            beforeSend: function (data) {
            $("#bandejaAuxiliar").html('<center><h3>Cargando la informacion...</h3><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></center>');
                    },
            success: function (data) {
            $("#bandejaAuxiliar").html(data);
                    return false;
                    }
        });
        
    });
 	var profesores = [];
        
 		$("input[name='profesores[]']").each(function() {			
			var value = $(this).val();		    		   
		    	profesores.push(value);
		});            
                
    $( "#buscarUsuario" ).autocomplete({source:profesores,minLength: 5});
</script>