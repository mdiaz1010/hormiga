<?php

$permisosDeleteCentroCosto = Utilitario::moduloEstaDisponible('Ubicacion/eliminarLocacion', $this->session->webCasSession->modulos)  ;
$permisosInsertCentroCosto = Utilitario::moduloEstaDisponible('Ubicacion/registrarLocacion', $this->session->webCasSession->modulos)
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
  
     
<div class="panel panel-info col-md-4 col-xs-12 col-sm-6 sombra">
    <div class="panel-heading">
        <h4>ADMINISTRACION Y FINANZAS</h4>
        <?php
        if ($permisosInsertCentroCosto) {
            ?>

        <?php
        }
        ?>
    </div>
    <div class="panel-body" id="locacionesList" style="height:400px;overflow-y: auto; ">      
        <?php
        foreach ($bodyData->locaciones as $locacion) {
            $locacion = (object)$locacion;
            //if(yaTienePermisos($modulo->id,$bodyData->permisos)) continue;
            $classCss = ($locacion->cplt_status==1)? " bg-success" :" bg-danger"; ?>
            <div class="col-xs-12 sombra modulos-list  <?=$classCss?>"  >                    
                <div class="col-xs-12 text-left"  title="<?=$locacion->cplt_desc?>" ><a href="../../../../wiapp/temp/<?=$locacion->nomArchivo?>" target="_blank"><?=$locacion->cplt_name?>/<?=$locacion->nomArchivo?></a></div>

            </div> 
        <?php
        }
        ?> 
    </div>
</div>
 

<?php
    if ($permisosInsertCentroCosto) {
        ?>
 <!--  MODAL DE LISTA DE REGISTROS -->
<div class="modal   fade" id="locacionesAddModal" tabindex="-1" role="dialog" aria-labelledby="locacionesAddModal" >
    <div class="modal-dialog " role="document">
        <div class="modal-content modal-md">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="locacionesAddModalLabel">Agregar Archivo</h4>
            </div> 
            <div class="modal-body"  style=" ">
                
                <form id="locacionForm" name="locacionForm" method="post" role="form" enctype="multipart/form-data">
		<input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
                    <table class="table table-striped ">
                        <tr>
                            <th>Nombre</th>
                            <td><input name="nombre" type="text" placeholder="Nombre " class="form-control" maxlength="200" required="" autofocus=""   > </td>
                        </tr>
                        <tr>
                            <th>Descripcion</th>
                            <td><input name="descripcion" type="text" placeholder="Descripcion " class="form-control" maxlength="200" required=""> </td>
                        </tr>
                        <tr>
                            <th>Archivo</th>
                            <td><input name="archivo" type="file"    > </td>
                        </tr>                        
                        <tr>
                            <th id="locacionesAddModalMsj"><?php     ?></th>
                            <td><input value="Registrar" type="submit" class="btn btn-primary" > </td>
                        </tr>
                    </table>
                </form>
                
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-sm-9 nombre" style="text-align: left;"> 
                    </div>
                    <div class="col-sm-3">
                         
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                         
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 
<script>
$(document).ready(function() {
    $('#locacionesAdd').click(function(){ 
        $('#locacionesAddModal').modal('toggle');
        $('#locacionesAddModal').find('input[type="text"]').val('');
    });
});
</script>
<script> 
$(document).ready(function() { 
     
    $('#locacionForm').submit(function(e){ 
     //var archivo=$("#archivo").val();
     //var archivo = $("#archivo")[0].files[0]["name"];
        e.preventDefault();
        var form=new FormData($(this)[0]);
//        form.append('archivo',archivo);
        
        $.ajax({
            url: '<?= site_url("Ubicacion/registrarLocacion")?>',
            method: "POST",            
            data: form,
            contentType: false, //importante enviar este parametro en false
            processData: false
        }).done(function( json ) { 
            //alert(json); //msj
             location.reload(true);
            json = $.parseJSON(json);
            if(json.msj==="1"){ 
                var element = '<div class="col-xs-12 sombra modulos-list  bg-success"  > '                    
                    +'<div class="col-xs-12 text-left"  title="'+json.desc+'" ><a href="#">'+json.name+'/'+json.nomArchivo+'</a></div>' 
                    +'<a name="pasarModuloDer" data-modulo="'+json.id+'" class="flecha-der" href="javascript:void(0);">' 
                    +'<i class="fa fa-close"></i> </a> </div> '; 
                $('#locacionesList').append(element); 
                $('#locacionesAddModal').modal('toggle');
            }else{
                $('#locacionesAddModalMsj').text("No Fue Posible Registrar");
            }
        }).fail(function( jqXHR, textStatus ) {
         //   alert(jqXHR.responsetext );
            var msj ="Error de Conexion";
            if(jqXHR.status===401){
                msj ="Acceso Denegado";
            }
            var nuevo = $(  '<div class="col-xs-12  "> '+msj+'</div>' ).insertAfter( form );
            nuevo.fadeOut( 3000 );
        });
    });
}); 
</script>
<?php
    }
 
    if ($permisosDeleteCentroCosto) {
        ?>


<!--  MODAL DE LISTA DE REGISTROS -->
<div class="modal   fade" id="locacionesDeleteModal" tabindex="-1" role="dialog" aria-labelledby="locacionesDeleteModalLabel" >
    <div class="modal-dialog " role="document">
        <div class="modal-content modal-md">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="locacionesDeleteModalLabel">Eliminar Archivo</h4>
            </div> 
            <div class="modal-body"  style=" ">
                
                <p>¿Desea continuar realizando esta operacion?</p>
                <button type="button" id="locacionesDeleteModalConfirmar" class="btn btn-danger" data-dismiss="modal">Si, Borrar</button>
                <div id="locacionesDeleteModalMsj"></div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-sm-9 nombre" style="text-align: left;"> 
                    </div>
                    <div class="col-sm-3">
                         
                        <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
                         
                         
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script> 
$(document).ready(function() { 


    $('[name="locacionesDelete"]').click(function(){
        var id = $(this).attr('data-id');
        var element = $(this).parent();
        $('#locacionesDeleteModal').modal('toggle'); 
        var boton = $('#locacionesDeleteModalConfirmar'); 
        boton.unbind(); // cuando se cierra la ventana sin hacer click
        boton.click(function(){
        boton.unbind(); // una vez borrado no se debe repetir la consulta
        var msj = $('#locacionesDeleteModalMsj');
         
            $.ajax({
                url: '<?= site_url("Ubicacion/eliminarLocacion")?>',
                method: "POST",
                data: {id:id},
                dataType: "html"
            }).done(function( json ) { 
                // alert(json); //msj
                json = $.parseJSON(json);
                if(json.msj==="1"){ 
                    element.remove();
                }else{
                    msj.text("No Fue Posible Completar la Funcion");
                }
            }).fail(function( jqXHR, textStatus ) {
                //alert(jqXHR.responsetext );
                var msj ="Error de Conexion";
                if(jqXHR.status===401){
                    msj ="Acceso Denegado";
                }
                var nuevo = $(  '<div class="col-xs-12  "> '+msj+'</div>' ).insertAfter(  msj );
                nuevo.fadeOut( 3000 );
            });
        });
    });
}); 
</script>
<?php
    } ?>