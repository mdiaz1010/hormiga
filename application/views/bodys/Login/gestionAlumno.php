<?php if($bodyData->respuesta>0){ ?>
<div class="row">

              <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel">
              <div class="x_title">
              <div id="horarios">
              <center> <i id="horarios-load" class="fa fa-circle-o-notch fa-spin" style="font-size:24px;color:#ec7063"></i></center>
              </div>
              </div>
              </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-graduation-cap"></i> Orden de merito</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                  <div class="clearfix"></div>
                  </div>
                        <div id="puestos">
                        <center> <i id="puestos-load" class="fa fa-circle-o-notch fa-spin" style="font-size:24px;color:#ec7063"></i></center>
                        </div>
                </div>
              </div>     
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                      <h2><i class="fa fa-line-chart"></i> Rendimiento academico</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                    <div id="rendimiento">
                    <center> <i id="rendimiento-load" class="fa fa-circle-o-notch fa-spin" style="font-size:24px;color:#ec7063"></i></center>

                    </div>
                </div>
              </div>      
     <div class="clearfix"></div>
                 
    
 </div>
<script>
    $.post( 'horario',function (data){                
    $("#horarios").html(data);
     } );
     $.post( 'puestos',function (data){                
    $("#puestos").html(data);
     } );
     $.post( 'rendimiento',function (data){                
    $("#rendimiento").html(data);
     } );          
</script>
<?php }else{
echo "No cuenta con la información necesaria para mostrar esta interfaz.";    
}
?>