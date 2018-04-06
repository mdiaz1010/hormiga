

<!-- page content -->
<div class="row">

</div>
    

    
    <div class="row">
    
 <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title  ">
                    <h2 class=" "><i class="fa fa-bar-chart-o"></i> Estadística Notas: </h2> 
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>                      
                   

            
                <div id="estadistica" class="x_content">
                    <center> <i id="estadistica-load" class="fa fa-circle-o-notch fa-spin" style="font-size:24px;color:#ec7063"></i></center>

                </div>
            
        </div>
    
 </div>
        
        
<div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                      <h2><i class="fa fa-graduation-cap" ></i> Orden de merito</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <div id="merito" class="table-responsive">     
                 <center><strong><p style="color:#ec7063">Procesando la informacion </p></strong> <i id="merito-load" class="fa fa-circle-o-notch fa-spin" style="font-size:24px;color:#ec7063"></i></center>
                  </div>    
                  </div>
                </div>
              </div>         
<div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                      <h2><i class="fa fa-list-ul"></i> Leyenda</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <div class="table-responsive">    
                        <table  class="table table-bordered table-hover table-striped tablesorter">
                                           <tr>    
                                               <small><font style="font-style: italic;"><td>Satisfactorio</td><td>18,19,20</td></font></small>
                                           </tr>
                                           <tr>
                                               <small><font style="font-style: italic;"><td>Proceso   </td><td>14,15,16,17</td></font></small>
                                           </tr>
                                           <tr>
                                               <small><font style="font-style: italic;"><td>Inicio</td><td>11,12,13</td></font></small>
                                           </tr>
                                           <tr>
                                               <small><font style="font-style: italic;"><td>Previo Inicio</td><td>0 a 10</td></font></small>
                                           </tr>
                        </table>                                            
                  </div>    
                  </div>
                </div>
              </div>         
        
        
    </div>
    

    

<!-- /page content -->
<script src="<?= base_url('publico/js/highcharts.js') ?>"></script> 
<script src="<?= base_url('publico/html_libs/Chart.js/dist/Chart.min.js') ?>"></script>
<script type="text/javascript">

    $.post( 'estadistica',function (data){                
    $("#estadistica").html(data);
     } );
    $.post( 'merito',function (data){                
    $("#merito").html(data);
     } );       
</script>