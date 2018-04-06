<?php ?>      
<link href="<?= base_url('publico/css/dataTables.bootstrap.css')?>" rel="stylesheet">
 <script src="<?= base_url('publico/js/dataTables.bootstrap.js')?>"></script>
 <script src="<?= base_url('publico/js/jquery.dataTables.js')?>"></script>
<link href="<?= base_url('publico/html_libs/dataTables/datatables.net-bs/css/dataTables.bootstrap.min.css')?>" rel="stylesheet">
<link href="<?= base_url('publico/html_libs/dataTables/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')?>"  rel="stylesheet">
<link href="<?= base_url('publico/html_libs/dataTables/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')?>" rel="stylesheet">
<link href="<?= base_url('publico/html_libs/dataTables/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')?>" rel="stylesheet">
<link href="<?= base_url('publico/html_libs/dataTables/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')?>" rel="stylesheet">
    
 
 <div class="row">
   <div class="col-lg-12">
        <h1>
        <small>Plataforma de Operaciones WIAPP INTERNATIONAL</small></h1>
   </div>
   </div>
  <div class="row" id="actualiza">
  <div id="content">
           
    <div class="inner">
    
            <div class="row">
                <div class="col-lg-12"> 
                    <div class="panel panel-default"  >
                        <div class="panel-heading" >
                            <h3>           <small>    REGISTRAR TAREA</small></h3>
                        </div>
                        <div class="panel-body">
                        <div class="row">        
                         
                        <form name="tarea_form" id="tarea_form" method="post">

                              

                                        
                                        <label class="col-xs-6 col-sm-3">
                                        Tarea:
                                        <input type="text" name="tarea"  id='tarea'  placeholder="Tarea..."     value="" class="form-control"  required="">
                                        <p id='result_idusuario' class="help-block"></p>
                                        </label>
                                        <label class="col-xs-6 col-sm-3">
                                        Proyecto:
                                        <select name="proyectoTarea" id="proyectoTarea" class="form-control" required="">
                                            <option ></option>
                                            <?php
                                            foreach ($bodyData->proyectoid as $rolesTemp) {
                                            ?>
                                                <option name='opciones' value="<?=$rolesTemp->id?>"><?=$rolesTemp->nombres?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        </label>                                        
 <div class="col-sm-6">  
                                        <label class="col-xs-6 col-ms-3">
                                        Descripcion:
                                        <input type="text" name="descripcionTarea"  id='descripcionTarea'  placeholder="Descripcion..."     value="" class="form-control"  required="">
                                        <p id='result_idusuario' class="help-block"></p>
                                        </label>
                                       <!-- <label class="col-xs-6 col-sm-3">
                                        Cantidad:
                                        <input type="number" name="descripcionTarea"  id='descripcionTarea'    style="width:80px;"  value="" class="form-control"  required>
                                        <p id='result_idusuario' class="help-block"></p>
                                        </label>     <br>--><br>
                                        <div class=" col-xs-6 col-sm-3">
                                            <input  type ='button' class="btn btn-danger" id='btn_enviarTarea' name='btn_enviarTarea' style="width:120px;"
                                               value="REGISTRAR " >

                                        </div>
</div>                                    
                                   
                              
                        
                                   
                        
                        </form>
</div>

                           
                       </div>
                        </div> 

      <div class="panel panel-default"  >
                        <div class="panel-heading" >
                            <h3>           <small>    REGISTRAR TAREA</small></h3>
                        </div>
                          <div class="panel-body" id="actualizable">
                               <div class="table-responsive">                                          
                                <table class="table table-striped table-bordered dt-responsive nowrap  " cellspacing="0" width="100%"  id="dataTables-tareas">
                                    <thead  class="bg-success">
                                        <tr>
                                            
                                            <th style="border: hidden;color: #3b752e;">PROYECTO</th>
                                            <th style="border: hidden;color: #3b752e;">TAREA</th>
                                            <th style="border: hidden;color: #3b752e;">SUPERVISOR</th>
                                            <th style="border: hidden;color: #3b752e;">STATUS</th>
                                            <th style="border: hidden;color: #3b752e;">FECHA</th>
                                            <th style="border: hidden;color: #3b752e;">CALENDARIO</th>
                                            <th style="border: hidden;color: #3b752e;">OBSERVACIONES</th>
                                            <th>OPCIONES</th>                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                            
                                               
                                            <?php  
                                            foreach ($bodyData->valor as $value) { 
                                              
                                                ?>
                                                <tr>
                                                    
                                                    
                                                    <td><?= $value->nomProyecto?>                             </td>
                                                    <td>
                                                        <a data-id="<?= $value->id?>" name="cuentaEditorTrigger3" href="javascript:void(0)" >
                                                        <?= $value->nombreTarea?>   
                                                        </a>                                                        
                                                    </td>
                                                    <td><?= $value->proycontacto?>                             </td>
                                                    <td><?= $value->status?>                             </td>
                                                    <td><?= $value->fechaCreacion?>                             </td>
                                                    <td><a href="#">CALENDARIO</a</td>                                                
                                                    <td><a href="#"><?= $value->descripcion?> </a></td>
                                                    <td>
                                                    <label style="margin-right: 7px;">
                                                        <i class="fa fa-pencil-square-o"></i>
                                                    <a data-id="<?= $value->id?>" name="cuentaEditorTrigger3" href="javascript:void(0)" >Edit</a>
                                                    </label>
                                                    <label style="margin-right: 7px;">
                                                        <i class="fa fa-minus-square"></i>
                                                    <a data-id="<?= $value->id?>" name="cuentaEditorTrigger4" href="javascript:void()" >Block</a>
                                                    </label>
                                                    </td>  


                                           
                                                </tr> 
                                            <?php 
                                          
                                            }
                                            ?>
                                           
                                    </tbody>
                                </table>


                               </div>
                            </div>

      </div>
                                  
                </div></div></div></div></div>
 
<!--  MODAL DE LISTA DE REGISTROS -->
<div class="modal   fade" id="permisosModal" tabindex="-1" role="dialog" aria-labelledby="permisosModalLabel" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="permisosModalLabel">Gestion de Permisos</h4>
            </div> 
            <div class="modal-body"  style="overflow-y: auto;">
                <center><img src="<?= base_url('publico/media/ajax-loader2.gif')?>" width="80" height="80" ></center>'
              <!-- ACA es la Zona de Contenido... SI solo tuviera algo que colocar T.T -->
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-sm-9 nombre" style="text-align: left;"> 
                    </div>
                    <div class="col-sm-3">
                        <form > 
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--  MODAL DE LISTA DE Areas -->
<div class="modal   fade" id="cuentaEditorModal" tabindex="-1" role="dialog" aria-labelledby="cuentaEditorModalLabel" >
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="ubicacionesModalLabel">EDICION DEL PROYECTO </h4>
            </div> 
            <div class="modal-body"  style=" ">
                <center><img src="<?= base_url('publico/media/ajax-loader2.gif')?>" width="80" height="80" ></center>'
              <!-- ACA es la Zona de Contenido... SI solo tuviera algo que colocar T.T -->
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-sm-9 nombre" style="text-align: left;"> 
                    </div>
                    <div class="col-sm-3">
                        <form > 
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal   fade" id="cuentaEditorModal1" tabindex="-1" role="dialog" aria-labelledby="cuentaEditorModalLabel" >
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="ubicacionesModalLabel">EDICION DEL PROYECTO </h4>
            </div> 
            <div class="modal-body"  style=" ">
                <center><img src="<?= base_url('publico/media/ajax-loader2.gif')?>" width="80" height="80" ></center>'
              <!-- ACA es la Zona de Contenido... SI solo tuviera algo que colocar T.T -->
            </div>

        </div>
    </div>
</div>
<div class="modal   fade" id="cuentaEditorModal2" tabindex="-1" role="dialog" aria-labelledby="cuentaEditorModalLabel" >
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="ubicacionesModalLabel">DOCUMENTOS OBLIGATORIOS* </h4>
            </div> 
            <div class="modal-body"  style=" ">
                <center><img src="<?= base_url('publico/media/ajax-loader2.gif')?>" width="80" height="80" ></center>'
              <!-- ACA es la Zona de Contenido... SI solo tuviera algo que colocar T.T -->
            </div>

        </div>
    </div>
</div>
<div class="modal   fade" id="cuentaEditorModal3" tabindex="-1" role="dialog" aria-labelledby="cuentaEditorModalLabel" >
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="ubicacionesModalLabel">EDICION DE TAREAS* </h4>
            </div> 
            <div class="modal-body"  style=" ">
                <center><img src="<?= base_url('publico/media/ajax-loader2.gif')?>" width="80" height="80" ></center>'
              <!-- ACA es la Zona de Contenido... SI solo tuviera algo que colocar T.T -->
            </div>

        </div>
    </div>
</div>
<div class="modal   fade" id="cuentaEditorModal4" tabindex="-1" role="dialog" aria-labelledby="cuentaEditorModalLabel" >
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="ubicacionesModalLabel">DESACTIVAR TAREA </h4>
            </div> 
            <div class="modal-body"  style=" ">
                <center><img src="<?= base_url('publico/media/ajax-loader2.gif')?>" width="80" height="80" ></center>'
              <!-- ACA es la Zona de Contenido... SI solo tuviera algo que colocar T.T -->
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-sm-9 nombre" style="text-align: left;"> 
                    </div>
                    <div class="col-sm-3">
                        <form > 
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {    
    $('[name="cuentaEditorTrigger4"]').click(function($element){
        var id = $(this).attr("data-id"); 
        $( "#cuentaEditorModal4" ).modal("show"); 
        enviarData(id);
    }); 
    function enviarData (id){
        $.ajax({
            url: "<?= site_url('Proyecto/mensajeBloqueoTarea/') ?>"+id,
            method: "GET",
           // data: { id : id },
            dataType: "html"
        }).done(function( msg ) { //alert("bien");
            var height = $(window).height() * 0.60 ;
            var width = $(window).width()  * 0.70 ;
            var modal = $( "#cuentaEditorModal4" );
            modal.find('.modal-body') .html( msg );
        }).fail(function( jqXHR, textStatus ) {
            var msj ="Error de Conexion";
            if(jqXHR.status===401){
                msj ="Acceso Denegado";
            }
            var modal = $( "#ubicacionesModal" );
        

    modal.find('.modal-body') .html( "<p> "+msj+" </p>" );
        });        
    }
});    
</script>
<script>
$(document).ready(function() {    
    $('[name="cuentaEditorTrigger3"]').click(function($element){
        var id = $(this).attr("data-id"); 
        $( "#cuentaEditorModal3" ).modal("show"); 
        enviarData(id);
    }); 
    function enviarData (id){
        $.ajax({
            url: "<?= site_url('Proyecto/editarTarea/') ?>"+id,
            method: "GET",
           // data: { id : id },
            dataType: "html"
        }).done(function( msg ) { //alert("bien");
            var height = $(window).height() * 0.60 ;
            var width = $(window).width()  * 0.70 ;
            var modal = $( "#cuentaEditorModal3" );
            modal.find('.modal-body') .html( msg );
        }).fail(function( jqXHR, textStatus ) {
            var msj ="Error de Conexion";
            if(jqXHR.status===401){
                msj ="Acceso Denegado";
            }
            var modal = $( "#ubicacionesModal" );
        

    modal.find('.modal-body') .html( "<p> "+msj+" </p>" );
        });        
    }
});    
</script>
<script>
$(document).ready(function() {    
    $('[name="cuentaEditorTrigger2"]').click(function($element){
        var id = $(this).attr("data-id"); 
        $( "#cuentaEditorModal2" ).modal("show"); 
        enviarData(id);
    }); 
    function enviarData (id){
        $.ajax({
            url: "<?= site_url('Proyecto/agregardocumentos/') ?>"+id,
            method: "GET",
           // data: { id : id },
            dataType: "html"
        }).done(function( msg ) { //alert("bien");
            var height = $(window).height() * 0.60 ;
            var width = $(window).width()  * 0.70 ;
            var modal = $( "#cuentaEditorModal2" );
            modal.find('.modal-body') .html( msg );
        }).fail(function( jqXHR, textStatus ) {
            var msj ="Error de Conexion";
            if(jqXHR.status===401){
                msj ="Acceso Denegado";
            }
            var modal = $( "#ubicacionesModal" );
        

    modal.find('.modal-body') .html( "<p> "+msj+" </p>" );
        });        
    }
});    
</script>

