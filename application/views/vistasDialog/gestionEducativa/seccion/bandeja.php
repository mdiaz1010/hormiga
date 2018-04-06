<?php
?>
                        <div class="row">
                        <div class="panel panel-default">                                           
                                <table class="table table-striped table-bordered dt-responsive nowrap  " cellspacing="0" width="100%" id="dataTables-seccion">
                                    <thead class="bg-success" >
                                        <tr>
                                     <th style="border: hidden;color: #3b752e;"><center>CODIGO      </center></th>
                                     <th style="border: hidden;color: #3b752e;"><center>NOMBRE      </center></th>                                               
                                     <th style="border: hidden;color: #3b752e;"><center>DESCRIPCION </center></th> 
                                     <th style="border: hidden;color: #3b752e;"><center>OPCIONES    </center></th> 
                                        </tr>
                                    </thead>                                   
                                    <tbody>       
                                        
                                            <?php  $i=0;
                                            foreach ($bodyData->grado as $grado) {
                                                
                                                
                                            ?>
                                                  <tr>  
                                                      <td><CENTER>SECD000<?=$grado->id  ?></CENTER></td>
                                                      <td><CENTER><?=$grado->nom_seccion  ?></CENTER></td>
                                                      <td><CENTER><?=$grado->des_seccion  ?></CENTER></td>
                                                      <td><CENTER><a href="javascript:" class="btnEdicion"   data-id ="<?=$grado->id?>">Editar</a> 
                                                                  <a href="javascript:" class="btnEliminar"  data-ide="<?=$grado->id?>">Eliminar</a></CENTER></td>
                                                  </tr>
                                            <?php
                                                   $i++;                                       }
                                            ?>                                        
                                          
                                    </tbody>
                                </table>

                        </div>
                        </div>
<div id="DIVELIMINARSECCION" title="INTRANET EDUCATIVA :: ELIMINAR SECCION"></div>
<div id="DIVEDITARSECCION"          title="INTRANET EDUCATIVA :: EDITAR   SECCION"></div>
<script type="text/javascript">
        //
        
                $(".btnEdicion").click(function(){
		var id = $(this).data("id"); 
                $.ajax({
                    type: 'POST',
                    url: "editarSeccion",
                    data:{id:id},
                    success: function (datos) {
                        if(datos.length>0){
                        $('#DIVEDITARSECCION').html(datos);  
                        $('#DIVEDITARSECCION').dialog('open');
                            
                        }
                        return false;
                    }
                    
                     });
                                                    }); 

                $(".btnEliminar").click(function(){               
		var ide = $(this).data("ide");                             
                $.ajax({
                    type: 'POST',
                    url: "eliminarSeccion",
                    data:{ide:ide},
                    success: function (datos) {
                        if(datos.length>0){
                        $('#DIVELIMINARSECCION').html(datos);  
                        $('#DIVELIMINARSECCION').dialog('open');
                            
                        }
                        return false;
                    }                    
                });
                                                    });                
                                                    
                $("#DIVEDITARSECCION").dialog({
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
                                    url:   "editarSecciones/",
                                    data: $("#editarseccionsa1").serialize(),
                                    success: function(){
                                    $("#DIVSECCION").load("<?= site_url('GestionEducativa/bandejaSeccion/') ?>");                     
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
                
                $("#DIVEDITARSECCION").dialog({ draggable: false });
                $("#DIVEDITARSECCION").dialog({ resizable: false });                                    

                $("#DIVELIMINARSECCION").dialog({
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
                                var ides = $("#txtcodigoseccions").val();
                                $.ajax({
                                    type: 'POST',
                                    url:   "eliminarSecciones",
                                    data: {ides:ides},
                                    success: function(){
                                $("#DIVSECCION").load("<?= site_url('GestionEducativa/bandejaSeccion/') ?>");                     
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
                $("#DIVELIMINARSECCION").dialog({ draggable: false });
                $("#DIVELIMINARSECCION").dialog({ resizable: false });                       

    
</script>