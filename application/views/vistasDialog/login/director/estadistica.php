<?php
     
    $semana= array("","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado","Domingo");
    $graficoArrayFecha = "";
    $graficoArrayLabels ="";
    $graficoArrayValores ="";
    $graficoArrayColores ="";
    $totalRegistros =0;
    $listaYColor = array();
    foreach ($bodyData->notas as  $value) {
        $graficoArrayLabels .= "'".$value['nombre']."',";
        $graficoArrayValores.= "'".$value['nota']."',";
        $color = '#'.substr(md5(rand(20, 100)), 0, 6);
        $graficoArrayColores .= "'".$color."',"; 
     ?>
<input type="hidden" name="nombre[]"  id="nombre"  value="<?=$value['nombre']?>">
<input type="hidden" name="nota[]"    id="nota"    value="<?=$value['nota']?>">
<input type="hidden" name="rango[]"   id="rango"   value="<?=$value['rango']?>">
    <?php
        $totalRegistros = $bodyData->usuariosTotales[0]->cantidad;
        $listaYColor[] =(object) array('nombre'=>$value['nombre'], 'color'=>$color,'valor'=>$value['nota']);
    }    
    $graficoArrayLabels = trim($graficoArrayLabels,",");
    $graficoArrayValores = trim($graficoArrayValores,",");
    $graficoArrayColores = trim($graficoArrayColores,",");
     
     //   echo password_hash("algo", PASSWORD_DEFAULT)."\n   ".PASSWORD_DEFAULT ;
    
    $graficoArrayFecha ;
    
    try{
    //    $fecha = new DateTime($graficoArrayFecha);
    } catch (Exception $e) {
         
    }

    // echo $fecha->format('Y-m-d');
    ?>
<div class="row">
                        <div class="col-md-6 ">
                            <span id="trafico_terminales_dia">Dia: <?=  date('d')  ?></span>
                            <i class="fa fa-check"></i>                   
                        </div> 
                        <div class="col-md-6  ">
                            <span id="trafico_terminales_fecha">Fecha: <?=date('Y-m-d')?> </span>
                            <i class="glyphicon glyphicon-calendar"></i>                   
                        </div> 
                    </div>
                    <div class="col-md-8">
                        <div class="x_content" >
                            <canvas  id="polarArea" style="    height: 350px;"></canvas>
                        </div>
                    </div> 

                    <div class="col-md-4">
                        <div class="list-group">

                            <div class="list-group-item">
                                <span class="badge"><?= $totalRegistros ?></span>
                                <i class="fa fa-check"></i> 
                                <a class="no_color_link">Cantidad de alumno</a>                  
                            </div> 


                        
                        </div>  
                    </div> 
                    
                    <div class="col-xs-12">
                        <div class="row">
                            <table class="table table-bordered table-hover table-striped tablesorter">                        
                        <?php
                            foreach ($listaYColor as $listaYColorTemp) {
                                ?>
                                <tr>    
                                    <td  class="col-xs-11">
                                    <div  class="col-xs-2"  style="background: <?=$listaYColorTemp->color?>;padding: 5px;">
                                    </div>
                                    <?=$listaYColorTemp->nombre?></td>
                                    <td class="col-xs-1"><?=$listaYColorTemp->valor?></td>
                                <tr>                            
                                <?php
                            }
                        ?>
                            </table>
                        </div>                                      
                    </div>
<script>
    Chart.defaults.global.legend = {
        enabled: false
    };
    // PolarArea chart
      var ctx = document.getElementById("polarArea");
      var data = {
        datasets: [{
          data: [<?=$graficoArrayValores ?>],
          backgroundColor: [<?=$graficoArrayColores?> ],
          label: 'Registros de Asistencia'
        }],
        labels: [<?=$graficoArrayLabels?>]
      };

      var polarArea = new Chart(ctx, {
        data: data,
        type: 'doughnut',
        options: {
          scale: {
            ticks: {
              beginAtZero: true
            }
          }
        }
      });
</script>