<script>
$(document).ready(function() {    
    $('[name="cuentaEditorTrigger1"]').click(function($element){
        var id = $(this).attr("data-id"); 
        $( "#cuentaEditorModal1" ).modal("show"); 
        enviarData(id);
    }); 
    function enviarData (id){
        $.ajax({
            url: "<?= site_url('Proyecto/mensajeBloqueo/') ?>"+id,
            method: "GET",
           // data: { id : id },
            dataType: "html"
        }).done(function( msg ) { //alert("bien");
            var height = $(window).height() * 0.75 ;
            var width = $(window).width()  * 0.90 ;
            var modal = $( "#cuentaEditorModal1" );
            modal.find('.modal-body') .html( msg );
        }).fail(function( jqXHR, textStatus ) {
            var msj ="Error de Conexion";
            if(jqXHR.status===401){
                msj ="Acceso Denegado";
            }
            var modal = $( "#ubicacionesModal" );
        

    modal.find('.modal-body') .html( "<p> "+msj+" </p>" );
        });        
    }
});    
</script>


   <script>         
$(document).ready(function() {    
    $('[name="cuentaEditorTrigger"]').click(function($element){
        var id = $(this).attr("data-id"); 
        $( "#cuentaEditorModal" ).modal("show"); 
        enviarData(id);
    }); 
    function enviarData (id){
        $.ajax({
            url: "<?= site_url('Proyecto/datosPerfil/') ?>"+id,
            method: "GET",
           // data: { id : id },
            dataType: "html"
        }).done(function( msg ) { //alert("bien");
            var height = $(window).height() * 0.75 ;
            var width = $(window).width()  * 0.90 ;
            var modal = $( "#cuentaEditorModal" );
            modal.find('.modal-body') .html( msg );
        }).fail(function( jqXHR, textStatus ) {
            var msj ="Error de Conexion";
            if(jqXHR.status===401){
                msj ="Acceso Denegado";
            }
            var modal = $( "#ubicacionesModal" );
        

    modal.find('.modal-body') .html( "<p> "+msj+" </p>" );
        });        
    }
});    








 
var f=new Date();
var ano = f.getFullYear();
var mes = f.getMonth();
var dia = f.getDate();
var estiloDia;
var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
var diasMes = new Array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
var diaMaximo = diasMes[mes];
if (mes == 1 && (((ano % 4 == 0) && (ano % 100 != 0)) || (ano % 400 == 0)))
   diaMaximo = 29;

        
        
