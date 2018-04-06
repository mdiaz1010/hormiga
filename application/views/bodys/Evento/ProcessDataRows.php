<?php

$tiempoCrearRow = Utilitario::Tiempo_microtime_float();
    
    
    function horarioOExcepcion($horarioExcepcion){
        $standar = new stdClass(); 
        if (!empty($horarioExcepcion->atndtz_id)){ 
            $standar->id = $horarioExcepcion->atndtz_id;
            $standar->nombre = $horarioExcepcion->atndtz_name." <label><i>(H)</i></label>";
            $standar->rt = $horarioExcepcion->atndtz_rt_period;
            $standar->bt = $horarioExcepcion->atndtz_bt_period;
        }elseif (!empty($horarioExcepcion->atndex_id)) {
            $standar->id = $horarioExcepcion->atndex_id;
            $standar->nombre = $horarioExcepcion->atndex_name." <label><i>(E)</i></label>";
            $standar->rt = "00000000";
            $standar->bt = "00000000";
        }else{
            $standar->id = NULL;
            $standar->nombre = "";
            $standar->rt = "00000000";
            $standar->bt = "00000000";
        }
        return $standar;
    }
    
    
    
    function crearSelectorHora ($desdeDate,$hastaDate){
        $optionsDesde = $optionsHasta = ''; 
        $horaStrings = $minutoStrings = array();
        for($hora=0;$hora<24;$hora++){
            $horaStrings[] = str_pad($hora, 2, "0", STR_PAD_LEFT); 
        }
        for($minuto=0;$minuto<60;$minuto+=15){ 
            $minutoStrings[] = str_pad($minuto, 2, "0", STR_PAD_LEFT);
        }        
        foreach ($horaStrings as $horaStringsTemp) {
            foreach ($minutoStrings as $minutoStringsTemp) {
                $optionsDesde .= '<option value="'.$desdeDate.$horaStringsTemp.$minutoStringsTemp.'00">'.$horaStringsTemp.':'.$minutoStringsTemp.':00 - '.$desdeDate.'</option>';
                $optionsHasta .= '<option value="'.$hastaDate.$horaStringsTemp.$minutoStringsTemp.'00">'.$horaStringsTemp.':'.$minutoStringsTemp.':00 - '.$hastaDate.'</option>';
            } 
        }
        return array('<select name="marca" class="form-control"  >'.$optionsDesde.'</select>'  ,'<select name="marca" class="form-control"  >'.$optionsDesde.$optionsHasta.'</select>' );
    }
    
    
    
    
    
    $horariosOptions ="";
    $excepcionesOptions ="";
    foreach ($bodyData->excepciones as $excepcionesTemp ) {
         $excepcionesOptions .=  '<option value="'.$excepcionesTemp->atndex_id.'">'.$excepcionesTemp->atndex_name.'</option>';
    }
    foreach ($bodyData->horarios as $horariosTemp ) {
         $horariosOptions .= '<option value="'.$horariosTemp->atndtz_id.'">'.$horariosTemp->atndtz_name.'</option>';
    }
    

    $bool = array('No','Si');                
    foreach ($bodyData->data as $usuarioTemp) {  // var_dump($eventoTemp);   break;  
        
        $entrada = (empty($usuarioTemp->atndd_atnd_in))?  "-:-:-" :date(' H:i:s', strtotime($usuarioTemp->atndd_atnd_in)) ;
        $salida =  (empty($usuarioTemp->atndd_atnd_out))? "-:-:-":date(' H:i:s', strtotime($usuarioTemp->atndd_atnd_out)) ;
        
        $diaDateTime = new DateTime ($usuarioTemp->atndd_date);
        $diaSiguienteDateTime = clone  $diaDateTime;
        $diaSiguienteDateTime->add(new DateInterval('P1D')); 
        $selectsArray = crearSelectorHora($diaDateTime->format('Ymd'), $diaSiguienteDateTime->format('Ymd'));
        
        $horarioExcepcion  = horarioOExcepcion($usuarioTemp->horarioExcepcion);

?>   


        <tr  name="dataRow"   > 
            <td ><?=(int)$usuarioTemp->atndd_id  ?></td>
            <td><?= date('Y-m-d', strtotime($usuarioTemp->atndd_date) ) ?> </td>
            <td>
                <?= ((int)$usuarioTemp->atndd_modified == 0 )?  $bool[(int)$usuarioTemp->atndd_modified] : (string)$usuarioTemp->nombreEditor  ?> 
            
            </td>
            <td  >
                
                <a class="pointer" name="ajaxDataTableTzEx" href="javascript:void(0);"><?= $horarioExcepcion->nombre ?></a>
            
                <div class="miniPop hide ">
                    <button type="button" class="close" style="position: absolute;right: 10px;"><span aria-hidden="true">&times;</span></button>
                    <table class="table table-responsive table-striped">
                        <thead >
                            <tr> 
                                <th>Horarios</th>
                                <th>Excepcion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <form name="formCambioHorario" >
                                        <select name="sheduleId" class="form-control">
                                            <option value="">N/A</option>
                                            <?=$horariosOptions?>
                                        </select>
                                        <input name="tipo" value="1" type="hidden">
                                        <input name="fechaDate" value="<?= date('Y-m-d', strtotime($usuarioTemp->atndd_date) ) ?>" type="hidden">
                                        <input name="usuarioId" value="<?=$usuarioTemp->atndd_id  ?>" type="hidden">
                                    </form>
                                </td>
                                <td>
                                    <form name="formCambioHorario" >
                                        <select name="sheduleId" class="form-control">
                                            <option value="">N/A</option>
                                            <?=$excepcionesOptions?>
                                        </select>
                                        <input name="tipo" value="2" type="hidden">
                                        <input name="fechaDate" value="<?= date('Y-m-d', strtotime($usuarioTemp->atndd_date) ) ?>" type="hidden">
                                        <input name="usuarioId" value="<?=$usuarioTemp->atndd_id  ?>" type="hidden">
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </td>
            <td><?= substr($horarioExcepcion->rt , 0, 2).":".substr($horarioExcepcion->rt , 2, 2) ?> </td>
            <td><?= substr($horarioExcepcion->rt , 4, 2).":".substr($horarioExcepcion->rt , 6, 2) ?> </td>
            <td  style="position: static;text-align: center;" >
                <a class="pointer" name="ajaxDataTableMarcaEntrada"> <?= $entrada ?> </a> 
                <div class="miniPop hide ">
                    <button type="button" class="close" style="position: absolute;right: 10px;"><span aria-hidden="true">&times;</span></button>
                    <h5>Cambiar Entrada </h5>
                    <form name="formCambioMarcaEntrada" style="margin-top: 10px;" >
                        <?=$selectsArray[0] // name="marca" ?>
                        <input name="tipo" value="1" type="hidden">
                        <input name="fechaDate" value="<?= date('Y-m-d', strtotime($usuarioTemp->atndd_date) ) ?>" type="hidden">
                        <input name="usuarioId" value="<?=$usuarioTemp->atndd_id  ?>" type="hidden">
                    </form> 
                </div> 
                <span></span>
            </td>
            <td class="pointer" style="position: static;text-align: center;" >
                <a class="pointer" name="ajaxDataTableMarcaSalida"> <?= $salida ?> </a> 
                <div class="miniPop hide ">
                    <button type="button" class="close" style="position: absolute;right: 10px;"><span aria-hidden="true">&times;</span></button>
                    <h5>Cambiar Salida </h5>
                    <form name="formCambioMarcaEntrada" style="margin-top: 10px;" >
                        <?=$selectsArray[1] // name="marca" ?>
                        <input name="tipo" value="2" type="hidden">
                        <input name="fechaDate" value="<?= date('Y-m-d', strtotime($usuarioTemp->atndd_date) ) ?>" type="hidden">
                        <input name="usuarioId" value="<?=$usuarioTemp->atndd_id  ?>" type="hidden">
                    </form> 
                </div> 
                <span></span>
            </td>
            <td data-type="min" ><?=$usuarioTemp->atndd_min_rt ?> </td>
            <td data-type="min" ><?=$usuarioTemp->atndd_min_ot ?> </td>
            <td data-type="min" ><?=$usuarioTemp->atndd_min_nt ?> </td>
            <td data-type="min" ><?=$usuarioTemp->atndd_min_total ?> </td>
            <td  >
                <?php if(count($usuarioTemp->justificador)>0){  //  var_dump($eventoTemp->justificador); ?>
                <div class="dropdown">
                    <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dLabel">
                        <?php foreach ($usuarioTemp->justificador as $justificadorTemp) { ?>
                            <li>
                                <a href="#"><?="E ". date('H:i:s', $justificadorTemp[0] ) ?></a>
                                <a href="#"><?="S ". date('H:i:s', $justificadorTemp[1] )  ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <?php }else{ echo 'S/M'; }?>
            </td>
        </tr>
    <?php } ?>
        
        
 <script>
$(document).ready(function() {

    var botonTrigger , form ,mostrar;
    bindElements('ajaxDataTableMarcaEntrada');
    bindElements('ajaxDataTableMarcaSalida');
     
    function bindElements(entradaSalidaName){
        botonTrigger = $('tr[name="dataRow"]').find('[name="'+entradaSalidaName+'"]'); 
        form = $('[name="formCambioMarcaEntrada"]');
        botonTrigger.unbind();
        form.unbind();
        botonTrigger.click(abrirPop);
        form.change(gatillo);
    };

    function abrirPop(e){
        mostrar = $(e.target);
        var element = $(e.target); 
        var miniPop = element.next(".miniPop");
        miniPop.removeClass("hide").addClass("show"); 
        miniPop.find('.close').click(function(){  miniPop.removeClass("show").addClass("hide"); });
    }

    function gatillo(e){ //alert($(element.target ).html()); 
        var form = $(e.target).parent();
        form.parents(".miniPop").removeClass("show").addClass("hide");
        var tr = form.parents('td');
        // prompt("Dime tu nombre", form.serialize());
        $.ajax({
           type: "POST",
           url: "<?= site_url('evento/cambiarDataMarcas') ?>",
           dataType: "html",
           data: form.serialize()  // Adjuntar los campos del formulario enviado.
        }).done(function( msg ) { 
         //   prompt("Dime tu nombre", msg);   
         //   alert(msg +" --"+msg.length);       	
            if (msg.length < 20 ){
                mostrar.text(msg);  
            }else{
                mostrar.text("Error"); 
            }
        }).fail(function( jqXHR, textStatus ) {
            
            var msj ="Error de Conexion";
            if(jqXHR.status===401){
                msj ="Acceso Denegado";
            } 
            var nuevo = $(   '<div>'+msj+'</div>' ).insertAfter( mostrar );
            nuevo.fadeOut( 5000 );
        });  
        form.find("select ").val("");; 
    }
});
</script>



        
<script>
$(document).ready(function() {

    var botonTrigger , form ;
    bindElements();
    
    function bindElements(){
        botonTrigger = $('tr[name="dataRow"]'); 
        form = $('[name="formCambioHorario"]');
        botonTrigger.find('[name="ajaxDataTableTzEx"]').unbind();
        form.unbind();
        botonTrigger.find('[name="ajaxDataTableTzEx"]').click(abrirPop);
        form.change(gatillo);
    };
    
    function abrirPop(e){
        var element = $(e.target); 
        var miniPop = element.next(".miniPop");
        miniPop.removeClass("hide").addClass("show"); 
        miniPop.find('.close').click(function(){  miniPop.removeClass("show").addClass("hide"); });
    }
    
    function gatillo(e){ //alert($(element.target ).html()); 
        var form = $(e.target).parent();
        form.parents(".miniPop").removeClass("show").addClass("hide");
        var tr = form.parents('tr[name="dataRow"]');
        // prompt("Dime tu nombre", form.serialize());
        $.ajax({
           type: "POST",
           url: "<?= site_url('evento/cambiarUserDailySchedule') ?>",
           dataType: "html",
           data: form.serialize()  // Adjuntar los campos del formulario enviado.
        }).done(function( msg ) { 
         //   prompt("Dime tu nombre", msg);   
        //    alert(msg +" --"+msg.length);       	
            if (msg.length > 100 ){
                $( msg ).insertAfter( tr ); 
                tr.empty();
                bindElements(); 
            }else{
                var nuevo = $( msg ).insertAfter( tr );
                nuevo.fadeOut( 5000 );
            }
        }).fail(function( jqXHR, textStatus ) {
            
            var msj ="Error de Conexion";
            if(jqXHR.status===401){
                msj ="Acceso Denegado";
            }
            var nuevo = $(  '<tr><td colspan="12" align="center">'+msj+'</td></tr>' ).insertAfter( tr );
            nuevo.fadeOut( 5000 );
        });  
        form.find("select ").val("");; 
    }
});
</script>
    
<script>
$(document).ready(function() {
   
   var tr = $('[name="dataRow"]');
   tr.click(function(){
       tr.css("background-color", "");
       $(this).css("background-color", "#d9edf7");
   }); 
});
</script>


    <?php
        $bodyData->tiempoEjecucion = (isset($bodyData->tiempoEjecucion))? (Utilitario::Tiempo_microtime_float()-$tiempoCrearRow)+$bodyData->tiempoEjecucion : 0 ;
    ?> 