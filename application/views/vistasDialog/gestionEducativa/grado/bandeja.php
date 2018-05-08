<?php
?>
                        <div class="row">
                        <div class="panel panel-default">                                          
                                <table class="table table-striped table-bordered dt-responsive nowrap  " cellspacing="0" width="100%" id="dataTables-grado">
                                    <thead class="bg-success" >
                                        <tr>
                                     <th style="border: hidden;color: #3b752e;"><center>CODIGO      </center></th>
                                     <th style="border: hidden;color: #3b752e;"><center>NOMBRE      </center></th>                                               
                                     <th style="border: hidden;color: #3b752e;"><center>DESCRIPCION </center></th> 
                                     <th style="border: hidden;color: #3b752e;"><center>OPCIONES    </center></th> 
                                        </tr>
                                    </thead>                                   
                                    <tbody>                                               
                                            <?php  $i=0; foreach ($bodyData->grado as $grado) {
    ?>
                                                  <tr>  
                                                      <td><CENTER>GRAD000<?=$grado->id  ?></CENTER></td>
                                                      <td><CENTER><?=$grado->nom_grado  ?></CENTER></td>
                                                      <td><CENTER><?=$grado->des_grado  ?></CENTER></td>
                                                      <td><CENTER><a href="javascript:" class="btnEdicion"   data-id ="<?=$grado->id?>">Editar</a> 
                                                                  <a href="javascript:" class="btnEliminar"  data-ide="<?=$grado->id?>">Eliminar</a></CENTER></td>
                                                  </tr>
                                            <?php $i++;
} ?>                                        
                                          
                                    </tbody>
                                </table>

                        </div>
                        </div>
<div id="DIVELIMINARGRADO" title="INTRANET EDUCATIVA :: ELIMINAR GRADOS"></div>
<div id="DIVEDITARGRADO"   title="INTRANET EDUCATIVA :: EDITAR   GRADOS"></div>
<script type="text/javascript">       
	$(".btnEdicion").click(function(){      
		var id = $(this).data("id"); 
                $.ajax({
                    type: 'POST',
                    url: "editarGrado",
                    data: {id:id},
                    success: function (datos) {
                        if(datos.length>0){
                        $('#DIVEDITARGRADO').html(datos);  
                        $('#DIVEDITARGRADO').dialog('open');                            
                        }
                        return false;
                                              }                    
                });
                                        });    
	$(".btnEliminar").click(function(){                  
		var ide = $(this).data("ide");                             
                $.ajax({
                    type: 'POST',
                    url: "eliminarGrado",
                    data: {ide:ide},
                    success: function (datos) {
                        if(datos.length>0){
                        $('#DIVELIMINARGRADO').html(datos);  
                        $('#DIVELIMINARGRADO').dialog('open');                            
                        }
                        return false;
                    }                    
                });
                                        });                                               
                                        
                $("#DIVEDITARGRADO").dialog({
                    
                    autoOpen: false,
                    hide:"drop",
                    width: 350,
                    height: 240,
                    closeOnEscape: false,
                    open: function(event, ui) { 
                    $(this).closest(".ui-dialog").find(".ui-dialog-titlebar-close").hide();  },
                    modal: true,
                    buttons: {
                        "SI": function() {
                                $.ajax({
                                    type: 'POST',
                                    url:   "editarGrados/",
                                    data: $("#editargradosa1").serialize(),
                                    success: function(){
                                    $("#DIVGRADO").load("<?= site_url('GestionEducativa/bandejaGrado/') ?>");      
                                    $("#bandejaAula").load("<?= site_url('GestionEducativa/vistabandejaaula/') ?>");                                                                                                                                                        
                                    }
                                    });                                            
                                    $(this).dialog("close");
                                    },
                        "NO": function() {                                
                                $(this).dialog("close"); //Se cancela operación                              
                        }
                    }
                });                                    
                $("#DIVEDITARGRADO").dialog({ draggable: false });
                $("#DIVEDITARGRADO").dialog({ resizable: false });                                    
         
                $("#DIVELIMINARGRADO").dialog({
                    autoOpen: false,
                    hide:"drop",
                    width: 350,
                    height: 150,
                    closeOnEscape: false,
                    open: function(event, ui) { 
                    $(this).closest(".ui-dialog").find(".ui-dialog-titlebar-close").hide();  },
                    modal: true,
                    buttons: {
                        "SI": function() {        
                                var ide= $("#txtcodigogrados").val();
                                $.ajax({
                                    type: 'POST',
                                    url:   "eliminarGrados",
                                    data:{ide:ide},
                                    success: function(){                                
                                $("#DIVGRADO").load("<?= site_url('GestionEducativa/bandejaGrado/') ?>");     
                                $("#bandejaAula").load("<?= site_url('GestionEducativa/vistabandejaaula/') ?>");                                                                                                                                                    
                                    }
                                    });                                            


                                $(this).dialog("close");                                
                                    },
                        "NO": function() {                                
                                $(this).dialog("close"); //Se cancela operación                              
                        }
                    }
                });                                    
                $("#DIVELIMINARGRADO").dialog({ draggable: false });
                $("#DIVELIMINARGRADO").dialog({ resizable: false });                       

    
</script>