/*By George Chiang (WA's JavaScript tutorial)

Credit must stay intact for use*/
function show(){
var Digital=new Date();
var hours=Digital.getHours();
var minutes=Digital.getMinutes();
var seconds=Digital.getSeconds();
var dn="AM" ;
if (hours>12){
dn="PM";
hours=hours-12;
}
if (hours==0){
hours=12;
}
if (minutes<=9){
minutes="0"+minutes;}
if (seconds<=9){
seconds="0"+seconds;}
    $('#hora').val(hours+":"+minutes+":"+seconds+" "+dn);// IMPRIMO LA HORA
setTimeout("show()",1000);
}
show();
        
 
			

     
    fechaImprimible =diasSemana[f.getDay()] + ", " + f.getDate() + " de " + meses[f.getMonth()] + " del " + f.getFullYear() ;
   
        
    $("#fecha").val(fechaImprimible); //IMPRIMO LA FECHA
   	 

   //MODAL


    </script>
    <script>

    
        $("#btn_enviarTarea").click(function(){
            var tareaid = $("#proyectoTarea").val();

            
            $.ajax({
                url : "<?= site_url('Proyecto/registrarTarea') ?>",                
                type: "POST",
                data: $("#tarea_form").serialize(),
            }).success(function(){
    javascript:location.reload();                           
  //    $("#actualizable").load("<?= site_url('Proyecto/mostrarTareaProyecto/') ?>+tareaid"); 

                        });                                                                                                                                                                                          
                      
        });;
            

        

    </script> 
<script>

         $(document).ready(function () {             
             $('#dataTables-tareas').dataTable();
         });         
</script>