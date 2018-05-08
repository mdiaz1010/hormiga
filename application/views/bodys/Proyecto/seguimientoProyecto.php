<?php

?>
<link href="<?= base_url('publico/css/dataTables.bootstrap.css')?>" rel="stylesheet">
 <script src="<?= base_url('publico/js/dataTables.bootstrap.js')?>"></script>
 <script src="<?= base_url('publico/js/jquery.dataTables.js')?>"></script>
 <script type="text/javascript" src="<?= base_url('publico/js/bootstrap-filestyle.min.js')?>"> </script>
 <link href="<?= base_url('publico/html_libs/dataTables/datatables.net-bs/css/dataTables.bootstrap.min.css')?>" rel="stylesheet">
<link href="<?= base_url('publico/html_libs/dataTables/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')?>"  rel="stylesheet">
<link href="<?= base_url('publico/html_libs/dataTables/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')?>" rel="stylesheet">
<link href="<?= base_url('publico/html_libs/dataTables/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')?>" rel="stylesheet">
<link href="<?= base_url('publico/html_libs/dataTables/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')?>" rel="stylesheet">
    
<div class="panel panel-default">     
                              <div class="panel-heading">
                           <h3> <small>    HISTORIAL DE PROYECTOS</small></h3>
                              </div>
                          <div class="panel-body" >
                               <div class="table-responsive">                                          
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>CODIGO</th>
                                            <th>PERIODO DE EJECUCION</th>
                                            <th>PROYECTO</th>
                                            <th>CLIENTE</th>
                                            <th>CONTACTO</th>
                                            <th>O.C</th>
                                            <th>STATUS PROYECTO</th>
                                            <th>STATUS FACTURACION</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                            
                                               
                                            <?php 
                                            foreach ($bodyData->valores as $value) {
                                                ?>
                                                <tr>
                                                    
                                                    <td><?= $value->id?>                             </td>
                                                    <td>
                                                       <a data-id="<?= $value->id?>" name="cuentaEditorTrigger2" href="javascript:void(0)" >
                                                        <?= $value->nombres?>   
                                                        </a>
                                                        
                                                    </td>                                                
                                                    <td><?= $value->nombreLocal?>                </td>
                                                    <td><?= $value->nombreLocal?>                </td>  
                                                    <td><?= $value->contacto?>                  </td> 
                                                    <td><?= $value->periodo?>                  </td> 
                                                    <td><?= $value->descripcion?>                  </td> 
                                                    <td><?= $value->contacto?>                  </td> 

                                           
                                                </tr> 
                                            <?php
                                            }
                                            ?>
                                           
                                    </tbody>
                                </table>


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
<script>
$(document).ready(function() {    
    $('[name="cuentaEditorTrigger2"]').click(function($element){
        var id = $(this).attr("data-id"); 
        $( "#cuentaEditorModal2" ).modal("show"); 
        enviarData(id);
    }); 
    function enviarData (id){
        $.ajax({
            url: "<?= site_url('Proyecto/bibliotecaAdmi/') ?>"+id,
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
         $(document).ready(function () {
             $('#dataTables-example').dataTable();
             $('#dataTables-tareas').dataTable();

         });
$(":file").filestyle({buttonName: "btn-primary"});    
    </script>