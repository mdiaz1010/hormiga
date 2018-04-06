<?php

//var_dump($bodyData->RestriccionUbicaciones);

function yaTienePermisos($id,$type,$RestriccionUbicaciones){
    foreach ($RestriccionUbicaciones as $value) {
        if((string)$value->areaId === (string)$id and (string)$value->area === (string)$type )
            return true;
    }
    return FALSE;
}

?>

<style>
    .modulos-list{
        border-radius: 10px;
        margin: 3px;
        padding: 5px;
    }
    .flecha-der{
        position: absolute;
        right: 10px;
    }
    .flecha-izq{
        z-index: 2;
        position: absolute;
        left: 10px;
    }
     
</style>
<!-- DATA -->
<div class="row" style="padding: 0px 50px 0px 50px;" >
    
    <center class="nombreUsuario" style="display: none;"><h3 class=" text-success" ><?=$bodyData->usuario->nombre?></h3></center>
    
    <div class="panel panel-info col-md-4 col-xs-12 sombra">
        <div class="panel-heading">
            <h4>Delimitar Locacion</h4>
            <p class="text-right">
                
            </p>
        </div>
        <div class="panel-body" id="LocacionPanel" style="max-height: 400px; overflow: auto;">      
            <?php
            foreach ($bodyData->locations as $location) { 
                $checked = "";
                $css = ' bg-danger '; 
                if(yaTienePermisos($location->cplt_id,1,$bodyData->RestriccionUbicaciones)) {
                    $checked = ' checked="checked" ';
                    $css = ' bg-success ';
                } 
                 
                ?>
                <div class="col-xs-12 sombra modulos-list <?=$css?>"  >                    
                    <div class="col-xs-8 text-left"  title="<?=$location->cplt_desc?>" >
                        <?=$location->cplt_name?>
                    </div> 
                    <input name="ubicacionCheckbox" data-type="1" value="<?=$location->cplt_id?>"  <?=$checked?>  type="checkbox" class="col-xs-4">
                </div>
            <?php
            }
            ?> 
        </div>
    </div>
 
    
    
    <div class="panel panel-info col-md-4 col-xs-12 sombra">
        <div class="panel-heading">
            <h4>Delimitar Seccion</h4>
            <p class="text-right">
                
            </p>
        </div>
        <div class="panel-body" id="LocacionPanel" style="max-height: 400px; overflow: auto;">      
            <?php
            foreach ($bodyData->divisions as $division) { 
                $checked = "";
                $css = ' bg-danger '; 
                if(yaTienePermisos($division->cpds_id,2,$bodyData->RestriccionUbicaciones)) {
                    $checked = ' checked="checked" ';
                    $css = ' bg-success ';
                } 
                ?>
                <div class="col-xs-12 sombra modulos-list <?=$css?>"  >                    
                    <div class="col-xs-8 text-left"  title="<?=$division->cpds_desc?>" >
                        <?=$division->cpds_name?>
                    </div> 
                    <input name="ubicacionCheckbox" data-type="2" value="<?=$division->cpds_id?>"  <?=$checked?>  type="checkbox" class="col-xs-4">
                </div>
            <?php
            }
            ?> 
        </div>
    </div>
    
          
    <div class="panel panel-info col-md-4 col-xs-12 sombra">
        <div class="panel-heading">
            <h4>Delimitar Departamentos</h4>
            <p class="text-right">
                
            </p>
        </div>
        <div class="panel-body" id="LocacionPanel" style="max-height: 400px; overflow: auto;">      
            <?php
            foreach ($bodyData->departments as $departmento) { 
                $checked = "";
                $css = ' bg-danger '; 
                if(yaTienePermisos($departmento->cpdt_id,3,$bodyData->RestriccionUbicaciones)) {
                    $checked = ' checked="checked" ';
                    $css = ' bg-success ';
                } 
                ?>
                <div class="col-xs-12 sombra modulos-list <?=$css?>"  >                    
                    <div class="col-xs-8 text-left"  title="<?=$departmento->cpdt_desc?>" >
                        <?=$departmento->cpdt_name?>
                    </div> 
                    <input name="ubicacionCheckbox" data-type="3" value="<?=$departmento->cpdt_id?>"  <?=$checked?>  type="checkbox" class="col-xs-4">
                </div>
            <?php
            }
            ?> 
        </div>
    </div>
    
    <div class="panel panel-info col-md-4 col-xs-12 sombra">
        <div class="panel-heading">
            <h4>Delimitar Centro Costo</h4>
            <p class="text-right">
                
            </p>
        </div>
        <div class="panel-body" id="LocacionPanel" style="max-height: 400px; overflow: auto;">      
            <?php
            foreach ($bodyData->centroCosto as $departmento) { 
                $checked = "";
                $css = ' bg-danger '; 
                if(yaTienePermisos($departmento->id,4,$bodyData->RestriccionUbicaciones)) {
                    $checked = ' checked="checked" ';
                    $css = ' bg-success ';
                } 
                ?>
                <div class="col-xs-12 sombra modulos-list <?=$css?>"  >                    
                    <div class="col-xs-8 text-left"  title="<?=$departmento->desc?>" >
                        <?=$departmento->name?>
                    </div> 
                    <input name="ubicacionCheckbox" data-type="4" value="<?=$departmento->id?>"  <?=$checked?>  type="checkbox" class="col-xs-4">
                </div>
            <?php
            }
            ?> 
        </div>
    </div>
          
</div>


<script>
    /*pasar Permisos */
$(document).ready(function() {
    
     
    ini();
    function ini(){
        disparadorIzq(); 
    }
    
     
    function disparadorIzq(){
        $('[name="ubicacionCheckbox"]').unbind();
        $('[name="ubicacionCheckbox"]').click(function(){
            var element  = $(this);
            var usuarioId = '<?=$bodyData->usuario->id?>'; 
            var dir = "<?= site_url('cuenta/ubicacionesToggle') ?>";
            cargarData( usuarioId,dir,element);
        });
    }
    
    
    function cargarData (usuarioId,dir,element){
        $.ajax({
            url: dir,
            method: "POST",
            data: { usuarioId:usuarioId,ubicacionType:element.attr('data-type'),ubicacionId:element.val() },
            dataType: "html"
        }).done(function( json ) { 
            //alert(json); 
            var obj = jQuery.parseJSON( json); 
            if(obj.bool === true  ){ 
                cambiarEstado(element,obj.operacion);
            }
            ini();
        }).fail(function( jqXHR, textStatus ) {
            var msj ="Error de Conexion";
            if(jqXHR.status===401){
                msj ="Acceso Denegado";
            }
            var nuevo = $(  '<div class="col-xs-12  "> '+msj+'</div>' ).insertAfter( element );
            nuevo.fadeOut( 3000 );
           // alert(msj);
        });
    }
    
    function cambiarEstado(element,operacion){
         
        var div = element.parent(); 
        if(operacion === "create" ){
            div.removeClass("bg-danger").addClass("bg-success");
            element.prop('checked', true); 
        }else if(operacion ===  "delete" ){
            div.removeClass("bg-success").addClass("bg-danger");
            element.prop('checked', false); 
        } 
    }
    
    
 
 
  
    
}); 
</script>