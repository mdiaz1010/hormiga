<?php

$permisosDeleteCentroCosto = Utilitario::moduloEstaDisponible('Ubicacion/eliminarDivision', $this->session->webCasSession->modulos)  ;
$permisosInsertCentroCosto = Utilitario::moduloEstaDisponible('Ubicacion/registrarDivision', $this->session->webCasSession->modulos)
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
  
     
<div class="panel panel-danger col-md-4 col-xs-12  col-sm-6 sombra">
    <div class="panel-heading">
        <h4>CONTABILIDAD</h4>
        <?php
        if ($permisosInsertCentroCosto) {
            ?>
         <div class="text-right">
            <a id="divisionAdd"     href="javascript:void(0);">
                Agregar
                <i class="fa fa-plus-square"></i>
            </a>
        </div>
        <?php
        }
        ?>
    </div>
    <div class="panel-body" id="divisionList" style="height:400px;overflow-y: auto; ">      
        <?php
        foreach ($bodyData->division as $locacion) {
            $locacion = (object)$locacion;
            //if(yaTienePermisos($modulo->id,$bodyData->permisos)) continue;
            $classCss = ($locacion->cpds_status==1)? " bg-success" :" bg-danger"; ?>
            <div class="col-xs-12 sombra modulos-list  <?=$classCss?>"  >                    
              <div class="col-xs-12 text-left"  title="<?=$locacion->cpds_desc?>" ><a href="../../../../wiapp/temp/<?=$locacion->nomArchivo?>" target="_blank"><?=$locacion->cpds_name?>/<?=$locacion->nomArchivo?></a></div>
                <?php 
                    if ($permisosDeleteCentroCosto) {
                        ?>
                <a name="divisionDelete" data-id="<?=$locacion->cpds_id ?>" class="flecha-der" href="javascript:void(0);">
                    <i class="fa fa-close"></i>
                </a>
                <?php
                    } ?>
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
<div class="modal   fade" id="divisionAddModal" tabindex="-1" role="dialog" aria-labelledby="divisionAddModal" >
    <div class="modal-dialog " role="document">
        <div class="modal-content modal-md">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="divisionAddModalLabel">Agregar Archivo</h4>
            </div> 
            <div class="modal-body"  style=" ">
                
                <form id="divisionForm">
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
                            <td><input name="archivo" type="file"   maxlength="200" > </td>
                        </tr>                          
                        <tr>
                            <th id="divisionAddModalMsj"><?php     ?></th>
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
    $('#divisionAdd').click(function(){ 
        $('#divisionAddModal').modal('toggle');
        $('#divisionAddModal').find('input[type="text"]').val(''); 
        $('#divisionAddModalMsj').text("");
    });
});
</script>
<script> 
$(document).ready(function() { 
     
    $('#divisionForm').submit(function(e){  
     //var archivo=$("#archivo").val();
     //var archivo = $("#archivo")[0].files[0]["name"];
        e.preventDefault();
        var form=new FormData($(this)[0]);
//        form.append('archivo',archivo);
        $.ajax({
            url: '<?= site_url("Ubicacion/registrarDivision")?>',
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
                $('#divisionList').append(element); 
                $('#divisionAddModal').modal('toggle');
            }else{
                $('#divisionAddModalMsj').text("No Fue Posible Registrar");
            }
        }).fail(function( jqXHR, textStatus ) {
            //alert(jqXHR.responsetext );
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


<!--  MODAL DE ElIMINACION -->
<div class="modal   fade" id="divisionDeleteModal" tabindex="-1" role="dialog" aria-labelledby="divisionDeleteModalLabel" >
    <div class="modal-dialog " role="document">
        <div class="modal-content modal-md">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="divisionDeleteModalLabel">Eliminar Archivo</h4>
            </div> 
            <div class="modal-body"  style=" ">
                
                <p>¿Desea continuar realizando esta operacion?</p>
                <button type="button" id="divisionDeleteModalConfirmar" class="btn btn-danger" data-dismiss="modal">Si, Borrar</button>
                <div id="divisionDeleteModalMsj"></div>
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
  
    $('[name="divisionDelete"]').click(function(){
        var id = $(this).attr('data-id');
        var element = $(this).parent();
        $('#divisionDeleteModal').modal('toggle'); 
        var boton = $('#divisionDeleteModalConfirmar'); 
        var msj = $('#divisionDeleteModalMsj');
        msj.text("");        
        boton.unbind(); // cuando se cierra la ventana sin hacer click
        boton.click(function(){
        boton.unbind(); // una vez borrado no se debe repetir la consulta
        
         
            $.ajax({
                url: '<?= site_url("Ubicacion/eliminarDivision")?>',
                method: "POST",
                data: {id:id},
                dataType: "html"
            }).done(function( json ) { 
                // alert(json); //msj
                json = $.parseJSON(json)
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