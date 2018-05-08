<?php

//var_dump($bodyData);

function yaTienePermisos($id, array $permisos)
{
    foreach ($permisos as $value) {
        if ($value->WebModulos_id == $id) {
            return true;
        }
    }
    return false;
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
    
    <center class="nombreUsuario" style="display: none;"><h3 class=" text-success" ><?=$bodyData->usuario->USUARIO?></h3></center>
    
    <div class="panel panel-info col-md-5 col-xs-12 sombra">
        <div class="panel-heading">
            <h4>Modulos Disponibles</h4>
            <p class="text-right">
                <a name="pasarModuloDerTodos"     href="javascript:void(0);">
                    Permitir Todo
                    <i class="fa fa-arrow-right"></i>
                </a>
            </p>
        </div>
        <div class="panel-body" id="modulosDisponiblesPanel">      
            <?php
            foreach ($bodyData->modulos as $locacion) {
                $locacion = (object)$locacion; ?>
                <div class="col-xs-12 sombra modulos-list  bg-danger"  >                    
                    <div class="col-xs-12 text-left"  title="<?=$locacion->descripcion?>" ><?=$locacion->titulo?></div>
                    <a name="pasarModuloDer" data-modulo="<?=$locacion->id ?>" class="flecha-der" href="javascript:void(0);">
                        <i class="fa fa-arrow-right"></i>
                    </a>
                </div> 
            
            <?php
            }
            ?> 
        </div>
    </div>

            <div class="col-md-1 col-xs-12"> 
            </div>
    
    
    <div class="panel panel-info col-md-5 col-xs-12 sombra">
        <div class="panel-heading">
            <h4>Modulos Permitidos</h4>
            <p class="text-left">
                <a name="pasarModuloIzqTodos"     href="javascript:void(0);"> 
                    <i class="fa fa-arrow-left"></i>
                    Restringir Todo
                </a>
            </p>
        </div>
        <div class="panel-body" id="modulosPermitidosPanel">      
            <?php
            foreach ($bodyData->permisos as $permiso) {
                $permiso = (object)$permiso; ?>
                <div class="col-xs-12 sombra modulos-list  bg-success"  >                    
                    <a name="pasarModuloIzq" data-modulo="<?=$permiso->WebModulos_id ?>" class="flecha-izq" href="javascript:void(0);">
                        <i class="fa fa-arrow-left"></i>
                    </a>
                    <div class="col-xs-11 text-right" title="<?=$permiso->descripcion?>" ><?=$permiso->titulo?></div>
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
        disparadorIzqTodos();
        disparadorDer();
        disparadorDerTodos();
    }
     
    function disparadorIzq(){
        $('[name="pasarModuloDer"]').unbind();
        $('[name="pasarModuloDer"]').click(function(){
            var element  = $(this);
            var usuarioId = '<?=$bodyData->usuarioId?>';
            
            var moduloId  =  element.attr('data-modulo');            
            var dir = "<?= site_url('cuenta/permisosAsignar') ?>";
            cargarData( moduloId,usuarioId,dir,element);
        });
    }
    
    function disparadorIzqTodos(){
        $('[name="pasarModuloDerTodos"]').click(function(){
            var time = 200;
            $('[name="pasarModuloDer"]').each(function(index ){ 
                var element = $( this );
                setTimeout( function(){ 
                    $( element ).click() ;
                    $( element ).unbind();
                }, time);
                time += 200;
            });
        });
    }
    
    function cargarData (moduloId,usuarioId,dir,element){
        $.ajax({
            url: dir,
            method: "POST",
            data: { usuarioId:usuarioId,moduloId:moduloId },
            dataType: "html"
        }).done(function( bool ) { 
            //alert(bool);
            if(parseInt(bool)===1){
                moverDerecha(element);
            }
            ini();
        }).fail(function( jqXHR, textStatus ) {
            var msj ="Error de Conexion";
            if(jqXHR.status===401){
                msj ="Acceso Denegado";
            }
            var nuevo = $(  '<div class="col-xs-12  "> '+msj+'</div>' ).insertAfter( element );
            nuevo.fadeOut( 3000 );
           //  alert("error");
             
        });
    }
    
    function moverDerecha(element){
        var div = element.parent();
        div.removeClass("bg-danger").addClass("bg-success"); 
        div.find('.text-left').removeClass("text-left").addClass("text-right"); 
        div.find('.fa-arrow-right').removeClass("fa-arrow-right").addClass("fa-arrow-left"); 
        element.removeClass("flecha-der").addClass("flecha-izq"); 
        element.attr('name',"pasarModuloIzq");
        
        var panelPermitidos = $('#modulosPermitidosPanel');
        panelPermitidos.append(div);
    }
    
    
 
 
 
 
    
    
     
    function disparadorDer(){
        $('[name="pasarModuloIzq"]').unbind();
        $('[name="pasarModuloIzq"]').click(function(){
            var element  = $(this);
            var usuarioId = '<?=$bodyData->usuarioId?>';
            var moduloId  =  element.attr('data-modulo');
            var dir = "<?= site_url('cuenta/permisosEliminar') ?>";
            quitarData( moduloId,usuarioId,dir,element);
        });
    }
    
    function disparadorDerTodos(){
        $('[name="pasarModuloIzqTodos"]').click(function(){
            var time = 200;
            $('[name="pasarModuloIzq"]').each(function(index ){
                var element = $( this );
                setTimeout( function(){ 
                    $( element ).click() ;
                    $( element ).unbind();
                }, time);
                time += 200;
            });
        });
    }
    
    function quitarData (moduloId,usuarioId,dir,element){
        //alert(usuarioId+" -- "+moduloId);
        $.ajax({
            url: dir,
            method: "POST",
            data: { usuarioId:usuarioId,moduloId:moduloId },
            dataType: "html"
        }).done(function( bool ) { 
            // alert(bool);
            if(parseInt(bool)===1){
                moverIzq(element);
            }
            ini();
        }).fail(function( jqXHR, textStatus ) {
            var msj ="Error de Conexion";
            if(jqXHR.status===401){
                msj ="Acceso Denegado";
            }
            //alert(msj);
            var nuevo = $(  '<div class="col-xs-12    "> '+msj+'</div>' ).insertAfter( element );
            nuevo.fadeOut( 3000 );
             
        });
    }
    
    function moverIzq(element){
        var div = element.parent();
        div.removeClass("bg-success").addClass("bg-danger"); 
        div.find('.text-right').removeClass("text-right").addClass("text-left"); 
        div.find('.fa-arrow-left').removeClass("fa-arrow-left").addClass("fa-arrow-right"); 
        element.removeClass("flecha-izq").addClass("flecha-der"); 
        element.attr('name',"pasarModuloDer");
        
        var panelPermitidos = $('#modulosDisponiblesPanel');
        panelPermitidos.append(div);
    }
    
    
    
    
}); 
</script>