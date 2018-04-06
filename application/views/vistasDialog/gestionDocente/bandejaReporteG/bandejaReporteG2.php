<div class="col-xs-12">
<div class="col-xs-6">
    <div class="row">  
    <div class="panel panel-primary">
        <div class="panel-heading">
                            <h1 class="panel-title">
                               TURNO MAÑANA
                            </h1>
        </div>        
        <div class="panel-body">   <div class="table-responsive">                           
            <table class="table table-bordered table-hover table-striped tablesorter">
                <thead>
                    <tr>
                        <th><small><center>Horas</center></small></th>
            <?php foreach ($bodyData->dias as $dias): ?>
            <th><small><?=$dias->dias?></small></th>
            <?php endforeach;?>
                    </tr>
                </thead>
                <tbody>
            <?php $i=1;  foreach($bodyData->horas as $horas):?>
                <?php  if($horas->turnos=='mañana'){?>
                    <tr>
                        <td><small><center><?=$horas->horarios?></center></small></td>
                        <?php $j=1;  foreach($bodyData->dias as $dias):
                        if(isset($bodyData->results[$i][$j])==false){
                           $valor[$i][$j]='';
                           $color='';
                           $curso='';
                        }else{
                           $valor[$i][$j]=$bodyData->results[$i][$j]['materia'];
                           $color=$bodyData->color[$bodyData->results[$i][$j]['materia']];
                           $curso=$bodyData->curso[$bodyData->results[$i][$j]['materia']];
                        }
                        ?>
                        <td title="<?=$curso;?>" bgcolor="<?=$color?>"><small><font style="font-style: italic;" COLOR="#fdfefe"><?=$valor[$i][$j];?></font></small></td>
                        <?php $j++; endforeach;?>
                    </tr>
                <?php }?>
            <?php $i++; endforeach;?>
                </tbody>
            </table>
            </div>
        </div>
   </div>                           
   </div>
</div>

<div class="col-xs-6">
    <div class="row">  
    <div class="panel panel-primary">
        <div class="panel-heading">
                            <h1 class="panel-title">
                               TURNO TARDE
                            </h1>
        </div>                
        <div class="panel-body">         
             <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped tablesorter" >
                <thead>
                    <tr>
                        <th><small><center>Horas</center></small></th>    
            <?php foreach ($bodyData->dias as $dias): ?>
                    <th><small><?=$dias->dias?></small></th>   
            <?php endforeach;?>
                    </tr>
                </thead>    
                <tbody>
            <?php $i=1;  foreach($bodyData->horas as $horas):?>
                <?php  if($horas->turnos=='tarde'){?>
                    <tr>
                        <td><center><small><?=$horas->horarios?></small></center></td>
                        <?php $j=1;  foreach($bodyData->dias as $dias):
                        if(isset($bodyData->results[$i][$j])==false){
                           $valor[$i][$j]='';
                           $color="";
                           $curso='';
                        }else{
                           $valor[$i][$j]=$bodyData->results[$i][$j]['materia'];
                           $color=$bodyData->color[$bodyData->results[$i][$j]['materia']];
                           $curso=$bodyData->curso[$bodyData->results[$i][$j]['materia']];
                        }
                        ?>
            <td title="<?=$curso;?>" bgcolor="<?=$color;?>"><small><font style="font-style: italic;" COLOR="#fdfefe"><?=$valor[$i][$j];?></font></small></td>
                        <?php $j++; endforeach;?>
                    </tr>
                <?php }?>
            <?php $i++; endforeach;?>

                </tbody>                
            </table>  
             </div>
        </div>
   </div>                           
   </div>
</div>   
</div>